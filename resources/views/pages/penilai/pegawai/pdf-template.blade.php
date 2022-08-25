<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
        }
        .styled-table {
            text-align: center;
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            border: 2px solid #dddddd;
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        .text-center {
            text-align: center !important;
        }

        .text-left {
            text-align: left !important;
        }

        .w-50 {
            width: 50%;
        }

        .w-100 {
            width: 100%;
        }

        .page-break {
            page-break-after: always;
        }
        .mb-2 {
            margin-bottom: 2rem;
        }
    </style>
</head>

<body>
    @foreach ($data as $index => $item)
        <div>
            <h1 class="text-center mb-2">Laporan Hasil Kegiatan</h1>
            <table>
                <tr>
                    <td>Nama Pegawai</td>
                    <td>:</td>
                    <td>{{ $item['employee_name'] }}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td>{{ $item['nip'] }}</td>
                </tr>
                <tr>
                    <td>Nama Penilai</td>
                    <td>:</td>
                    <td>{{ $item['evaluator_name'] }}</td>
                </tr>
            </table>
            <table class="styled-table">
                <tr>
                    <th>Kegiatan</th>
                    <th>Target</th>
                    <th>Kerjasama</th>
                    <th>Ketepatan Waktu</th>
                    <th>Kualitas</th>
                    <th>Hasil</th>
                </tr>
                @php
                    $rataRata = 0;
                    $total = 0;
                @endphp
                @foreach ($item['activities'] as $activity)
                    @php
                        $hasil =($activity['target'] * 40) / 100 + ($activity['kerjasama'] * 10) / 100 + ($activity['ketepatan_waktu'] * 40) / 100 + ($activity['kualitas'] * 10) / 100; 
                        $total += $hasil;
                    @endphp
                    <tr>
                        <td class="text-left">{{ $activity['activity_name'] }}</td>
                        <td>{{ $activity['target'] }}</td>
                        <td>{{ $activity['kerjasama'] }}</td>
                        <td>{{ $activity['ketepatan_waktu'] }}</td>
                        <td>{{ $activity['kualitas'] }}</td>
                        <td>{{ $hasil  }}
                        </td>
                    </tr>
                    @php
                    @endphp
                @endforeach
                <tr>
                    <td colspan="5">Rata-rata</td>
                    <td>{{ $total / count($item['activities']) }}</td>
                </tr>
                <tr>
                    <td colspan="5">Total</td>
                    <td>{{ $total }}</td>
                </tr>
            </table>



            <div style="margin-top: 100px;">
                <table class="text-center w-100">
                    @php
                        \Carbon\Carbon::setLocale('id');
                    @endphp
                    <tr>
                        <td class="w-50">
                            <p>Subang, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
                            <p style="margin-top: -15px">Yang bertanda tangan</p>
                            <img src="{{ asset('assets/dist/img/ttd(1).png') }}" class="img-circle" alt="User Image">

                            <p>Arbrian Abdul Jamal</p>
                        </td>
                        <td class="w-50">
                            <p>&nbsp;</p>
                            <p style="margin-top: -15px">Yang bertanda tangan</p>
                            <img src="https://paragram.id/upload/media/entries/2019-07/31/9317-1-7454c0792fd0bc375015427933ee39c4.jpg"
                                width="100px">
                            <p>Arbrian Abdul Jamal</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @if (!$loop->last)
        <div class="page-break"></div>
        @endif
    @endforeach
</body>

</html>
