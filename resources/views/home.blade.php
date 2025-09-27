<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Persil</title>
    {{-- Bootstrap CSS (opsional, biar rapi) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Detail Data Persil</h3>
            </div>
            <div class="card-body">
                <table id="tabelPersil" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kode Persil</th>
                            <th>Pemilik</th>
                            <th>Luas</th>
                            <th>Penggunaan</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $kode_persil }}</td>
                            <td>{{ $pemilik }}</td>
                            <td>{{ $luas_m2 }} m²</td>
                            <td>{{ $penggunaan }}</td>
                            <td>{{ $alamat_lahan }} RT.{{ $rt }}/RW.{{ $rw }} </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    {{-- Bootstrap JS (opsional, kalau butuh interaktif) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    $(document).ready(function() {
        $('#tabelPersil').DataTable();
    });
</script>


</html>
