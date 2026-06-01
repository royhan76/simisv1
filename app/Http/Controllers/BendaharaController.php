<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterPembayaran; // ✅ sesuai model kamu
use App\Santris;
use App\Pembayaran;
use App\PembayaranUnit;
use App\Syahriyah;
use Illuminate\Support\Facades\DB;
use App\Exports\LaporanKeuanganExport;
use Maatwebsite\Excel\Facades\Excel;


class BendaharaController extends Controller
{
    public function index()
    {
        return view('layouts.pages.admin.bendahara.dashboard');
    }

    // ✅ STORE
    public function storeNominal(Request $request)
{
    MasterPembayaran::create([
        'name' => $request->name,
        'nominal' => (int) $request->nominal
    ]);

    return response()->json(['success' => true]);
}

    // ✅ UPDATE
    public function updateNominal(Request $request)
    {
        $data = MasterPembayaran::find($request->id);

    $data->update([
        'name' => $request->name,
        'nominal' => (int) $request->nominal
    ]);

    return response()->json(['success' => true]);
    }

    // ✅ GET
    public function getNominal()
    {
        return response()->json([
        'data' => MasterPembayaran::latest()->get()
    ]);
    }

    public function deleteNominal(Request $request)
    {
        MasterPembayaran::find($request->id)->delete();

        return response()->json(['success' => true]);
    }

    public function pembayaran()
    {
        return view('layouts.pages.admin.bendahara.pembayaran.index');
    }

    public function laporanKeuangan()
    {
        return view('layouts.pages.admin.bendahara.laporan_keuangan.index');
    }

    public function getSantriPembayaran()
    {
        return response()->json([
            'data' => Santris::latest()->get()
        ]);
    }

    public function getLaporanKeuangan()
    {
        $report = $this->buildLaporanKeuanganReport();

        return response()->json([
            'data' => $report['rows'],
            'summary' => $report['summary'],
            'codes' => $report['codes'],
        ]);
    }

    public function exportLaporanKeuangan()
    {
        $report = $this->buildLaporanKeuanganReport();

        return Excel::download(
            new LaporanKeuanganExport($report),
            'laporan_keuangan.xlsx'
        );
    }

    public function detailLaporanKeuangan($santri_id)
    {
        $santri = Santris::where('santri_id', $santri_id)->first();

        if (!$santri) {
            return response()->json([
                'success' => false,
                'message' => 'Santri tidak ditemukan'
            ], 404);
        }

        $foto = \App\Photo::where('santri_id', $santri_id)->first();
        $syahriyahNominal = $this->getSyahriyahNominalAmount();

        $transaksi = $this->getTransaksiKeuangan()
            ->map(function ($item) use ($syahriyahNominal) {
                if ($item['sumber'] === 'syahriyah') {
                    $item['nominal'] = $syahriyahNominal;
                    $item['nominal_rupiah'] = 'Rp ' . number_format($syahriyahNominal, 0, ',', '.');
                }

                return $item;
            })
            ->where('santri_id', $santri_id)
            ->sortByDesc('created_at')
            ->values();

        $summary = [
            'total_transaksi' => $transaksi->count(),
            'total_nominal' => (int) $transaksi->sum('nominal'),
            'unit_transaksi' => $transaksi->where('sumber', 'unit')->count(),
            'syahriyah_transaksi' => $transaksi->where('sumber', 'syahriyah')->count(),
            'unit_nominal' => (int) $transaksi->where('sumber', 'unit')->sum('nominal'),
            'syahriyah_nominal' => (int) $transaksi->where('sumber', 'syahriyah')->sum('nominal'),
        ];

        $fotoPath = $foto && $foto->path
            ? asset('storage/' . str_replace('public/', '', $foto->path))
            : asset('storage/images/muslim.png');

        return response()->json([
            'success' => true,
            'santri' => [
                'santri_id' => $santri->santri_id,
                'nama' => $santri->nama,
                'khos' => $santri->khos,
                'status' => $santri->status,
                'kamar' => $santri->kamar ?? '-',
                'foto' => $fotoPath,
            ],
            'summary' => $summary,
            'transaksi' => $transaksi,
        ]);
    }

