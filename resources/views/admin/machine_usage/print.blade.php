<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-left {
            text-align: left;
        }

        .footer {
            margin-top: 40px;
            width: 100%;
        }

        .footer div {
            width: 30%;
            float: right;
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">

    <!-- Judul -->
    <h2>LAPORAN MACHINE USAGE</h2>
    <p>Tanggal cetak: {{ now()->format('d M Y H:i') }}</p>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Machine</th>
                <th>Tanggal</th>
                <th>Jam Pakai</th>
                <th>Total Jam</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usages as $index => $usage)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">
                        {{ $usage->machine->name ?? '-' }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($usage->usage_date)->format('d M Y') }}
                    </td>
                    <td>{{ $usage->hours_used }} jam</td>
                    <td>{{ $usage->total_hours }} jam</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <div>
            <p>Mengetahui,</p>
            <br><br><br>
            <p>(___________________)</p>
        </div>
    </div>

</body>

</html>
