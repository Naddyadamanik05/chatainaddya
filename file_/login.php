<?php

include '_partials/_template/header.php';
include 'Koneksi.php';

// Proses login jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Query untuk mencari pengguna berdasarkan email
  $stmt = $conn->prepare("SELECT id, fullname, email, password, role_id FROM tb_users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();
      // Verifikasi password
      if (password_verify($password, $user['password'])) {
          // Simpan data pengguna ke session
          $_SESSION['user_id'] = $user['id'];
          $_SESSION['fullname'] = $user['fullname'];
          $_SESSION['email'] = $user['email'];
          $_SESSION['role_id'] = $user['role_id'];
          
          // Redirect berdasarkan role (opsional)
          if ($user['role_id'] == 2) { // Admin
              header("Location: index.php?page=admin_dashboard");
          }else { // User biasa
              header("Location: index.php?page=user_dashboard");
          }
          exit();
      } else {
          $error = "Invalid password!";
      }
  } else {
      $error = "Email not found!";
  }
  $stmt->close();
}



?>
<?php if (isset($error)): ?>
  <div class="alert alert-danger" role="alert">
    <?php echo $error; ?>
  </div>
<?php endif; ?>

<!-- Kolom Kanan: Form Login/Register -->
<div class="col-lg-4 d-flex align-items-center justify-content-center">
    <main class="form-signin w-75">
        <form action="" method="POST">
            <h1 class="h3 mb-3 fw-normal text-center">Login</h1>

            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                <label for="floatingInput">Email</label>
            </div>

            <div class="form-floating mt-2">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-1 mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>

            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Login</button>

            <div class="text-center mt-3">
                <p>Don't have an account? <a href="?page=register">Register here</a></p>
            </div>
        </form>
    </main>
</div>