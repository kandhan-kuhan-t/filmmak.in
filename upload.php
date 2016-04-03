<?php
session_start();
if(!$_SESSION['username']){
  header('location:home.html');
  die;
}
?>
<!DOCTYPE html>
<html lang="en" ng-app="filmak.in">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>filmak.in</title>
    <link rel="icon" href="fav.png" type="image/png" sizes="16x16">

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
  <div ng-controller="filmSubmissionController as filmCtrl">
    <div class="container-fluid">
      <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
      <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img src="logo.png" alt="brand">
      </a>
    </div>
    
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control sharp" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default sharp">Submit</button>
        </form>
      </div>
    </div>
<div class="container2 headclr">

    <div class="col-sm-12">
		
		<form ng-submit = "submit()" style = "color:red" enctype="multipart/form-data">
         

videoID:<input type = "text" ng-model = "videoID"/>
title:<input type = "text" ng-model = "title"/>
description:<input type = "text" ng-model = "description"/>
genre:<input type = "text" ng-model = "genre"/>
<br>
Image:<input type="file" file-model="myFile" />


<input type = "submit"/>
		
		</form>	
	
	</div>

</div>
</div><!-- videoCtrl ends-->
</body>