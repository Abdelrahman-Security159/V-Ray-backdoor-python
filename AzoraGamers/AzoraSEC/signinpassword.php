<?php

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        session_start();
        $username = $_SESSION['username'];
        $password = $_POST['password'];

        $mySQLcode = "SELECT username, password FROM tb_gamers WHERE username='$username' AND password='$password';";

        $connection = mysqli_connect("localhost", "root", "", "db_users");
        if(!$connection){
            die("[-] Connection was closed.");
        }

        $request  = mysqli_query($connection, $mySQLcode);
        $response = mysqli_fetch_array($request, MYSQLI_ASSOC);

        if(isset($response)){
            setcookie("username", $username, (time() + 7 * 24 * 60 * 60), "/");
            header( "Location: profile.php" );
        }
        else{
            header( "Location: signinusername.html" );
        }
    }
    else{
        header( "Location: signinusername.html" );
    }

?>