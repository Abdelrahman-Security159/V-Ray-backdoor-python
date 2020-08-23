<?php

    if(isset($_COOKIE["username"])){
      
      

    }
    else{
      header( "Location: signinusername.html" );
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>AzoraSEC</title>
    <link rel="icon" href="image/AzoraICON.png">
  	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/signup.css">
  </head>
  <body>
                                            <!-- Nav Start-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark navfix">
    <a class="navbar-brand" href="index.html"><img class="imgsize" src="image/AzoraICON.png"></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signup.html">Sign up</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signinUsername.html">Sign in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
    </div>
  </nav>
                                          <!-- Nav End-->

    <script type="text/javascript" src="jQuiry.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
</html>