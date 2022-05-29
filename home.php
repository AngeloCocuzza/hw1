<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>


<html>
    <?php 
        $conn = mysqli_connect($db['host'], $db['user'],$db['password'],$db['name']);
        $userid=mysqli_real_escape_string($conn,$userid);
        $query = "SELECT * FROM users WHERE id= $userid";
        $res_1 = mysqli_query($conn, $query);
        $pacchetti = array();
        $userinfo = mysqli_fetch_assoc($res_1);   
        $query1 = "SELECT ROUND(sum(c.prezzo)) FROM carrello l, pacchetti c where c.id=l.pacchetti_c and l.user = $userid";
        $res_2= mysqli_query($conn,$query1);
        $info= mysqli_fetch_assoc($res_2); 

        //$cartinfo = json_encode($info);
    ?>


    <head>
        <meta charset="utf-8">
        <title>SicilyTravel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="home.css">
        <script src="home.js" defer></script>
    </head>
    <body>
        <header>
            <div id="Overlay"></div>
            <nav>
                <div id="logo">
                    SicilyTravel
                </div>
            <div id="links">
                <a href="home.php" <?php if(!isset($_GET['user'])) echo "class='here'"; ?>>Home</a>
                <a href="pacchetti.php">Pacchetti</a>
                <a href="carrello.php"><?php foreach($info as $value) {if(strcmp($value, '')==0){echo "0.00€";} else echo $value.".00€";}; ?><img src="images/carti.png"></a>
                <a href="recensioni.php">Recensioni</a>
                <a href="logout.php">Logout</a>
            </div>
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="hidden" id="mobile">

                <div>
                <a href="home.php" <?php if(!isset($_GET['user'])) echo "class='here'"; ?>>Home</a>
                <a href="pacchetti.php">pacchetti</a>
                <a href="carrello.php"><?php foreach($info as $value) {if(strcmp($value, '')==0){echo "0.00€";} else echo $value.".00€";}; ?><img src="images/carti.png"></a>
                <a href="recensioni.php">Recensioni</a>
               
                <a href="logout.php">Logout</a>
                <img class='elimina' src="images/x.png">
                </div>
            </div>
            </nav>
            <h1>
                <p>Benvenuto <?php echo $userinfo["name"]; ?>!</p>
                <strong>Ti trovi a Catania e vuoi visitare la sicilia?</strong><br>
                <em>Compra il tuo pacchetto All-inclusive per un tour guidato a prezzi stracciati.</em>
            </h1>
        </header>
        <article>
            

            <div id="desc">
                <p>
                    SicilyTravel fa tutto per te ,tu devi solo scegliere dove andare.
                </p>
                <p>
                    Cerca tra i nostri tour:
                </p>
            <div id="filter">
                <input type="text" name="" placeholder="Cerca">
            </div>

            </div>

            <div class="sezioni">
            </div>

            
        </article>
        
        <footer>
            <p>Angelo Cocuzza 
                Matricola:1000001139</p>
            
        </footer>
    </body>
</html>