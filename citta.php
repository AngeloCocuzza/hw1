<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }

    $conn = mysqli_connect($db['host'], $db['user'],$db['password'],$db['name']);
    $userid=mysqli_real_escape_string($conn,$userid);
    $citta = array();
    $query = "SELECT * FROM citta";
    $res_1 = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($res_1)) {
        $citta[]=$row;
    } 
    mysqli_free_result($res_1);
    mysqli_close($conn);
    $newCitta = json_encode($citta);
    echo $newCitta;
?>