    private function buildLaporanKeuanganReport()
    {
        $definitions = $this->getLaporanKeuanganDefinitions();
        $syahriyahNominal = $this->getSyahriyahNominalAmount();
        $currentHijriYear = $this->getCurrentHijriYear();

        $santriList = Santris::orderBy('nama')->get();

        $unitPayments = PembayaranUnit::query()
            ->orderBy('tanggal_bayar')
            ->get()
            ->groupBy('santri_id');

        $syahriyahPayments = Syahriyah::query()
            ->where('tahun_hijriyah', $currentHijriYear)
            ->orderBy('tanggal_bayar')
            ->get()
            ->groupBy('santri_id');

        $rows = $santriList->map(function ($santri, $index) use (
            $definitions,
            $unitPayments,
            $syahriyahPayments
        ) {
            $santriUnitPayments = $unitPayments->get($santri->santri_id, collect());
            $santriSyahriyahPayments = $syahriyahPayments->get($santri->santri_id, collect());

            $paidCodes = [];

            foreach ($definitions as $code => $definition) {
                if ($code === 'SYAH') {
                    continue;
                }

                $paid = $santriUnitPayments->contains(function ($payment) use ($definition) {
                    return $this->matchesPaymentAlias($payment->nama_unit, $definition['aliases']);
                });

                if ($paid) {
                    $paidCodes[] = $code;
                }
            }

            $syahCount = $santriSyahriyahPayments->count();
            $jml = count($paidCodes) + ($syahCount > 0 ? 1 : 0);

            return [
                'no' => $index + 1,
                'santri_id' => $santri->santri_id,
                'nama' => $santri->nama,
                'db' => (bool) ($santriUnitPayments->contains(fn ($p) => $this->matchesPaymentAlias($p->nama_unit, $definitions['DB']['aliases']))),
                'du' => (bool) ($santriUnitPayments->contains(fn ($p) => $this->matchesPaymentAlias($p->nama_unit, $definitions['DU']['aliases']))),
                'sarp_b' => (bool) ($santriUnitPayments->contains(fn ($p) => $this->matchesPaymentAlias($p->nama_unit, $definitions['SARP_B']['aliases']))),
                'sarp_l' => (bool) ($santriUnitPayments->contains(fn ($p) => $this->matchesPaymentAlias($p->nama_unit, $definitions['SARP_L']['aliases']))),
                'peng_b' => (bool) ($santriUnitPayments->contains(fn ($p) => $this->matchesPaymentAlias($p->nama_unit, $definitions['PENG_B']['aliases']))),
                'peng_l' => (bool) ($santriUnitPayments->contains(fn ($p) => $this->matchesPaymentAlias($p->nama_unit, $definitions['PENG_L']['aliases']))),
                'rjb' => (bool) ($santriUnitPayments->contains(fn ($p) => $this->matchesPaymentAlias($p->nama_unit, $definitions['RJB']['aliases']))),
                'kal' => (bool) ($santriUnitPayments->contains(fn ($p) => $this->matchesPaymentAlias($p->nama_unit, $definitions['KAL']['aliases']))),
                'kts' => (bool) ($santriUnitPayments->contains(fn ($p) => $this->matchesPaymentAlias($p->nama_unit, $definitions['KTS']['aliases']))),
                'ser' => (bool) ($santriUnitPayments->contains(fn ($p) => $this->matchesPaymentAlias($p->nama_unit, $definitions['SER']['aliases']))),
                'syah_count' => $syahCount,
                'jml' => $jml,
            ];
        })->values();

        $codes = collect($definitions)->map(function ($definition, $code) use ($rows, $syahriyahNominal) {
            if ($code === 'SYAH') {
                $satuan = $rows->sum('syah_count');
                $nominal = $syahriyahNominal;

                return [
                    'code' => $code,
                    'label' => $definition['label'],
                    'satuan' => $satuan,
                    'nominal' => $nominal,
                    'jumlah' => $satuan * $nominal,
                ];
            }

            $satuan = $rows->filter(function ($row) use ($definition) {
                return !empty($row[$definition['key']]);
            })->count();

            $nominal = $this->getNominalForAliases($definition['aliases']);

            return [
                'code' => $code,
                'label' => $definition['label'],
                'satuan' => $satuan,
                'nominal' => $nominal,
                'jumlah' => $satuan * $nominal,
            ];
        })->values();

        $totalNominal = (int) $codes->sum('jumlah');
        $totalTransaksi = (int) $rows->sum('jml');
        $santriSudahBayar = (int) $rows->filter(function ($row) {
            return (int) $row['jml'] > 0;
        })->count();

        return [
            'rows' => $rows,
            'codes' => $codes,
            'summary' => [
                'total_santri' => $rows->count(),
                'santri_sudah_bayar' => $santriSudahBayar,
                'total_transaksi' => $totalTransaksi,
                'total_nominal' => $totalNominal,
                'syahriyah_nominal' => $syahriyahNominal,
                'current_hijri_year' => $currentHijriYear,
            ],
        ];
    }

