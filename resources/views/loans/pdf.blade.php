<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loans Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Peminjaman Report</h2>
    <p>Periode: {{ \Carbon\Carbon::parse($request->start_date)->translatedFormat('l d-m-Y') }} Sampai {{ \Carbon\Carbon::parse($request->end_date)->translatedFormat('l d-m-Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Peminjam</th>
                <th>Nama Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $loan->user->name }}</td>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->created_at->format('Y-m-d') }}</td>
                <td>{{ $loan->return_date ?? '-' }}</td>
                <td>{{ $loan->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>