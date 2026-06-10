<?php

 $namaLapangan = '';
 $ketlapangan = '';
 $cabor = '';
 $ruangan = '';
 $lantai = '';
 $img = '';

 
 if(isset($_GET['ubah'])){
    $id = $_GET['ubah'];
    
    $query = "SELECT * FROM pilihanlapangan WHERE idPilihan = '$idPilihan';";
    $sql = mysqli_query($koneksi, $query);

    $result = mysqli_fetch_assoc($sql);

    $username = $result['username'];
    $password = $result['password'];
    $email = $result['email'];

    // var_dump($result);

    // die();
  }

?>

<html>
<head>
    <title>Form Registrasi</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css\style.regisPemandu.css">
</head>
<body>
    <h2>Form Registrasi</h2>
    <form method="POST" action="prosestambahlapangan.php" enctype="multipart/form-data">
        <input type="hidden" name="idFutsal" value="<?php echo isset($idFutsal) ? $idFutsal : ''; ?>" />

        <div class="mb-3 row">
            <label for="namaLapangan" class="col-sm-2 col-form-label">Nama Lapangan</label>
            <div class="col-sm-10">
                <input type="text" required name="namaLapangan" class="form-control" id="namaLapangan" value="<?php echo isset($namaLapangan) ? $namaLapangan : ''; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="cabor" class="col-sm-2 col-form-label">Cabor</label>
            <div class="col-sm-10">
                <input type="text" required name="cabor" class="form-control" id="cabor" value="<?php echo isset($cabor) ? $cabor : ''; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="ruangan" class="col-sm-2 col-form-label">Ruangan</label>
            <div class="col-sm-10">
                <select name="ruangan" required id="ruangan" class="form-select form-select-sm" aria-label=".form-select-sm example">
                    <option <?php if (isset($ruangan) && $ruangan == 'Indoor') { echo 'selected'; } ?> value="Indoor">Indoor</option>
                    <option <?php if (isset($ruangan) && $ruangan == 'Outdoor') { echo 'selected'; } ?> value="Outdoor">Outdoor</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="lantai" class="col-sm-2 col-form-label">Lantai</label>
            <div class="col-sm-10">
                <input type="text" required name="lantai" class="form-control" id="lantai" value="<?php echo isset($lantai) ? $lantai : ''; ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="ketlapangan" class="form-label">Keterangan</label>
            <textarea class="form-control" required name="ketlapangan" id="ketlapangan" rows="3"><?php echo isset($ketlapangan) ? $ketlapangan : ''; ?></textarea>
        </div>

        <div class="input-group mb-3">
            <label class="col-sm-2 col-form-label" for="foto">Foto</label>
            <div>
                <input type="file" class="form-control" name="img" id="foto" accept="image/*">
            </div>
        </div>

        <?php if (isset($_GET['ubah'])) { ?>
            <button type="submit" name="aksi" value="edit" class="btn btn btn-primary mb-3">
                <i class="fa fa-save" aria-hidden="true"></i>
                Simpan Perubahan
            </button>
        <?php } else { ?>
            <button type="submit" name="aksi" value="tambah" class="btn btn btn-primary mb-3">
                <i class="fa fa-plus" aria-hidden="true"></i>
                Submit
            </button>
        <?php } ?>

        <?php if (isset($_GET['ubah'])) { ?>
            <a href="pemandu.php" type="submit" class="btn btn btn-danger mb-3">
                <i class="fa fa-reply" aria-hidden="true"></i>
                Batal
            </a>
        <?php } else { ?>
            <a href="login.php" type="submit" class="btn btn btn-danger mb-3">
                <i class="fa fa-reply" aria-hidden="true"></i>
                Batal
            </a>
        <?php } ?>
    </form>
</body>
<script src="js/registrasiwisatawan.js"></script>
</html>
