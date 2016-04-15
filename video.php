<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/filmmak.in/conn.php";
$videoID = $_GET['videoID'];
$query = "select * from videos where videoID = '$videoID'";
$query_run = mysqli_query($conn,$query);
$result = mysqli_fetch_row($query_run);
$_SESSION['videoID'] = $_GET['videoID'];
$title = $result[2];
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
    <script src="jquery.js"></script>  
    <link href='https://www.google.com/fonts#QuickUsePlace:quickUse/Family:Pacifico' rel='stylesheet' type='text/css'>
    <!--ANGULARjs-->
    <script src="angular/angular.min.js"></script>    
    <script src="angular/angular-cookies.js"></script>
    <script src="angular/filmak.js"></script>
    <script src="angular/angular-cookies.js"></script>
    <style>body { padding-bottom: 70px; }</style>
  </head>
  <body ng-cloak>
  	<!--outer container for check - further will change it with col-sm-8 for ads-->
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


<div ng-controller="videoDetailsController as videoCtrl">

  <div class="container2">
    <div class="col-sm-12">
      <div class="col-sm-12">
        
        <div class="col-sm-12">
        <!--a href="#" class="thumbnail"><img class="img-responsive videopadd" src="vid.png" size="800px 500px"></a-->
        
          <!-- 16:9 aspect ratio -->
          <div class="embed-responsive embed-responsive-16by9">
         <iframe  src="https://www.youtube.com/embed/<?php echo $_GET['videoID'];?>?autoplay=1&rel=0" frameborder="0" allowfullscreen></iframe>
            </div>
          <!-- 4:3 aspect ratio >
              <div class="embed-responsive embed-responsive-4by3">
                   <iframe class="embed-responsive-item" src="..."></iframe>
              </div><-->
      
          <div class="col-sm-12 vidtext well">
        <strong><h4>{{title}}</h4></strong>
          <h5><mark>&nbsp;{{views}} Views&nbsp;</mark></h5>
          <!--<h6>Upvote/Downvote</h6>-->


      </div>


     <div class="col-sm-12 well bxclr">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs tabclr" role="tablist">
    <li role="presentation" class="active"><a href="#descrip" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
    <li role="presentation"><a href="#cast" aria-controls="cast" role="tab" data-toggle="tab">Cast</a></li>
    <li role="presentation"><a href="#other" aria-controls="other" role="tab" data-toggle="tab">Genre</a></li>
      </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active tabclr" id="descrip" style="color:white"><br/>&nbsp;&nbsp;{{description}}<br><br></div>
    
    <div role="tabpanel" class="tab-pane tabclr" id="cast" style="color:white">
      <br/>
      <a ng-repeat="filmak_user in filmak_users" ng-click="(goto_profile(filmak_user.member_name))">
        &nbsp;&nbsp;{{filmak_user.profile_name}}<br><br></a>

      <p ng-repeat="non_filmak_user in non_filmak_users" ng-click="showError()">
        &nbsp;&nbsp;{{non_filmak_user.member_name}}&nbsp;&nbsp;<br><br><span ng-bind-html="error"></span></p>
    
    </div>
    <div role="tabpanel" class="tab-pane tabclr" id="other" style="color:white"><br/>&nbsp;&nbsp;{{genre}}<br><br></div>
  </div>

</div>


          </div>
      

      </div>
       
    </div>




      



  </div>


</div><!--videoDetailsController ENDS-->




     </div>
   </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.js"></script>
  </body>
</html>
