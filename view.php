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
              <div ng-show="show()">
             <ul class="nav navbar-nav navbar-right"><li><div class="dropdown veralign" ><button class="btn btn-default dropdown-toggle sharp" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Hi<span class="caret"></span></button><ul class="dropdown-menu"><li><a ng-click="logout()">Logout</a></li><li><a href="upload.php">Upload</a></li></ul></div></li></ul>
           </div>
           <div ng-hide="show()">
            <ul class="nav navbar-nav navbar-right"><li><a href="login.html" class="btn btn-default" type="button">Login</a></li></ul>
          </div>

         
  </div>
</nav>
</div>





<div class="container2">
<!--cover-->
  <div class="main">
    <div class="cover">
        <img src="cover.png" />
    </div>
    <div class="profile">
      <!--size 200px * 200px-->
        <img src="profile.png" />
    </div>
</div>
<!--tabs-->
<div ng-controller="formController" ng-cloak>

  <div class="col-sm-12 well bxclr">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs tabclr" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="Profile" role="tab" data-toggle="tab">Profile</a></li>
    
    <li role="presentation"><a href="#contact" aria-controls="conatactinfo" role="tab" data-toggle="tab">Contact Info</a></li>
    
      </ul>

  <!-- Tab panes -->

  
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active tabclr" id="profile">

      
     Profile name:
      
      <span style="color:red" ng-show="!isEditable()">
        {{profile_name}}
      </span>
      <br>
      
      Gender:
      
    <span ng-show="!isEditable()">
      {{gender}}
    </span>
    <br>

      Field of Expertise:
      
  <span ng-show="!isEditable()">
    {{field_of_expertise}}
  </span>
  <br>
      Birth year:
      
      <span ng-show="!isEditable()">
        {{birth_year}}
      </span>
<br>
      Birth Date:
     
    <span ng-show="!isEditable()">
      {{birth_date}}
    </span>
      <br>
      Prior Experience:
      
      <span ng-show="!isEditable()">
        {{experience}}
      </span>
      <br>
      Tell about yourself in 100 words:
   
    <span ng-show="!isEditable()">
      {{about}}
    </span>
    <br>
      
    


      
    </div>
    
    <div role="tabpanel" class="tab-pane tabclr" id="contact">
      
      Contact Number:
      
      <span ng-show="!isEditable()">
        {{contact_number}}
      </span>
      <br><br>

      Email-ID:
      
      <span ng-show="!isEditable()">
        {{email_id}}
      </span>
      
      



      

</div>
    </div>
    
  </div>

</div>



    </div>
   









     </div>
   </div>
  
    
  </body>
</html>