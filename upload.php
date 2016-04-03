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
      <div class="col-sm-12">filmak.in</div>
      <a class="mix" href="home.html">
        <img src="logo.png" alt="brand">
      </a>
    </nav>
    </div>
<div class="container2 headclr">

    <div class="col-sm-12">
    
      <div class="box" align="center">
     <!--div class="box-title"><h3>LOGIN</h3></div-->
    <form ng-submit = "submit()" enctype="multipart/form-data">

    <div class="form-group">
      <label for="videoid">Video URL</label>
      <input type="text" class="form-control"  placeholder="VideoURL" ng-model="videoURL" required>
      <span>{{error}}</span>
    </div>
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control"  placeholder="Title" ng-model="title" required>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control"  rows="4" placeholder="Description" ng-model="description" required></textarea> 
    </div>
    <div class="form-group">
      <label for="genre">Genre</label>
      <input type="text" class="form-control"  placeholder="Genre" ng-model="genre" required>
    </div>
    <div class="form-group">
    <label for="exampleInputFile">Thumbnails</label>
    <input type="file" id="exampleInputFile" file-model="myFile" required>
    <p class="help-block">Poster/Screenshots of the film. Square sized images are prefered.</p>
  </div>
        <input type="submit" class="btn btn-default">
    </form>
  
  </div>
  
  </div>

</div>
</div><!-- videoCtrl ends-->
</body>