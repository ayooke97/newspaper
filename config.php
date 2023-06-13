<?php

use React\EventLoop\Loop;

require __DIR__ . '/vendor/autoload.php';

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'subscribe';

try {
    $conn = mysqli_connect($host, $username, $password, $db);
    
    if ($conn->connect_error) {
        throw new Exception("Failed to connect to MySQL: " . $conn->connect_error);
    }
    // Connection successful, proceed with your database operations here
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    // Handle the error message as a string
    echo "Error: " . $errorMessage . '<br>';
}

function updateData($id)
{
    global $conn;
    $cekdatabase = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id = $id");
    $row = mysqli_fetch_assoc($cekdatabase);
    $tanggalKadaluwarsa = date_create($row['tanggal_kadaluwarsa']);
    $tanggalSekarang = date_create(date('d-M-Y H:i:s'));
    $sisa = $tanggalKadaluwarsa->diff($tanggalSekarang);

    if ($row['sisa_waktu'] != $sisa) {
        $query = "UPDATE pelanggan
        SET sisa_waktu = '{$sisa->s}', 
        WHERE id = {$row['id']}";
        $exc = mysqli_query($conn, $query);
        ob_start();
        include_once './contents.php';
        return $exc;
    }
}
function tambahEmailKeDatabase()
{
    global $conn;
    $email = $_POST['email'];
    // $durasi = $_POST['durasi'];
    // switch ($durasi){
    //     case '1 hari':
    //         $durasi = '+1 day';
    //         break;
    //     case '1 minggu':
    //         $durasi = '+1 week';
    //         break;
    //     case '1 bulan':
    //         $durasi = '+1 month';
    //         break;
    //     case '3 bulan':
    //         $durasi = '+3 months';
    //         break;
    //     case '6 bulan':
    //         $durasi = '+6 months';
    //         break;
    //     case '1 tahun':
    //         $durasi = '+1 year';
    //         break;
    // }
    date_default_timezone_set('Asia/Makassar');
    // $tanggalLangganan = new DateTime();
    // $formatTanggalLangganan = $tanggalLangganan->format('d-m-Y H:i:s');
    
    // $tanggalKadaluwarsa = (new DateTime())->modify('+30 seconds');
    // $formatTanggalKadaluwarsa = $tanggalKadaluwarsa->format('d-m-Y H:i:s');
    
    // $detik = $sisa->format('s');
    $tanggalLangganan = date_create(date('d-m-Y H:i:s'));
    $tanggal_langganan = date ('d');
    $bulan_langganan = date ('m');
    $tahun_langganan = date('Y');
    $tanggalKadaluwarsa = date('d-m-Y H:i:s', strtotime('55 hours'));
    $formatTanggalKadaluwarsa = date_create($tanggalKadaluwarsa);
    // $pisah1 = explode('-', $tanggalLangganan);
    // $pisah2 = explode('-', $tanggalKadaluwarsa);
    echo '<pre>';
    var_dump($tanggalLangganan);
    var_dump($formatTanggalKadaluwarsa);

    $sisa = date_diff($tanggalLangganan,$formatTanggalKadaluwarsa);
    echo "Sisa waktu berlangganan : " . $sisa->format('%r %y tahun %m bulan %d hari %h jam %i menit %s detik') . '<br>';
    $tampil_sisa = $sisa->format('%a hari %h jam %i menit %s detik');
    $pecah = explode(' ',$tampil_sisa);

    if ($pecah[0] == 0){
        if ($pecah[4] == 0){
            $tampil_sisa = $sisa->format('%h jam');
        }
        else if ($pecah[4] > 0){
             $tampil_sisa = $sisa->format('%h jam %i menit');
        }
        if ($pecah[2] == 0) {
            $tampil_sisa = $sisa->format('%i menit %s detik');
            if ($pecah[4] == 0){
                $tampil_sisa = $sisa->format('%s detik');
                if ($pecah[6] == 0) {
                    $tampil_sisa = 'Waktu Habis';
                }
                
            }
        }
    }
    else{
        $tampil_sisa = $sisa->format('%a hari');
    }


    // if($pecah[0] < 1){
    //     if ($pecah[2])
    //     $tampil_sisa = $sisa->format('%h jam %i menit');

    // }
    // else if ($pecah[2] < 1) {
    //     $tampil_sisa = $sisa->format('%i menit %s detik');
    // }
    // else if ($pecah[4] < 1){
    //     $tampil_sisa = $sisa->format('%s detik');
    // }
    // else if ($pecah[4] && $pecah[6] == 0){
    //     $tampil_sisa = 'Waktu Habis';
    // }
    
    echo $tampil_sisa;
    echo '</pre>';
    die;

    // $tanggal_kadaluwarsa = date('d',strtotime($durasi));
    // $bulan_kadaluwarsa = date('m',strtotime($durasi));
    // $tahun_kadaluwarsa = date('Y',strtotime($durasi));
    // $tanggalKadaluwarsa = date('d m Y H:i:s', strtotime('+'));
    // $sisa = (int)(date('s',strtotime('+30 seconds'))) - (int)date('s');

    // echo("Waktu tersisa : <br>" . var_dump($sisa)) ; die;
    // $selisih = $tanggalKadaluwarsa->diff($tanggalLangganan);
    // $cal1 = IntlCalendar::fromDateTime($tanggalLangganan,'Asia/Makassar');
    // $cal2 = IntlCalendar::fromDateTime($tanggalKadaluwarsa,'Asia/Makassar');
    // echo IntlDateFormatter::formatObject($cal1, 'd MMMM YYYY HH:mm:ss VVVV', 'id_ID'), "<br>";
    // echo IntlDateFormatter::formatObject($cal2, 'd MMMM YYYY HH:mm:ss VVVV', 'id_ID'), "<br>";
    global $conn;
    $checkdata = "SELECT * FROM pelanggan WHERE email = '$email'";
    $exc = mysqli_query($conn, $checkdata);
    if (mysqli_num_rows($exc) > 0) {
        
        include_once './index.php';
        // $mail->msgHTML(file_get_contents('contents.php'), __DIR__);        
        // header('Location: https://mail.google.com/mail/u/0/#inbox');
    } else {
        $query = "INSERT INTO pelanggan (id, email, tanggal_langganan, bulan_langganan, tahun_langganan, tanggal_kadaluwarsa, bulan_kadaluwarsa, tahun_kadaluwarsa, sisa_waktu_hari, sisa_waktu_jam, sisa_waktu_menit, sisa_waktu_detik) VALUES ('','$email','$tanggal_langganan', '$bulan_langganan','$tahun_langganan','$tanggal_kadaluwarsa','$bulan_kadaluwarsa','$tahun_kadaluwarsa')";
        $exc = mysqli_query($conn, $query);
        if ($exc) {
            echo "<script type='text/javascript'>alert('Data berhasil dibuat')</script>";
        }
        return $query;
    }
}
