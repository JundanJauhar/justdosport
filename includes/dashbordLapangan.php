<!DOCTYPE html>

<?php
    include '../server/koneksi.php';

    $query = "SELECT * FROM pilihanlapangan;";
    $sql = mysqli_query($koneksi, $query);
    $no = 0;

    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/table.css"> <!-- Custom styling for the table -->
</head>
<body>


<div class="container mt-4">
    <div class="row">
        
        <div class="col-md-9">

            <div class="mb-3">
                <?php if (isset($_GET['ubah'])) : ?>
                    <a href="tambahlapangan.php" class="btn btn-primary">
                        <i class="fa fa-pencil"></i> Simpan Perubahan
                    </a>
                <?php else : ?>
                    <a href="tambahlapangan.php" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambahkan
                    </a>
                <?php endif; ?>
            </div>

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama Lapangan </th>
                        <th>Keterangan </th>
                        <th>Cabang Olahraga</th>
                        <th>Ruangan</th>
                        <th>Lantai</th>
                        <th>Foto</th>
                        <th>Aksi</th>   
                    </tr>
                </thead>

                <tbody>
                    <?php while ($result = mysqli_fetch_assoc($sql)) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $result['namaLapangan']; ?></td>
                            <td><?php echo $result['ketlapangan']; ?></td>
                            <td><?php echo $result['cabor']; ?></td>
                            <td><?php echo $result['ruangan']; ?></td>
                            <td><?php echo $result['lantai']; ?></td>
                            <td><img src="<?php echo $result['img']; ?>" alt="" style="width: 150px"></td>
                            <td>
                                <a href="tambahlapangan.php?ubah=<?php echo $result['idPilihan']; ?>" class="btn btn-primary">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <a href="prosestambahlapangan.php?hapus=<?php echo $result['idPilihan']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut???')">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


</body>
</html>
