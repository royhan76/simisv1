<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class LaporanKeuanganExport implements FromArray, WithStyles, WithEvents, ShouldAutoSize
{
    protected $report;

    public function __construct(array $report)
    {
        $this->report = $report;
    }

    public function array(): array
    {
        $rows = $this->report['rows'] ?? [];
        $codes = collect($this->report['codes'] ?? []);
        $summary = $this->report['summary'] ?? [];

        $title = 'DATA PEMBAYARAN KOMPLEK A PP. MIS ' . ($summary['current_hijri_year'] ?? '');
        $result = [];

        $result[] = [$title];
        $result[] = [];
        $result[] = [
            'NO',
            'NAMA',
            'DB',
            'DU',
            'SARP B',
            'SARP L',
            'PENG B',
            'PENG L',
            'RJB',
            'KAL',
            'KTS',
            'SER',
            'SYAH',
            'JML',
            '',
            'UNIT PEMBAYARAN',
            'SATUAN',
            'NOMINAL',
            'JUMLAH',
        ];

        $maxRows = max(count($rows), $codes->count() + 1);

        for ($index = 0; $index < $maxRows; $index++) {
            $row = array_fill(0, 19, '');
            $data = $rows[$index] ?? null;
            $code = $codes[$index] ?? null;

            if ($data) {
                $row[0] = $data['no'] ?? $index + 1;
                $row[1] = $data['nama'] ?? '';
                $row[2] = $data['db'] ? '✓' : '';
                $row[3] = $data['du'] ? '✓' : '';
                $row[4] = $data['sarp_b'] ? '✓' : '';
                $row[5] = $data['sarp_l'] ? '✓' : '';
                $row[6] = $data['peng_b'] ? '✓' : '';
                $row[7] = $data['peng_l'] ? '✓' : '';
                $row[8] = $data['rjb'] ? '✓' : '';
                $row[9] = $data['kal'] ? '✓' : '';
                $row[10] = $data['kts'] ? '✓' : '';
                $row[11] = $data['ser'] ? '✓' : '';
                $row[12] = (int) ($data['syah_count'] ?? 0) > 0
                    ? '✓ ' . (int) $data['syah_count']
                    : '';
                $row[13] = (int) ($data['jml'] ?? 0);
            }

            if ($code) {
                $row[15] = $code['label'] ?? '';
                $row[16] = (int) ($code['satuan'] ?? 0);
                $row[17] = (int) ($code['nominal'] ?? 0);
                $row[18] = (int) ($code['jumlah'] ?? 0);
            } elseif ($index === $codes->count()) {
                $row[15] = 'JUMLAH';
                $row[18] = (int) ($summary['total_nominal'] ?? 0);
            }

            $result[] = $row;
        }

        return $result;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 13,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
            3 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                $sheet->mergeCells('A1:S1');
                $sheet->getStyle('A1:S1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getRowDimension(1)->setRowHeight(24);
                $sheet->getRowDimension(3)->setRowHeight(22);

                $sheet->getStyle('A3:N3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'E2E8F0',
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '94A3B8'],
                        ],
                    ],
                ]);

                $sheet->getStyle('P3:S3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'E2E8F0',
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '94A3B8'],
                        ],
                    ],
                ]);

                $sheet->getStyle("A3:S{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CBD5E1'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle("A4:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("C4:N{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("P4:S{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("A4:A{$lastRow}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $sheet->getStyle("B4:B{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $sheet->getStyle("B4:B{$lastRow}")->getAlignment()->setWrapText(true);
                $sheet->getStyle("P4:P{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $sheet->getStyle("P4:P{$lastRow}")->getAlignment()->setWrapText(true);

                $sheet->getStyle("C4:K{$lastRow}")->getFont()->setBold(true);
                $sheet->getStyle("L4:L{$lastRow}")->getFont()->setBold(true);
                $sheet->getStyle("M4:M{$lastRow}")->getFont()->setBold(true);
                $sheet->getStyle("N4:N{$lastRow}")->getFont()->setBold(true);

                $sheet->getStyle("Q4:S{$lastRow}")
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');

                for ($row = 4; $row <= $lastRow; $row++) {
                    $isPaid = trim((string) $sheet->getCell("N{$row}")->getValue()) !== '';
                    if ($isPaid) {
                        $sheet->getStyle("A{$row}:N{$row}")->getFill()->setFillType(Fill::FILL_SOLID);
                        $sheet->getStyle("A{$row}:N{$row}")->getFill()->getStartColor()->setRGB('F0FDF4');
                    }
                }
            },
        ];
    }
}
