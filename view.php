<?php
session_start();
$_SESSION['view_username'] = $_REQUEST['username'];
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
    <!--FLEXSLIDER-->
    <link rel="stylesheet" href="slider/css/demo.css" type="text/css" media="screen">
    <link rel="stylesheet" href="slider/flexslider.css" type="text/css" media="screen">
    <script src="slider/js/modernizr.js"></script>  
    <!--ANGULARjs-->
    <script src="angular/angular.min.js"></script>    
    <script src="angular/angular-cookies.js"></script>
    <script src="angular/filmak.js"></script>
    <script src="angular/angular-cookies.js"></script>
    
  </head>
  <body ng-cloak>
    <!--outer container for check - further will change it with col-sm-8 for ads-->
    <div ng-controller="mainController as mainCtrl">
    <div class="container-fluid">
      <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
      <div class="navbar-header">
      <a class="navbar-brand" href="home.html">
        <img src="logo.png" alt="brand">
      </a>
    </div>
    
        <form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <input type="text" class="form-control sharp" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-default sharp" ng-click="search()">Submit</button>
    Video<input type="radio" ng-model="searchType" value="video">
  Profile<input type="radio" ng-model="searchType" value="profile">
  </form>
              <div ng-show="show()">
             <ul class="nav navbar-nav navbar-right"><li><div class="dropdown veralign" ><button class="btn btn-default dropdown-toggle sharp" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Hi {{name}} &nbsp;<span class="caret"></span></button><ul class="dropdown-menu"><li><a ng-click="logout()">Logout</a></li><li><a href="upload.php">Upload</a></li></ul></div></li></ul>
           </div>
           <div ng-hide="show()">
            <ul class="nav navbar-nav navbar-right"><li><a href="signin.php" class="btn btn-default" type="button">Login/SignUp</a></li></ul>
          </div>

         
  </div>
</nav>
</div>





<div class="container2">
<!--cover-->
  <div class="main">
    <div class="cover">
        <img src="images/coverpic/{{username}}" />
    </div>
    <div class="profile">
      <!--size 200px * 200px-->
        <img src="images/profilepic/{{username}}" />
    </div>
</div>
<!--tabs-->
<div ng-controller="viewController" ng-cloak>

  <div class="col-sm-12 well bxclr">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs tabclr" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="Profile" role="tab" data-toggle="tab">Profile</a></li>
    
    <li role="presentation"><a href="#contact" aria-controls="conatactinfo" role="tab" data-toggle="tab">Contact Info</a></li>
    
      </ul>

  <!-- Tab panes -->

  
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active tabclr" id="profile">
      <ul class="list-group">
          <li class="list-group-item">
            Profile name :
           <span>
               {{profile.profile_name}}
           </span>
         </li>
      <li class="list-group-item">
            Gender :
           <span>
             {{profile.gender|nullFilter}}
           </span>
         </li>
      <li class="list-group-item">
            Field of Expertise :
           <span>
              {{profile.field|nullFilter}}
           </span>
         </li>
         <li class="list-group-item">
            Date of Birth :
           <span>
               {{profile.dob|nullFilter}}
           </span>
         </li>
         <li class="list-group-item">
            Prior Experience :
           <span>
              {{profile.experience|nullFilter|negativeFilter}}
           </span>
         </li>
         <li class="list-group-item">
            About Myself:
           <span>
             {{profile.about|nullFilter}}
           </span>
         </li>
       </ul>
    </div>
    
    <div role="tabpanel" class="tab-pane tabclr" id="contact">
      
      <ul class="list-group">
          <li class="list-group-item">
            Contact number :
           <span ng-show = "isPublic()">
              {{profile.contact_number|nullFilter}}
           </span>
           <span ng-show = "!isPublic()">
            Not available
          </span>

         </li>
         <li class="list-group-item">
            Email ID :
           <span>
              {{profile.email_id|nullFilter}}
           </span>
         </li>
        </ul>
</div>
    </div>
    
  </div>

</div>



    </div>
   









     </div>
   </div>
  
    
  </body>
</html>