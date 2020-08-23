<?php

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        session_start();
        $_SESSION['username'] = $_POST['username'];
        header( "Location: signinpassword.html" );
    }
    else{
        header( "Location: signinusername.html" );
    }

?>