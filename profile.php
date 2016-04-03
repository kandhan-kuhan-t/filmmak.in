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
      <form ng-submit="submit_profile()">
        <ul class="list-group">
          <li class="list-group-item">
            Profile name:
           <div ng-show="isEditable()">
             <input  type = "text" ng-model="profile_name"/>
           </div>
           <span ng-show="!isEditable()">
             {{profile_name}}
           </span>
         </li>
         <li class="list-group-item">
          Gender:
          <div ng-show="isEditable()">
           <input type="radio" name="gender" value="male" ng-model="gender" />Male
           <input type="radio" name="gender" value="female" ng-model="gender" />Female
           <input type="radio" name="gender" value="other" ng-model="gender" />Other
          </div>
          <span ng-show="!isEditable()">
            {{gender}}
          </span>
         </li>
         <li class="list-group-item">
            Field of Expertise:
      <div ng-show="isEditable()">
      <select name="fieldofexperise" ng-model="field_of_expertise">
      <option value="director">Director</option>
      <option value="actor">Actor</option>
      <option value="producer">Producer</option>
      <option value="cinematographer">Cinematographer</option>
      <option value="editor">Editor</option>
      <option value="sfx">SFX</option>
      <option value="lighting">Lighting</option>
      <option value="composer">Composer</option>
      <option value="singer">Singer</option>
      <option value="instrumentalist">Instrumentalist</option>
      <option value="scriptwriter">Scriptwriter</option>
    </select>
  </div>
  <span ng-show="!isEditable()">
    {{field_of_expertise}}
  </span>
         </li>
         <li class="list-group-item">
             Birth year:
      <div ng-show="isEditable()">
        <input type="number" name="birthyear" ng-model="birth_year" />
      </div>
      <span ng-show="!isEditable()">
        {{birth_year}}
      </span>
         </li>
         <li class="list-group-item">
            Birth Date:
      <div ng-show="isEditable()">
      <input type="number" name="birthdate" ng-model="birth_date" />
    </div>
    <span ng-show="!isEditable()">
      {{birth_date}}
    </span>
         </li>
         <li class="list-group-item">
            Prior Experience:
      <div ng-show="isEditable()">
      <input type="textarea" ng-model="experience" />
      </div>
      <span ng-show="!isEditable()">
        {{experience}}
      </span>
         </li>
         <li class="list-group-item">
             Tell about yourself in 100 words:
      <div ng-show="isEditable()">
      <input type="textarea" ng-model="about" />
    </div>
    <span ng-show="!isEditable()">
      {{about}}
    </span>
         </li>
        </ul>
    <div ng-show="isEditable()">
      <input type="submit" class="btn btn-default">
    </div>
    <div ng-show="!isEditable()">
          <button type="button" class="btn btn-edit" ng-click="edit()">Edit&nbsp;</button>
        </div>
    </form>
    </div>
      
  
    
    <div role="tabpanel" class="tab-pane tabclr" id="contact">
      <form>
       <ul class="list-group">
        <li class="list-group-item">
      Contact Number:
      <div ng-show="isEditable()">
      <input type="text" ng-model="contact_number"/>
      </div>
      <span ng-show="!isEditable()">
        {{contact_number}}
      </span>
      </li>
      <li class="list-group-item">
      Email-ID:
      <div ng-show="isEditable()">
        <input type="email" ng-model="email_id"/>
      </div>
      <span ng-show="!isEditable()">
        {{email_id}}
      </span>
    </li>
       </ul>
      </form>
    </div>
    </div>
    
  </div>

</div>



    </div>
   









     </div>
   </div>
  
    
  </body>
</html>