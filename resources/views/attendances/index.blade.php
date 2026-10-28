<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Absensi - Absensi Digital</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f7fb;
            color: #1f2937;
        }

        .container {
            max-width: 1250px;
            margin: auto;
            padding: 35px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 6px;
        }

        .header p {
            color: #6b7280;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .filter {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .filter-group label {
            font-size: 13px;
            font-weight: bold;
            color: #6b7280;
        }

        input,
        select {
            padding: 11px 13px;
            border: 1px solid #d1d5db;
            border-radius: 9px;
            outline: none;
            min-width: 180px;
        }

        input:focus,
        select:focus {
            border-color: #4f46e5;
        }

        .btn {
            padding: 11px 18px;
            border: none;
            border-radius: 9px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: #111827;
            color: white;
        }

        .btn-reset {
            background: #f3f4f6;
            color: #374151;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            background: #f9fafb;
            color: #6b7280;
            font-size: 13px;
            text-align: left;
            padding: 15px;
        }

        td {
            padding: 16px 15px;
            border-top: 1px solid #eee;
            font-size: 14px;
        }

        .student-name {
            font-weight: bold;
            color: #111827;
        }

        .nis {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 3px;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .hadir {
            background: #dcfce7;
            color: #166534;
        }

        .izin {
            background: #fef3c7;
            color: #92400e;
        }

        .sakit {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .alpa {
            background: #fee2e2;
            color: #dc2626;
        }

        .empty {
            text-align: center;
            padding: 50px;
            color: #9ca3af;
        }

        .total {
            margin-bottom: 20px;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">

        <div>
            <h1>Data Absensi</h1>
            <p>Kelola dan pantau data kehadiran siswa</p>
        </div>

    </div>


    <div class="card">

        {{-- FILTER --}}

        <form
            action="{{ route('admin.attendances.index') }}"
            method="GET"
            class="filter"
        >

            <div class="filter-group">

                <label>Tanggal</label>

                <input
                    type="date"
                    name="tanggal"
                    value="{{ request('tanggal') }}"
                >

            </div>


            <div class="filter-group">

                <label>Status</label>

                <select name="status">

                    <option value="">
                        Semua Status
                    </option>

                    <option
                        value="hadir"
                        {{ request('status') == 'hadir' ? 'selected' : '' }}
                    >
                        Hadir
                    </option>

                    <option
                        value="izin"
                        {{ request('status') == 'izin' ? 'selected' : '' }}
                    >
                        Izin
                    </option>

                    <option
                        value="sakit"
                        {{ request('status') == 'sakit' ? 'selected' : '' }}
                    >
                        Sakit
                    </option>

                    <option
                        value="alpa"
                        {{ request('status') == 'alpa' ? 'selected' : '' }}
                    >
                        Alpa
                    </option>

                </select>

            </div>


            <div style="display:flex; align-items:end; gap:10px;">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Filter
                </button>

                <a
                    href="{{ route('admin.attendances.index') }}"
                    class="btn btn-reset"
                >
                    Reset
                </a>

            </div>

        </form>


        <div class="total">

            Menampilkan
            <strong>{{ $attendances->count() }}</strong>
            data absensi

        </div>


        {{-- TABLE --}}

        @if($attendances->count() > 0)

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Lokasi</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($attendances as $attendance)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <td>

                                    <div class="student-name">

                                        {{ $attendance->student->nama ?? '-' }}

                                    </div>

                                    <div class="nis">

                                        NIS:
                                        {{ $attendance->student->nis ?? '-' }}

                                    </div>

                                </td>


                                <td>

                                    {{ $attendance->student->classRoom->nama_kelas ?? '-' }}

                                </td>


                                <td>

                                    {{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}

                                </td>


                                <td>

                                    {{ $attendance->waktu ?? '-' }}

                                </td>


                                <td>

                                    @php
                                        $status = strtolower($attendance->status);
                                    @endphp

                                    <span class="badge {{ $status }}">

                                        {{ ucfirst($attendance->status) }}

                                    </span>

                                </td>


                                <td>

                                    {{ $attendance->qrLocation->nama_lokasi ?? '-' }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty">

                <h3>Belum ada data absensi</h3>

                <p>
                    Data absensi siswa akan muncul di halaman ini.
                </p>

            </div>

        @endif

    </div>

</div>

</body>
</html>