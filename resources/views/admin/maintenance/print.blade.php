<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Laporan Maintenance' }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 24px;
        }

        p.center {
            text-align: center;
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .badge {
            padding: 3px 8px;
            border: 1px solid #000;
            border-radius: 4px;
            font-size: 12px;
        }

        .footer {
            margin-top: 50px;
            width: 100%;
        }

        .footer div {
            width: 30%;
            float: right;
            text-align: center;
        }

        @media print {
            body {
                margin: 15px;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <!-- Judul -->
    <h2>LAPORAN MAINTENANCE MESIN</h2>
    <p class="center">Tanggal Cetak: {{ now()->format('d M Y H:i:s') }}</p>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Mesin</th>
                <th width="12%">Tipe</th>
                <th width="12%">Tanggal Maintenance</th>
                <th width="20%">Teknisi</th>
                <th width="13%">Biaya (Rp)</th>
                <th width="13%">Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maintenances as $index => $maintenance)
                <tr>
                    <td>{{ $index + 1 }}</td>

                    <!-- Mesin -->
                    <td class="text-left">
                        {{ $maintenance->machine->name ?? 'Mesin #' . $maintenance->machine_id }}
                        @if ($maintenance->machine->code)
                            <br><small>({{ $maintenance->machine->code }})</small>
                        @endif
                    </td>

                    <!-- Tipe Maintenance -->
                    <td>
                        @if ($maintenance->maintenance_type == 'preventive')
                            <span class="badge" style="background-color: #d4edda; color: #155724;">Preventive</span>
                        @else
                            <span class="badge" style="background-color: #f8d7da; color: #721c24;">Corrective</span>
                        @endif
                    </td>

                    <!-- Tanggal -->
                    <td>
                        {{ $maintenance->maintenance_date->format('d M Y') }}
                    </td>

                    <!-- Teknisi -->
                    <td class="text-left">
                        {{ $maintenance->technician->name ?? 'Tidak ditentukan' }}
                    </td>

                    <!-- Biaya -->
                    <td class="text-right">
                        {{ number_format($maintenance->cost ?? 0, 0, ',', '.') }}
                    </td>

                    <!-- Dibuat -->
                    <td>
                        {{ $maintenance->created_at->format('d M Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <div>
            <p>Mengetahui,</p>
            <br><br><br>
            <p><strong>(________________________)</strong></p>
            <p>Supervisor / Manajer</p>
        </div>
    </div>

</body>

</html>
