@extends('master')

@php
    $safe = fn($value) => !empty($value) ? $value : '-';

    $tLahir = str_replace('KABUPATEN', '', $santri->tempat_lahir ?? '');
    $tLahir_ayah = str_replace('KABUPATEN', '', optional($wali)->tempat_lahir_ayah ?? '');
    $tLahir_ibu = str_replace('KABUPATEN', '', optional($wali)->tempat_lahir_ibu ?? '');
    $tanggal_lahir = str_replace('00:00:00', '', $santri->tgl_lahir ?? '');
    $thn_masuk_santri = str_replace('00:00:00', '', $thn_masuk?->thn_masuk ?? '');
    $thn_keluar_santri = str_replace('00:00:00', '', $thn_keluar?->thn_keluar ?? '');
    $photo = !empty($foto?->path) ? 'storage/' . str_replace('public/', '', $foto->path) : 'storage/images/muslim.png';
    $kkPath = !empty($dok_kk?->path) ? 'storage/' . str_replace('public/', '', $dok_kk->path) : null;
    $lampiranList = [
        [
            'title' => 'Foto Santri',
            'src' => asset($photo),
            'available' => true,
        ],
        [
            'title' => 'Dokumen KK',
            'src' => $kkPath ? asset($kkPath) : null,
            'available' => !empty($kkPath),
        ],
    ];
@endphp

