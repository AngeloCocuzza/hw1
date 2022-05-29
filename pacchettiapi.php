<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect($db['host'], $db['user'],$db['password'],$db['name']);
    $userid=mysqli_real_escape_string($conn,$userid);
    $pacchetti = array();
    $query = "SELECT * FROM pacchetti";
    $res_1 = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($res_1)) {
        $pacchetti[]=$row;
    } 
    mysqli_free_result($res_1);
    mysqli_close($conn);
    $newpacchetti = json_encode($pacchetti);
    echo $newpacchetti;
?>