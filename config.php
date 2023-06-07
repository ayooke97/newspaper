<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'jamu';
$conn = mysqli_connect($host,$username, $password, $db);

function tambahEmailKeDatabase() {
    $email = $_POST['email'];
    date_default_timezone_set('Asia/Makassar');
    $tanggalLangganan = date("d-m-Y H:i:s");
    $tanggalKadaluwarsa = date("d-m-Y H:i:s", strtotime('+2 years'));

    var_dump($tanggalLangganan);
    var_dump($tanggalKadaluwarsa);
    die;
    global $conn;
}

?>