    private function getLaporanKeuanganDefinitions()
    {
        return [
            'DB' => [
                'label' => 'Daftar Baru',
                'key' => 'db',
                'aliases' => ['Daftar Baru', 'Daftar Pondok', 'DB'],
            ],
            'DU' => [
                'label' => 'Daftar Ulang',
                'key' => 'du',
                'aliases' => ['Daftar Ulang', 'DU'],
            ],
            'SARP_B' => [
                'label' => 'Sarpras Baru',
                'key' => 'sarp_b',
                'aliases' => ['Sarpras Baru', 'Sarana & Prasarana Baru', 'Sarana Prasarana Baru', 'Sarpras', 'SARP B', 'Sarana & Prasarana'],
            ],
            'SARP_L' => [
                'label' => 'Sarpras Lama',
                'key' => 'sarp_l',
                'aliases' => ['Sarpras Lama', 'Sarana & Prasarana Lama', 'SARP L'],
            ],
            'PENG_B' => [
                'label' => 'Pengairan Baru',
                'key' => 'peng_b',
                'aliases' => ['Pengairan Baru', 'Pengairan'],
            ],
            'PENG_L' => [
                'label' => 'Pengairan Lama',
                'key' => 'peng_l',
                'aliases' => ['Pengairan Lama'],
            ],
            'RJB' => [
                'label' => 'Rojabiyah',
                'key' => 'rjb',
                'aliases' => ['Rojabiyah', 'Rojabiyah/Akhirus Sanah', 'Akhirus Sanah'],
            ],
            'KAL' => [
                'label' => 'Kalender',
                'key' => 'kal',
                'aliases' => ['Kalender'],
            ],
            'KTS' => [
                'label' => 'Kartu Tanda Santri',
                'key' => 'kts',
                'aliases' => ['KTS', 'Kartu Tanda Santri'],
            ],
            'SER' => [
                'label' => 'Seragam',
                'key' => 'ser',
                'aliases' => ['Seragam'],
            ],
            'SYAH' => [
                'label' => 'Syahriyah',
                'key' => 'syah_count',
                'aliases' => ['Syahriyah'],
            ],
        ];
    }

    private function matchesPaymentAlias($name, array $aliases)
    {
        $normalized = $this->normalizePaymentName($name);

        foreach ($aliases as $alias) {
            if ($normalized === $this->normalizePaymentName($alias)) {
                return true;
            }
        }

        return false;
    }

    private function normalizePaymentName($value)
    {
        return preg_replace('/[^a-z0-9]/', '', strtolower((string) $value));
    }

