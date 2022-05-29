<?php 
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    $error='';

    if(!empty($_POST["email"]) && !empty($_POST["password"])) {
        $conn = mysqli_connect($db['host'],$db['user'],$db['password'],$db['name']) or die(mysqli_error($corr));

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT id, email, password FROM users WHERE email = '$email'";

        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if(mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);

            if (password_verify($_POST['password'], $entry['password'])) {
                $_SESSION["user_id"] = $entry['id'];
                

                header("Location: home.php");
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        $error = "Le credenziali inserite non sono corrette";
    } else if(isset($_POST["email"]) || isset($_POST["password"])) {
        $error = "Inserire tutti i campi";
    }
?>

<html>
    <head>
    <meta charset="utf-8">
        <title>Accedi a SicilyTravel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <section>
            <h1>Accedi a SicilyTravel</h1>
            <form name='login' method='post'>
                <div class='email'>
                    <div><input type="text" name='email' placeholder="Email" <?php if(isset($_POST["email"])) {echo "value=".$_POST["email"];} ?>></div>
                </div>
                <div class="password">
                    <div><input type='password' name='password' placeholder="Password" <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                </div>
                <div><p> <?php echo $error ?></p></div>
                <div>
                    <input type='submit' value="Accedi">
                </div>
            </form>
            <div class="signup"><a href="signup.php">Iscriviti a SicilyTravel</a>
        </section>
    </body>
</html>