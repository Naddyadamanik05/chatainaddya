<?php include '_partials/_template/header.php';?>


<!-- FORM LOGIN -->
<div class="container mt-5" id="loginForm">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card p-4" 
           style="border-top: 4px solid rgb(214, 168, 214);
                  border-right: 4px solid purple; 
                  border-radius: 20px; 
                  background: rgb(245, 235, 250);">
        <h3 class="text-center" style="color: rgb(102, 51, 153);"><b>Login</b></h3>
        <form action="proses_login.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
          </div>
          <button type="submit" class="btn w-100" 
                  style="background: rgb(102, 51, 153); color: white;">
            Login
          </button>
        </form>
        <hr>
        <p>
          <b> belum punya akun? <a href="?page=register"> daftar disini </b> </a> </p> 
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"></script>
</body>
</html>