    private function getNominalForAliases(array $aliases)
    {
        $normalizedAliases = array_map(function ($alias) {
            return $this->normalizePaymentName($alias);
        }, $aliases);

        $nominal = MasterPembayaran::query()
            ->get()
            ->first(function ($item) use ($normalizedAliases) {
                return in_array($this->normalizePaymentName($item->name), $normalizedAliases, true);
            });

        return (int) ($nominal->nominal ?? 0);
    }

    private function getSyahriyahNominalAmount()
    {
        return (int) (MasterPembayaran::where('name', 'Syahriyah')->value('nominal') ?? 0);
    }

    private function getTransaksiKeuangan()
    {
        $unitRows = DB::table('pembayaran_unit')
            ->join('santri', 'pembayaran_unit.santri_id', '=', 'santri.santri_id')
            ->selectRaw("
                pembayaran_unit.id as transaksi_id,
                pembayaran_unit.santri_id,
                santri.nama,
                santri.khos,
                santri.status,
                'Pembayaran Unit' as jenis,
                pembayaran_unit.nama_unit as detail,
                pembayaran_unit.nominal,
                pembayaran_unit.tanggal_bayar,
                pembayaran_unit.keterangan,
                pembayaran_unit.created_at,
                'unit' as sumber
            ")
            ->get();

        $syahriyahRows = DB::table('syahriyah')
            ->join('santri', 'syahriyah.santri_id', '=', 'santri.santri_id')
            ->selectRaw("
                syahriyah.id as transaksi_id,
                syahriyah.santri_id,
                santri.nama,
                santri.khos,
                santri.status,
                'Syahriyah' as jenis,
                CONCAT('Bulan ', syahriyah.bulan, ' - ', syahriyah.tahun_hijriyah) as detail,
                syahriyah.nominal,
                syahriyah.tanggal_bayar,
                syahriyah.keterangan,
                syahriyah.created_at,
                'syahriyah' as sumber
            ")
            ->get();

        return $unitRows
            ->merge($syahriyahRows)
            ->map(function ($item) {
                $createdAt = $item->created_at ? (string) $item->created_at : null;
                $tanggal = $item->tanggal_bayar
                    ? date('d-m-Y', strtotime($item->tanggal_bayar))
                    : '-';

                return [
                    'transaksi_id' => $item->transaksi_id,
                    'santri_id' => $item->santri_id,
                    'nama' => $item->nama,
                    'khos' => $item->khos,
                    'status' => $item->status,
                    'jenis' => $item->jenis,
                    'detail' => $item->detail,
                    'nominal' => (int) $item->nominal,
                    'nominal_rupiah' => 'Rp ' . number_format((int) $item->nominal, 0, ',', '.'),
                    'tanggal_bayar' => $tanggal,
                    'keterangan' => $item->keterangan ?? '-',
                    'sumber' => $item->sumber,
                    'created_at' => $createdAt,
                    'created_at_sort' => $createdAt ? strtotime($createdAt) : 0,
                ];
            });
    }

    private function groupTransaksiPerSantri($transaksi)
    {
        return $transaksi->groupBy('santri_id')->map(function ($items) {
            $latest = $items->sortByDesc('created_at_sort')->first();
            $lastDate = $latest['tanggal_bayar'] ?? '-';

            return [
                'santri_id' => $latest['santri_id'],
                'nama' => $latest['nama'],
                'khos' => $latest['khos'],
                'status' => $latest['status'],
                'total_dibayar' => (int) $items->sum('nominal'),
                'total_dibayar_rupiah' => 'Rp ' . number_format((int) $items->sum('nominal'), 0, ',', '.'),
                'jumlah_transaksi' => $items->count(),
                'unit_nominal' => (int) $items->where('sumber', 'unit')->sum('nominal'),
                'syahriyah_nominal' => (int) $items->where('sumber', 'syahriyah')->sum('nominal'),
                'last_payment_date' => $lastDate,
                'last_payment_sort' => $latest['created_at_sort'] ?? 0,
            ];
        })->values();
    }

    public function detailPembayaran($santri_id)
    {
        $santri = Santris::where(function ($query) use ($santri_id) {
            $query->where('santri_id', $santri_id)
                ->orWhere('id', $santri_id);
        })->first();

        if (!$santri) {
            return response()->json([
                'success' => false,
                'message' => 'Santri tidak ditemukan'
            ], 404);
        }

        $santriKey = $santri->santri_id ?: $santri->id;

        $foto = \App\Photo::where(function ($query) use ($santri_id, $santriKey) {
            $query->where('santri_id', $santriKey)
                ->orWhere('santri_id', $santri_id);
        })->first();

        $unitSudahBayar = PembayaranUnit::where(function ($query) use ($santri_id, $santriKey) {
                $query->where('santri_id', $santriKey)
                    ->orWhere('santri_id', $santri_id);
            })
            ->orderBy('tanggal_bayar')
            ->get();

        $unitSudahBayarNames = $unitSudahBayar
            ->pluck('nama_unit')
            ->map(function ($item) {
                return trim($item);
            })
            ->toArray();

        $unitBelumBayarQuery = MasterPembayaran::query()->orderBy('name');

        if (!empty($unitSudahBayarNames)) {
            $unitBelumBayarQuery->whereNotIn('name', $unitSudahBayarNames);
        }

        $unitBelumBayar = $unitBelumBayarQuery->get();

        $syahriyahSemua = Syahriyah::where(function ($query) use ($santri_id, $santriKey) {
                $query->where('santri_id', $santriKey)
                    ->orWhere('santri_id', $santri_id);
            })
            ->orderBy('tahun_hijriyah')
            ->orderBy('bulan')
            ->get();

        $syahriyahNominal = (int) (MasterPembayaran::where('name', 'Syahriyah')->value('nominal') ?? 0);

        $tahunAktif = optional($syahriyahSemua->sortByDesc('id')->first())->tahun_hijriyah
            ?? $this->getCurrentHijriYear();

        $bulanSudahBayar = Syahriyah::where(function ($query) use ($santri_id, $santriKey) {
                $query->where('santri_id', $santriKey)
                    ->orWhere('santri_id', $santri_id);
            })
            ->where('tahun_hijriyah', $tahunAktif)
            ->pluck('bulan')
            ->map(function ($item) {
                return trim($item);
            })
            ->toArray();

        $daftarBulan = [
            'Syawal',
            'Dzulqodah',
            'Dzulhijjah',
            'Muharram',
            'Shafar',
            'Rabiul Awal',
            'Rabiul Akhir',
            'Jumadil Awal',
            'Jumadil Akhir',
            'Rajab',
            'Syaban',
            'Ramadhan'
        ];

        $bulanBelumBayar = array_values(array_diff($daftarBulan, $bulanSudahBayar));

        $syahriyahSudahBayar = Syahriyah::where(function ($query) use ($santri_id, $santriKey) {
                $query->where('santri_id', $santriKey)
                    ->orWhere('santri_id', $santri_id);
            })
            ->where('tahun_hijriyah', $tahunAktif)
            ->orderByRaw("FIELD(bulan, 'Syawal', 'Dzulqodah', 'Dzulhijjah', 'Muharram', 'Shafar', 'Rabiul Awal', 'Rabiul Akhir', 'Jumadil Awal', 'Jumadil Akhir', 'Rajab', 'Syaban', 'Ramadhan')")
            ->get();

        $unitTotalDibayar = (int) $unitSudahBayar->sum('nominal');
        $syahriyahTotalDibayar = (int) $syahriyahSudahBayar->count() * $syahriyahNominal;
        $totalDibayar = $unitTotalDibayar + $syahriyahTotalDibayar;

        $fotoPath = $foto && $foto->path
            ? asset('storage/' . str_replace('public/', '', $foto->path))
            : asset('storage/images/muslim.png');

        return response()->json([
            'success' => true,
            'santri' => [
                'santri_id' => $santri->santri_id,
                'id' => $santri->id ?? null,
                'nama' => $santri->nama,
                'nik' => $santri->nik,
                'khos' => $santri->khos,
                'status' => $santri->status,
                'kamar' => $santri->kamar ?? '-',
                'foto' => $fotoPath,
            ],
            'santri_id' => $santri->santri_id,
            'id' => $santri->id ?? null,
            'nama' => $santri->nama,
            'nik' => $santri->nik,
            'khos' => $santri->khos,
            'status' => $santri->status,
            'kamar' => $santri->kamar ?? '-',
            'foto' => $fotoPath,
            'unit_sudah_bayar' => $unitSudahBayar,
            'unit_belum_bayar' => $unitBelumBayar,
            'syahriyah_sudah_bayar' => $syahriyahSudahBayar,
            'syahriyah_belum_bayar' => $bulanBelumBayar,
            'tahun_hijriyah' => $tahunAktif,
            'syahriyah_nominal' => $syahriyahNominal,
            'total_dibayar' => $totalDibayar,
            'unit_total_dibayar' => $unitTotalDibayar,
            'syahriyah_total_dibayar' => $syahriyahTotalDibayar,
        ]);
    }

    private function getCurrentHijriYear()
    {
        $today = now();
        $hijriYear = floor((($today->year - 622) * 33) / 32);

        return $hijriYear . ' H';
    }

    public function getMasterPembayaran()
    {
        return response()->json([
            'data' => MasterPembayaran::all()
        ]);
    }

  public function storePembayaran(Request $request)
    {
        // dd($request);
        DB::beginTransaction();

        try {

            // =====================================
            // SIMPAN PEMBAYARAN UNIT
            // =====================================

            if ($request->unit_id) {

                foreach ($request->unit_id as $unitId) {

                    $unit = MasterPembayaran::find($unitId);

                    if ($unit) {

                        $cekUnit = PembayaranUnit::where('santri_id', $request->santri_id)
                            ->where('nama_unit', $unit->name)
                            ->first();

                        if (!$cekUnit) {

                            PembayaranUnit::create([
                                'santri_id'      => $request->santri_id,
                                'nama_unit'      => $unit->name,
                                'nominal'        => $unit->nominal,
                                'tanggal_bayar'  => now(),
                                'keterangan'     => $request->keterangan,
                            ]);

                        }

                    }

                }

            }

            // =====================================
            // SIMPAN SYAHRIYAH
            // =====================================

            if ($request->bulan) {

                $nominalSyahriyah = (int) preg_replace('/[^0-9]/', '', (string) $request->nominal_syahriyah);

                foreach ($request->bulan as $bulan) {

                    // CEK DUPLIKAT
                    $cek = Syahriyah::where('santri_id', $request->santri_id)
                        ->where('tahun_hijriyah', $request->tahun_hijriyah)
                        ->where('bulan', $bulan)
                        ->first();

                    if (!$cek) {

                        Syahriyah::create([
                            'santri_id'        => $request->santri_id,
                            'tahun_hijriyah'   => $request->tahun_hijriyah,
                            'bulan'            => $bulan,
                            'nominal'          => $nominalSyahriyah,
                            'tanggal_bayar'    => now(),
                            'keterangan'       => $request->keterangan,
                        ]);

                    }

                }

            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil disimpan'
            ]);

        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }

    public function cekPembayaran($santri_id)
        {
            $data = Syahriyah::where('santri_id', $santri_id)
                ->select('bulan')
                ->get();

            return response()->json($data);
        }

    public function cekPembayaranUnit($santri_id)
    {
        $data = PembayaranUnit::where('santri_id', $santri_id)
            ->pluck('nama_unit');

        return response()->json($data);
    }

    public function getNominalSyahriyah()
    {
        $data = MasterPembayaran::where('name', 'Syahriyah')
            ->first();

        return response()->json($data);
    }

}