@section('body')
    <style>
        html,
        body {
            overflow-y: auto !important;
            background: #f4f7fb;
        }

        .main-panel,
        .content,
        .page-inner {
            height: auto !important;
            overflow: visible !important;
        }

        .detail-card {
            height: auto !important;
            border: 0;
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .detail-hero {
            background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);
        }

        .detail-label {
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #64748b;
            margin-bottom: .25rem;
        }

        .detail-value {
            font-weight: 600;
            color: #0f172a;
        }

        .detail-pill {
            display: inline-flex;
            align-items: center;
            padding: .35rem .7rem;
            border-radius: 999px;
            background: #eef4ff;
            color: #1d4ed8;
            font-size: .82rem;
            font-weight: 600;
        }

        .detail-mini-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: .9rem 1rem;
        }

        .detail-stack {
            display: grid;
            gap: .8rem;
        }

        .lampiran-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06);
            overflow: hidden;
            margin-top: 1rem;
        }

        .lampiran-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
            padding: .8rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .lampiran-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .lampiran-item:first-child {
            padding-top: 0;
        }

        .lampiran-name {
            font-weight: 600;
            color: #0f172a;
        }

        .lampiran-actions {
            display: flex;
            gap: .5rem;
            flex-wrap: wrap;
        }

        #lampiranPreviewWrap {
            overflow: auto;
            max-height: 78vh;
            background: #f8fafc;
            border-radius: 14px;
            padding: 1rem;
        }

        #lampiranPreview {
            display: block;
            max-width: 100%;
            transform-origin: top center;
            transition: transform .18s ease;
            margin: 0 auto;
        }
    </style>

    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left flex-column">
                <h2 class="text-white pb-2 fw-bold">Detail Santri</h2>
                <h5 class="text-white op-7 mb-3">
                    Pondok Pesantren Ma'hadul 'Ilmi Asy-Syar'ie (MIS)
                </h5>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-lg-4 mb-4">
                <div class="card detail-card detail-hero">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="mb-3">
                                <img src="{{ asset($photo) }}" alt="Avatar Santri"
                                    class="rounded-circle shadow-sm"
                                    style="width:120px; height:120px; object-fit:cover; border:4px solid #fff;">
                            </div>

                            <h4 class="fw-bold mb-1">{{ $safe($santri->nama) }}</h4>
                            <div class="text-muted mb-3">{{ $safe($santri->santri_id) }}</div>
                            <span class="detail-pill mb-3">{{ $safe($santri->status) }}</span>
                        </div>

                        <div class="detail-stack">
                            <div class="detail-mini-card">
                                <div class="detail-label">Tempat, Tanggal Lahir</div>
                                <div class="detail-value">{{ $safe($tLahir) }}, {{ $safe($tanggal_lahir) }}</div>
                            </div>

                            <div class="detail-mini-card">
                                <div class="detail-label">Kontak</div>
                                <div class="detail-value">{{ $safe($santri->no_tlp) }}</div>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="detail-mini-card h-100">
                                        <div class="detail-label">No. Induk</div>
                                        <div class="detail-value">{{ $safe($santri->no_induk) }}</div>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="detail-mini-card h-100">
                                        <div class="detail-label">Khos</div>
                                        <div class="detail-value">{{ $safe($santri->khos) }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="detail-mini-card">
                                <div class="detail-label">Tahun Masuk</div>
                                <div class="detail-value">{{ $safe($thn_masuk_santri) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card lampiran-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <div class="detail-label mb-1">Lampiran</div>
                                <div class="h6 mb-0">Klik untuk melihat</div>
                            </div>
                        </div>

                        @foreach ($lampiranList as $lampiran)
                            <div class="lampiran-item">
                                <div>
                                    <div class="lampiran-name">{{ $lampiran['title'] }}</div>
                                    <div class="small text-muted">Klik untuk membuka preview</div>
                                </div>

                                <div class="lampiran-actions">
                                    @if ($lampiran['available'])
                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                            onclick="openLampiran('{{ $lampiran['src'] }}', '{{ $lampiran['title'] }}')">
                                            Lihat
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-outline-secondary" disabled>
                                            Tidak Ada
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card detail-card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <div class="detail-label mb-1">Profil Utama</div>
                                <div class="h5 mb-0">Data Santri</div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-mini-card mb-3"><div class="detail-label">No. Induk</div><div class="detail-value">{{ $safe($santri->no_induk) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">No. KK</div><div class="detail-value">{{ $safe($santri->kk) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">NIK</div><div class="detail-value">{{ $safe($santri->nik) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">NISN</div><div class="detail-value">{{ $safe($santri->nisn) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Nama</div><div class="detail-value">{{ $safe($santri->nama) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Tempat Lahir</div><div class="detail-value">{{ $safe($tLahir) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Tanggal Lahir</div><div class="detail-value">{{ $safe($tanggal_lahir) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Jenis Kelamin</div><div class="detail-value">{{ $safe($santri->kelamin) }}</div></div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-mini-card mb-3"><div class="detail-label">Agama</div><div class="detail-value">{{ $safe($santri->agama) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Kewarganegaraan</div><div class="detail-value">{{ $safe($santri->warga_negara) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Status</div><div class="detail-value">{{ $safe($santri->status) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Khos / Kamar</div><div class="detail-value">{{ $safe($santri->khos) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Pendidikan Terakhir</div><div class="detail-value">{{ $safe($santri->pend_terakhir) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">No. Telepon</div><div class="detail-value">{{ $safe($santri->no_tlp) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Anak Ke</div><div class="detail-value">{{ $safe($santri->anak_ke) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Jumlah Saudara</div><div class="detail-value">{{ $safe($santri->j_saudara) }}</div></div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-mini-card mb-3"><div class="detail-label">Provinsi</div><div class="detail-value">{{ $safe($santri->provinsi) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Kabupaten</div><div class="detail-value">{{ $safe($santri->kabupaten) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Kecamatan</div><div class="detail-value">{{ $safe($santri->kecamatan) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Kelurahan/Desa</div><div class="detail-value">{{ $safe($santri->kelurahan) }}</div></div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-mini-card mb-3"><div class="detail-label">Jalan / Gang</div><div class="detail-value">{{ $safe($santri->jalan) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Kode Pos</div><div class="detail-value">{{ $safe($santri->kodepos) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Tahun Masuk</div><div class="detail-value">{{ $safe($thn_masuk_santri) }}</div></div>
                                <div class="detail-mini-card mb-3"><div class="detail-label">Tahun Keluar</div><div class="detail-value">{{ $safe($thn_keluar_santri) }}</div></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card detail-card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <div class="detail-label mb-1">Informasi Keluarga</div>
                                <div class="h5 mb-0">Data Wali Santri</div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-mini-card mb-3">
                                    <div class="detail-label">Ayah</div>
                                    <div class="detail-value">{{ $safe(optional($wali)->ayah) }}</div>
                                    <div class="small text-muted mt-2">NIK: {{ $safe(optional($wali)->ayah_nik) }}</div>
                                    <div class="small text-muted">Pendidikan: {{ $safe(optional($wali)->pend_terakhir_ayah) }}</div>
                                    <div class="small text-muted">Tempat lahir: {{ $safe($tLahir_ayah) }}</div>
                                    <div class="small text-muted">Tanggal lahir: {{ $safe(optional($wali)->tgl_lahir_ayah) }}</div>
                                    <div class="small text-muted">Pekerjaan: {{ $safe(optional($wali)->pekerjaan_ayah) }}</div>
                                    <div class="small text-muted">Kewarganegaraan: {{ $safe(optional($wali)->warga_negara_ayah) }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-mini-card mb-3">
                                    <div class="detail-label">Ibu</div>
                                    <div class="detail-value">{{ $safe(optional($wali)->ibu) }}</div>
                                    <div class="small text-muted mt-2">NIK: {{ $safe(optional($wali)->nik_ibu) }}</div>
                                    <div class="small text-muted">Pendidikan: {{ $safe(optional($wali)->pend_terakhir_ibu) }}</div>
                                    <div class="small text-muted">Tempat lahir: {{ $safe($tLahir_ibu) }}</div>
                                    <div class="small text-muted">Tanggal lahir: {{ $safe(optional($wali)->tgl_lahir_ibu) }}</div>
                                    <div class="small text-muted">Pekerjaan: {{ $safe(optional($wali)->pekerjaan_ibu) }}</div>
                                    <div class="small text-muted">Kewarganegaraan: {{ $safe(optional($wali)->warga_negara_ibu) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLampiran" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="lampiranTitle">Lampiran</h5>
                    <div class="lampiran-actions mr-3">
                        <button type="button" class="btn btn-sm btn-light" onclick="zoomLampiran(-0.1)">-</button>
                        <button type="button" class="btn btn-sm btn-light" onclick="resetZoomLampiran()">Reset</button>
                        <button type="button" class="btn btn-sm btn-light" onclick="zoomLampiran(0.1)">+</button>
                        <a id="lampiranDownloadLink" href="#" class="btn btn-sm btn-light" download>
                            Download
                        </a>
                    </div>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <div id="lampiranPreviewWrap">
                        <img id="lampiranPreview" src="" alt="Lampiran"
                            class="img-fluid rounded shadow-sm"
                            style="object-fit:contain;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')
    <script>
        let lampiranScale = 1;

        function openLampiran(src, title) {
            $('#lampiranTitle').text(title || 'Lampiran');
            $('#lampiranPreview').attr('src', src);
            $('#lampiranDownloadLink').attr('href', src);
            resetZoomLampiran();
            $('#modalLampiran').modal('show');
        }

        function zoomLampiran(delta) {
            lampiranScale = Math.max(0.7, Math.min(3, lampiranScale + delta));
            $('#lampiranPreview').css('transform', 'scale(' + lampiranScale + ')');
        }

        function resetZoomLampiran() {
            lampiranScale = 1;
            $('#lampiranPreview').css('transform', 'scale(1)');
        }
    </script>
@endpush
