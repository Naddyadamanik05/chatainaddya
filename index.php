<?php 
// mengambil paramater 
$page = isset($_GET['page']) ? $_GET['page'] : 'home';


//fungsi untuk mengambil halaman 
function loadPage($page){
  if ($page === 'home'){
    include 'file_/home.php';
  }else if ($page === 'login'){
    include 'file_/login.php';
}else if ($page === 'register'){
    include 'file_/register.php';
  }else {
    include 'file_/not_found_1.php';
  }
}

loadPage($page);
?>