<?php
    require_once 'auth.php';

    if (!checkAuth()) exit;

    header('Content-Type: application/json');

    weather();

    function weather() {
        $wea_key= 'f5bea9a7cd302abdca838d809883d3eb';

        $query = urlencode($_GET["q"]);
        $url = 'http://api.openweathermap.org/data/2.5/weather?q='.$query.'&appid='.$wea_key.'&units=metric';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $json = json_decode($data,true);
        curl_close($ch);

        echo json_encode($json);
    }

?>