<!DOCTYPE html>
<html lang="en">
<?php include_once './config.php'; 
if (isset($_POST['email'])){
    tambahEmailKeDatabase();
}

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Verifikasi Email</title>
</head>
<body>
   <div class="position-absolute top-50 start-50 translate-middle border border-2 rounded p-5 w-50">    
        <form action="" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Masukkan Email anda disini">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
   </div>
</body>
</html>