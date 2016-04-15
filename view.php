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
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-header">
      <a class="navbar-brand" href="home.html">
        <img src="logo.png" alt="brand">
      </a>
    </div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       </ul> 
      <form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <input type="text" class="form-control sharp" placeholder="{{placeholder_search}}" ng-model="search_string">
  </div>
  <button type="submit" class="btn btn-default sharp" ng-click = "search()">Submit</button>
  <br><br>
  <div align="center">
    Video&nbsp;<input type="radio" ng-model="searchType" name="searchType" value="video" checked />
  &nbsp;&nbsp;&nbsp;Profile&nbsp;<input type="radio" ng-model="searchType" value="profile" >
  </div>
  </form>
     
    <div class="top-mar">
                  <div ng-show="show()">
             <ul class="nav navbar-nav navbar-right"><li><div class="dropdown veralign" ><button class="btn btn-default dropdown-toggle sharp" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" overflow="hidden" >Hi {{name}} &nbsp;<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="profile.php">View profile</a></li><li><a ng-click="logout()">Logout</a></li><li><a href="upload.php">Upload</a></li></ul></div></li></ul>
           </div>
           <div ng-hide="show()">
            <ul class="nav navbar-nav navbar-right"><li><a href="signin.php" class="btn btn-default" type="button">Login/SignUp</a></li></ul>
          </div>
     </div>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cover Picture</h4>
      </div>
      <div class="modal-body">
        <img src="images/coverpic/{{username}}.jpg"  class="img-responsive">
      </div>
      </div>
  </div>
</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Profile Picture</h4>
      </div>
      <div class="modal-body" align="center">
        <img src="images/profilepic/{{username}}.jpg" class="img-responsive">
      </div>
      </div>
  </div>
</div>



<div class="container2">
<!--cover-->
  <div class="main">
    <div class="cover" data-toggle="modal" data-target="#myModal">
        <img src="images/coverpic/{{username}}.jpg" />
    </div>
    <div class="profile" data-toggle="modal" data-target="#myModal2">
      <!--size 200px * 200px-->
        <img src="images/profilepic/{{username}}.jpg" />
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