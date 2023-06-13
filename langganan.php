<!DOCTYPE html>
<html lang="en">
<?php
$langganan = base64_encode($_GET['subs']);
$harga = base64_encode($_GET['harga']);
$dlangganan = base64_decode($_GET['subs']);
$dharga = base64_decode($_GET['harga']);
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div id="read">
            <img src="./Hal 1.jpg" alt="" srcset=""><br>
        </div>
        <div class="info">
            <p style="text-align: center; font-size: 3rem">
                Sisa waktu : <br>
                <?php if ((isset($_GET['subs']) && $_GET['harga'])) : ?>
            <h1>
                <?= "{$langganan} : {$harga}" ?>
            </h1>
        <?php else : ?>
            <h1>WKWKWKWKW</h1>
        <?php endif ?>
        </p>
        <a href="./langganan.php"><img src="./qrcode.png" alt="" width="500" height="500"></a>

        </div>
    </div>
</body>

</html>