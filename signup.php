<?php
    require_once 'auth.php';

    if(checkAuth()) {
        header("Location: home.php");
        exit;
    }

    if (!empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["name"]) && 
    !empty($_POST["lastname"]) && !empty($_POST["confirm_password"]) && !empty($_POST["allow"]))
    {
        $error = array();
        $conn = mysqli_connect($db['host'], $db['user'], $db['password'], $db['name']) or die(mysqli_error($conn));

        if(strlen($_POST["password"]) < 7) {
            $error[] = "Caratteri non sufficienti";
        }
        if(strcmp($_POST["password"],$_POST["confirm_password"]) != 0) {
            $error[] = "La password non combacia";
        }
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if(mysqli_num_rows($res)>0) {
                $error[] = "Email già in uso";
            }
        }
        if(count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO users(name, lastname, email, password) VALUES ('$name','$lastname','$email','$password')";

            if (mysqli_query($conn, $query)) {
                $_SESSION["user_id"] = mysqli_insert_id($conn);
                
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione";
            }
        }

        mysqli_close($conn);
    } else if (isset($_POST["name"])) {
        $error = array("Riempi tutti i campi");
    }



?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Iscriviti a SicilyTravel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='signup.css'>
        <script src='signup.js' defer></script>
    </head>
    <body>
        <section>
        <h1>Crea il tuo account</h1>
        <form name='signup' method='post' enctype="multipart/form-data">
            <div class="name">
                <div><input type='text' name='name' placeholder="Nome" <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>></div>
            </div>
            <div class="lastname">
                <div><input type='text' name='lastname' placeholder="Cognome" <?php if(isset($_POST["lastname"])){echo "value=".$_POST["lastname"];} ?>></div>
            </div>
            <div class="email">
                <div><input type='text' name='email' placeholder="Email" <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></div>
            </div>
            <div class="password">
                <div><input type='password' name='password' placeholder="Password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
            </div>
            <div class="confirm_password">
                <div><input type='password' name='confirm_password' placeholder="Conferma Password" <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>></div>
            </div>
            <div class="allow"> 
                    <div><input type='checkbox' name='allow' value="1" <?php if(isset($_POST["allow"])){echo $_POST["allow"] ? "checked" : "";} ?>></div>
                    <div><label for='allow'>Acconsenti l'uso dei dati personali</label></div>
                </div>
            <div class="submit">
                <input type='submit' value="Registrati" id="submit" disabled>
            </div>
        </form>
        <div class="signup">Hai già un account? <a href="login.php">Accedi</a>
        </section>
    </body>

</html>