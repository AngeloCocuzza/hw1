<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect($db['host'], $db['user'],$db['password'],$db['name']);
    $userid=mysqli_real_escape_string($conn,$userid);
    $recensione = array();
    $query = "SELECT * FROM recensioni";
    $res_1 = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($res_1)) {
        $recensione[]=$row;
    } 
    mysqli_free_result($res_1);
    mysqli_close($conn);
    $newReview = json_encode($recensione);
    echo $newReview;
?>