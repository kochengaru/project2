<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Peminjaman</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4"><b>Laporan Data Peminjaman Buku</b></h2>
        <table class="table table-bordered" align="center" rules="all" border="1px" style="width: 95%">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>ID Peminjaman</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>ID User</th>
                    <th>ID Buku</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $peminjam)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peminjam->id }}</td>
                        <td>{{ $peminjam->tanggal_pinjam }}</td>
                        <td>{{ $peminjam->tanggal_kembali }}</td>
                        <td>{{ $peminjam->id_user }}</td>
                        <td>{{ $peminjam->id_buku }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        // Automatically trigger print when the page loads
        window.onload = function() {
            window.print();
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
