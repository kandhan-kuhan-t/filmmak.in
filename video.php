<?php
session_start();
$conn = mysqli_connect("localhost","root","Kandha26$","filmak");
$videoID = $_GET['videoID'];
$query = "select * from videos where videoID = '$videoID'";
$query_run = mysqli_query($conn,$query);
$result = mysqli_fetch_row($query_run);
echo '<script>console.log("'.$result[0].'")</script>';
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
      <div class="navbar-header">
      <a class="navbar-brand" href="#">
        <img src="logo.png" alt="brand">
      </a>
    </div>
    
        <form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Search">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
  </form>
  <div ng-controller="mainController as mainCtrl">
    <div ng-show="show()">
             <ul class="nav navbar-nav navbar-right"><li><div class="dropdown veralign" ><button class="btn btn-default dropdown-toggle sharp" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Hi{{name}}<span class="caret"></span></button><ul class="dropdown-menu"><li><a href="profile.php">View profile</a></li><li><a ng-click="logout()">Logout</a></li><li><a href="upload.php">Upload</a></li></ul></div></li></ul>
           </div>
           <div ng-hide="show()">
            <ul class="nav navbar-nav navbar-right"><li><a href="login.html" class="btn btn-default" type="button">Login</a></li></ul>
          </div>
            </div>
</nav>
</div>


<div ng-controller="videoDetailsController as videoCtrl">

  <div class="container2">
    <div class="col-sm-12">
      <div class="col-sm-12 vidcon well">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <!--a href="#" class="thumbnail"><img class="img-responsive videopadd" src="vid.png" size="800px 500px"></a-->
        
          <!-- 16:9 aspect ratio -->
         <iframe width="420" height="315" src="https://www.youtube.com/embed/<?php echo $_GET['videoID'];?>?autoplay=1" frameborder="0" allowfullscreen></iframe>
             
          <!-- 4:3 aspect ratio >
              <div class="embed-responsive embed-responsive-4by3">
                   <iframe class="embed-responsive-item" src="..."></iframe>
              </div><-->
          </div>
          <div class="col-sm-1"></div>
      </div>
      <br><br><br><br><br><br><br><br>
      <div class="col-sm-12 vidtext well">
        <h4>{{title}}<h4>
          <h5>{{views}} views<h5>
          <!--<h6>Upvote/Downvote</h6>-->
      </div>
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
    <div role="tabpanel" class="tab-pane active tabclr" id="descrip">{{description}}</div>
    
    <div role="tabpanel" class="tab-pane tabclr" id="cast"><div ng-repeat="cast in casts">{{cast}}</div></div>
 
    <div role="tabpanel" class="tab-pane tabclr" id="other">{{genre}}</div>
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