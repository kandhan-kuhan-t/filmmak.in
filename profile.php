<?php
session_start();
if(!$_SESSION['username']){
  header('location:signin.php');
  die();
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
      <a class="navbar-brand" href="home.html">
        <img src="logo.png" alt="brand">
      </a>
    </div>
    
        <form class="navbar-form navbar-left" role="search">
  <div class="form-group">
    <input type="text" class="form-control sharp" placeholder="Search" ng-model="search_string">
  </div>
  <button type="submit" class="btn btn-default sharp" ng-click="search()">Submit</button>
  <br/>
    Video<input type="radio" ng-model="searchType" value="video">
  Profile<input type="radio" ng-model="searchType" value="profile">
  </form>
              <div ng-show="show()">
             <ul class="nav navbar-nav navbar-right"><li><div class="dropdown veralign" ><button class="btn btn-default dropdown-toggle sharp" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >Hi {{name}} &nbsp;<span class="caret"></span></button><ul class="dropdown-menu"><li><a ng-click="logout()">Logout</a></li><li><a href="upload.php">Upload</a></li></ul></div></li></ul>
           </div>

         
  </div>
</nav>
</div>





<div class="container2">
<!--cover-->
  <div class="main">
    <div class="cover">
        <img ng-src="images/coverpic/{{username}}" />
    </div>
    <div class="profile">
      <!--size 200px * 200px-->
        <img ng-src="images/profilepic/{{username}}" />
    </div>
</div>
<!--tabs-->
<div ng-controller="formController" ng-cloak>

  <div class="col-sm-12 well bxclr">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs tabclr" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="Profile" role="tab" data-toggle="tab">Profile</a></li>
    
    <li role="presentation"><a href="#contact" aria-controls="conatactinfo" role="tab" data-toggle="tab">Contact Info</a></li>

    <li role="presentation"><a href="#picture" aria-controls="picture" role="tab" data-toggle="tab">Profile/Cover Photo</a></li>
    
      </ul>

  <!-- Tab panes -->


   
  
  <div class="tab-content">

    <div role="tabpanel" class="tab-pane active tabclr" id="profile">

            
            
      <form ng-submit="submit_profile()">
        <ul class="list-group">
          <li class="list-group-item">
           Full Name:
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
           <input type="radio" name="gender" value="Male" ng-model="gender" />Male
           <input type="radio" name="gender" value="Female" ng-model="gender" />Female
           <input type="radio" name="gender" value="Others" ng-model="gender" />Other
          </div>
          <span ng-show="!isEditable()">
            {{gender|nullFilter}}
          </span>
         </li>
         <li class="list-group-item">
            Field of Expertise:
      <div ng-show="isEditable()">
      <select name="fieldofexperise" ng-model="field_of_expertise">
      <option value="Director" selected>Director</option>
      <option value="Actor">Actor</option>
      <option value="Producer">Producer</option>
      <option value="Cinematographer">Cinematographer</option>
      <option value="Editor">Editor</option>
      <option value="Sfx">SFX</option>
      <option value="Lighting">Lighting</option>
      <option value="Composer">Composer</option>
      <option value="Singer">Singer</option>
      <option value="Instrumentalist">Instrumentalist</option>
      <option value="Scriptwriter">Scriptwriter</option>
    </select>
  </div>
  <span ng-show="!isEditable()">
    {{field_of_expertise|nullFilter}}
  </span>
         </li>
         <li class="list-group-item">
             Date Of Birth:
      <div ng-show="isEditable()">
        <input type="date" name="date_of_birth" ng-model="date_of_birth" />
      </div>
      <span ng-show="!isEditable()">
        {{date_of_birth|date:'dd-MM-yyyy'}}
      </span>
         </li>
         <li class="list-group-item">
            Number of Projects you have previously worked in:
      <div ng-show="isEditable()">
      <input type="textarea" ng-model="experience" />
      </div>
      <span ng-show="!isEditable()">
        {{experience|negativeFilter}}
      </span>
         </li>
         <li class="list-group-item">
             Describe about yourself in 100 words:
      <div ng-show="isEditable()">
      <textarea ng-model="about" rows="3" ></textarea>
    </div>
    <span ng-show="!isEditable()">
      {{about|nullFilter}}
    </span>
         </li>

        </ul>
            
    
    <!--/form-->
    </div>
      
  
    
    <div role="tabpanel" class="tab-pane tabclr" id="contact">
      <!--form-->
       <ul class="list-group">
        <li class="list-group-item">
      Contact Number:
      <div ng-show="isEditable()">
      <input type="text" ng-model="contact_number"/>
      Public:
      <input type="radio" ng-model="contact_number_access" name="contact_number_access" value="1"/>
      Private:
      <input type="radio" ng-model="contact_number_access" name="contact_number_access" value="0"/>
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
      <!--/form-->
     
    

    </div>
     <div ng-show="isEditable()">
      <input type="submit" class="btn btn-edit">
        <button type="button" class="btn btn-edit" ng-click="cancel()">Cancel</button>
    </div>
    </form>
    <div role="tabpanel" class="tab-pane tabclr" id="picture">
      <form ng-submit="profilepicUpload()"> 
            <input type="file" id="exampleInputFile" file-model="profilepic">
            <input type="submit" value="profilepic"/>
            </form>
            <form ng-submit="coverpicUpload()">
              <input type="file" id="exampleInputFile" file-model="coverpic">
              <input type="submit" value="coverpic"/>
            </form>
    </div>
    
    <div ng-show="!isEditable()">
          <button type="button" class="btn btn-edit" ng-click="edit()">&nbsp;Edit&nbsp;</button>

        </div>
    
  </div>

</div>



    </div>
   









     </div>
   </div>
  
    
  </body>
</html>