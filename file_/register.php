<?php
include '_partials/_template/header.php';
include 'Koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Sanitize input data
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
    $jenis_kelamin = filter_input(INPUT_POST, 'jenis_kelamin', FILTER_SANITIZE_STRING);
    $no_telp = filter_input(INPUT_POST, 'no_telp', FILTER_SANITIZE_STRING);
    $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = 1; // Default role ID, adjust as necessary
    $created_at = date('Y-m-d H:i:s');
    $update_at = date('Y-m-d H:i:s');

    

    // Check if email already exists
    $query_check = "SELECT * FROM tb_users WHERE email = ?";
    $stmt_check = $conn->prepare($query_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
      echo "<script> alert ('Maaf email sudah terdaftar');</script>";
      echo '<meta http-equiv="refresh" content="0.8; url=?page=register">';
  } else {
      // Insert data
      $query_insert = "INSERT INTO tb_users (fullname, email, password, jenis_kelamin, no_telp, alamat, image, role_id, create_at, update_at) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt_insert = $conn->prepare($query_insert);
      $stmt_insert->bind_param("ssssssisss", $fullname, $email, $password, $jenis_kelamin, $no_telp, $alamat,$image, $role_id, $created_at, $update_at);

        if ($stmt_insert->execute()) {
            echo "<script>alert('Daftar Berhasil, Silahkan Login !!');</script>";
            echo '<meta http-equiv="refresh" content="0.8; url=?page=login">';
        } else {
            echo "<script>alert('Terjadi kesalahan saat mendaftar: " . $stmt_insert->error . "');</script>";
        }
    }

    $stmt_check->close();
    $stmt_insert->close();
    $conn->close();
}
?>
<head>
    <link rel="stylesheet" href="././css/style.css">
</head>
<body style="background-color: beige;">
    <div class="container-fluid vh-90" style="margin-top: 5rem;">
        <div class="row h-100">
            <div class="col-lg-4 d-flex align-items-center justify-content-center">
                <main class="form-signin w-75">
                    <form method="POST" enctype="multipart/form-data">
                        <h1 class="h3 mb-3 fw-normal text-center">Register</h1>

                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                            <label for="email">Email</label>
                        </div>

                        <div class="form-floating mt-2">
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="name@example.com" required>
                            <label for="fullname">Username</label>
                        </div>

                        <div class="mt-2">
                            <div class="form-floating">
                                <select class="form-select" id="jenisKelamin" name="jenis_kelamin" required>
                                    <option selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-floating mt-2">
                            <input type="tel" class="form-control" id="no_telp" name="no_telp" placeholder="No_Handphone" required>
                            <label for="no_telp">No Handphone</label>
                        </div>

                        <div class="form-floating mt-2">
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                            <label for="alamat">Alamat</label>
                        </div>

                        <div class="form-floating mt-2">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>


                        <button class="btn btn-primary w-100 py-2 mt-3" type="submit" name="register">Register</button>

                        <div class="text-center mt-3">
                            Sudah memiliki akun? <a href="?page=login">Login</a>
                        </div>
                    </form>
                </main>
            </div>
        </div>
    </div>
</body>