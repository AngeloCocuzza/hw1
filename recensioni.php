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
        
        if(!empty($_POST['title']) && !empty($_POST['review'])){
            
            $title = mysqli_real_escape_string($conn,$_POST['title']);
            $review = mysqli_real_escape_string($conn,$_POST['review']);
            $voto = mysqli_real_escape_string($conn,$_POST['voto']);
            
            $ID = null;
            $utente=null;
    
            $query2 = "SELECT *from users where id = '".$_SESSION['user_id']."'";
            $res = mysqli_query($conn, $query2) or die("Errore: ".mysqli_error($conn));
            while($row = mysqli_fetch_assoc($res)){
                $ID = $row['id'];
                $utente=$row['name']." ".$row['lastname'];

            }
    
            $query = "INSERT into recensioni(id_recensore,titolo,recensione,voto,utente) values ('$ID',\"$title\",\"$review\",\"$voto\",\"$utente\")";
            if(mysqli_query($conn,$query)){
                $posted = true;
            }
            else $posted=false;
            mysqli_close($conn);
    
        }
        //$cartinfo = json_encode($info);
    ?>

    


    <head>
        <meta charset="utf-8">
        <title>SicilyTravel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="recensioni.css">
        <script src="recensioni.js" defer></script>
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
                Quello che gli altri dicono di noi.<br>
                Se ti va lascia una recensione anche tu
            </h1>
        </header>
        <article>
        <div class="containerForm">
                <form name="reviewForm" id="reviewForm" method="post">
                    <label name="title"> Titolo Recensione(max 150 caratteri)</label>
                    <label><input type="text" id="title" name="title" placeholder="Scrivi il tuo titolo..."></label>
                    <label name="review">La tua Recensione (max 2000 caratteri)</label>
                    <label><textarea id="review" name="review" placeholder="Scrivi la tua recensione..." rows="7" cols="50"></textarea></label>
                    <label><span>Dai un voto alla tua esperienza con noi</span></label>
                    <label><select name='voto'>
                    <option value='1'>1/5</option>
                    <option value='2'>2/5</option>
                    <option value='3'>3/5</option>
                    <option value='4'>4/5</option>
                    <option value='5'>5/5</option>
    </select></label>
    <label> <input type="submit" id="submit" value="Invia la tua recensione"></label>
                </form>
            </div>

            <div class="sezioni">

            </div>

           
        </article>
        
        <footer>
            <p>Angelo Cocuzza id:1000001139</p>
            
            </div>
        </footer>
    </body>
</html>