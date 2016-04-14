<?php
session_start();
if(isset($_SESSION['username'])){
  echo '<script>alert("Already Logged in")</script>';
  header('location:home.html');
}
?>
<!DOCTYPE html>
<html lang="en" ng-app="filmak.in">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="google-signin-client_id" content="719229338900-2o1tlht9lbr9vielvdfhug5psfn029ul.apps.googleusercontent.com">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>filmak.in</title>
    <link rel="icon" href="fav.png" type="image/png" sizes="16x16">

    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/main.css" rel="stylesheet">
    <!--jQuery-->
    <script src="jquery.js"></script>  
    <script src="bootstrap/js/bootstrap.js"></script>
    <link href='https://www.google.com/fonts#QuickUsePlace:quickUse/Family:Pacifico' rel='stylesheet' type='text/css'>
    
    <style>body { padding-bottom: 70px; }</style>
 
    <!--ANGULARjs-->
    <script src="angular/angular.min.js"></script>    
    <script src="angular/angular-cookies.js"></script>
    <script src="angular/filmak.js"></script>
    <script src="angular/angular-cookies.js"></script>
    
  </head>
  <body ng-cloak>
<!-- FORMAT IT ANAND -->
  <div ng-controller="loginController as loginCtrl">
    <div class="container-fluid">
      <nav class="navbar navbar-default navbar-fixed-top">
      <div class="col-sm-12"><br></div>
      <a class="mix" href="home.html">
        <img src="logo.png" alt="brand">
      </a>
    </nav>
    </div>
 <div class="container2 headclr">

    <div class="box" align="center">
     <!--div class="box-title"><h3>LOGIN</h3></div-->
    <form ng-submit="login()">
  <div class="form-group">
    <label for="Username">Username(your gmail address)</label>
    <input type="email" class="form-control"  placeholder="Username" ng-model="username">
  </div>
        <div class="form-group">
    <label for="Password">Password</label>
    <input type="password" class="form-control"  placeholder="Password" ng-model="password">
  </div>
        <input type="submit" class="btn btn-default">
    </form>
   <br>
    <h6>New to Filmak.in? Click to signup via Google+</h6>
    <!--Add a button for the user to click to initiate auth sequence -->
    

      <!--button class="btn btn-default"-->
   <div ng-controller="googleController as googleCtrl">
      <div class="g-signin2" data-onsuccess="onSignIn"></div>
   
     <!--/button-->
   </div>
  
  </div>

</div>


  </div><!--loginCtrl ENDS-->
</body>