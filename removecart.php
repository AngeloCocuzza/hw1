<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        exit;
    }


    $conn = mysqli_connect($db['host'], $db['user'],$db['password'],$db['name']);
    $userid=mysqli_real_escape_string($conn,$userid);
    $pacchettiid = urlencode($_GET["q"]);

    $query = "DELETE FROM carrello WHERE user=$userid and pacchetti_c=$pacchettiid LIMIT 1";
    $res = mysqli_query($conn,$query);
?>