<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        exit;
    }


    $conn = mysqli_connect($db['host'], $db['user'],$db['password'],$db['name']);
    $userid=mysqli_real_escape_string($conn,$userid);
    $pacchettiid = urlencode($_GET["q"]);

    $query = "INSERT INTO carrello(user,pacchetti_c) VALUES ('$userid','$pacchettiid')";
    $res = mysqli_query($conn,$query);
?>