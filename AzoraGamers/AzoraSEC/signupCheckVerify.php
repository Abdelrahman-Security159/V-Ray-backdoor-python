<?php

    session_start();
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        if(isset($_SESSION["email"])){
            
            $tb_users = "tb_gamers";
            $sqlCode = "SELECT email FROM $tb_users " . 
            "WHERE email='" . $_SESSION['email'] . "' AND verify='" . $_POST["verifyInput"] . "';";

            echo $sqlCode;


            $connection  = mysqli_connect("localhost", "root", "","db_users");

            $resultEmail = mysqli_query($connection, $sqlCode);
            $getRowEmail = mysqli_fetch_array($resultEmail, MYSQLI_ASSOC);

            if(isset($getRowEmail["email"])){

                $getUP = "SELECT username, password FROM $tb_users ;";

                $resultUP    = mysqli_query($connection, $getUP);
                $getResultUP = mysqli_fetch_array($resultUP, MYSQLI_ASSOC);

                setcookie('username', $getResultUP['username'], time() + (86500 * 3));
                setcookie('password', $getResultUP['password'], time() + (86500 * 3));

                header( "Location: signinUsername.html" );

            }
            else{
                header( "Location: checkVerifyError.html" );
            }
        }
    }
    

?>