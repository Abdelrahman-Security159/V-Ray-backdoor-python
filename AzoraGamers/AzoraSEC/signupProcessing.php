<?php

    session_start();
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require "C:\\xampp\\composer\\vendor\\autoload.php";

    function generateVerifyCode(){
        $randArray = array(chr(rand(65, 90)), 
        chr(rand(65, 90)), 
        chr(rand(65, 90)), 
        chr(rand(65, 90)), 
        chr(rand(65, 90)), 
        chr(rand(65, 90)), 
        chr(rand(65, 90)), 
        chr(rand(65, 90)));

        return $randArray[0] . $randArray[1] . $randArray[2] . $randArray[3] . $randArray[4] . $randArray[5] . $randArray[6] . $randArray[7];
    }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $encArray = array("AzoraGamers in every where",
                        "Let us rent some games.",
                        "Try not to cheat :).",
                        "Try hack my mind :).",
                        "Farcry or Assassin's creed?",
                        "Battle field or Call of Duty?",
                        "Gamers are legends.",);

    $email    = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $decryptValue = $_POST["decryptValue"];

    // email is uniqe

    for($num = 0; $num < 7; $num++){
            if( $encArray[$num] == $decryptValue){                                                     // True
                // SQL Code...
                // Define DB, Table, Connection
                $db_user  = "db_users";
                $db_table = "tb_gamers";
                $connection = mysqli_connect("localhost", "root", "", $db_user);                       // True

                if($connection){

                    // Define SQL query
                    $sqlCode = "INSERT INTO " . $db_table . " (email, password, username) VALUES ('" .
                    $email . "', '" . $password . "', '" . $username . "');";



                    // Perform querys and check from any error

                    $checkTableEmailQuery = "SELECT email FROM " . $db_table . 
                    " WHERE email = '" . $email . "';";

                    $checkTableUsernameQuery = "SELECT username FROM " . $db_table . 
                    " WHERE username = '" . $username . "';";




                    // Get String from DB and change it to array

                    $resultUsername = mysqli_query($connection, $checkTableUsernameQuery);
                    $getRowUsername = mysqli_fetch_array($resultUsername, MYSQLI_ASSOC);


                    $resultEmail = mysqli_query($connection, $checkTableEmailQuery);
                    $getRowEmail = mysqli_fetch_array($resultEmail, MYSQLI_ASSOC);





                    // Excute query

                    try{
                        if(!(isset($getRowEmail['email']) || isset($getRowUsername["username"]))){                              // Hide worning message
                            if(mysqli_query($connection, $sqlCode)){  
                                $verifyStr = generateVerifyCode();

                                $mail = new PHPMailer(true);
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                                $mail->isSMTP();                                            // Send using SMTP
                                $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                $mail->Username   = '**************************';           // SMTP username
                                $mail->Password   = '&&&&&&&&&&&';                          // SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                            
                                //Recipients
                                $mail->setFrom('abdelrahman.sec9@gmail.com');
                                $mail->addAddress($email, "Gamer");                         // Add a recipient
                            
                                // Content
                                $mail->Subject = 'Verifing the mail';
                                $mail->Body = 'Your verification code is : ' . $verifyStr;
                                
                                $checkMail = $mail->send();
                                if($checkMail){

                                    $updateVerifyCode = "UPDATE " . $db_table . 
                                                        " SET verify = '" . $verifyStr . 
                                                        "' WHERE username='" . $username . "' AND password='$password'"; 
                                    
                                    $_SESSION["email"] = $email;

                                    if(mysqli_query($connection, $updateVerifyCode)){

                                        mysqli_close($connection);
                                        header( "Location: signupSucc.html" );

                                    }
                                    else{
                                        header( "Location: signupError.html" );
                                        mysqli_close($connection);

                                    }
                                    
                                    
                                }
                                
                             }
                             else{
                                header( "Location: signupError.html" );
                             }
                        }
                        else{
                            header( "Location: signupError.html" );
                        }
                        break;
                    }catch (Exception $e){
                         //echo $e;
                    }
     
            }
            elseif (6 == $num) {
                header( "Location: signupError.html" );
            }
        }
    }
}
else{
    echo "[-] Error with POST method.";
}
?>
