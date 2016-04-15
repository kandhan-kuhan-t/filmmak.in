angular.module('filmak.in',['angular-flexslider'])
    
    .run(function($http){
        //RUNS BEFORE CONTROLLERS DO
        console.log("FILMAK.IN RUNNING!")
        $http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

    })
    .directive('fileModel', ['$parse', function ($parse) {
            
            return {
            
               restrict: 'A',
            
               link: function(scope, element, attrs) {
            
                  var model = $parse(attrs.fileModel);
            
                  var modelSetter = model.assign;
                  
                  element.bind('change', function(){
            
                     scope.$apply(function(){
            
                        modelSetter(scope, element[0].files[0]);
            
                     });
            
                  });
            
                  }
            
            };
        
        }])
    

    .controller('googleController', function($scope,$http,$window) {
    
    function onSignIn(googleUser) {
    
        var profile = googleUser.getBasicProfile();
    
    //console.log('ID: ' + profile.getId());
    
    //console.log('Name: ' + profile.getName());
    
    //console.log('Image URL: ' + profile.getImageUrl());
    
        $scope.data = {
    
        'username' : profile.getEmail()
    }
        
    
   
        $http.post('login/register_user.php',$scope.data)
   
        .success(function(response){

            if(response['status'] == 1){
    
                $window.location.href = 'register.html'

            }
            else{

               
            }
   
        })
    
    }
    
   
   window.onSignIn = onSignIn;
 
   
})

    .controller('registrationController',function($scope,$http,$window){

        $scope.profile_name;
        
        $scope.password;

        $scope.confirm_password;

        

        $scope.submit = function(){

            $scope.data = {

            'profile_name' : $scope.profile_name,

            'password' : $scope.password,

            'display_name': $scope.profile_name.indexOf(" ")!=-1?$scope.profile_name.substring(0,$scope.profile_name.indexOf(" ")):$scope.profile_name

            }

            if($scope.password == $scope.confirm_password){

            $http.post('login/register_add_user.php',$scope.data)

                .success(function(response){

                $window.location.href = 'signin.php'
                //console.log(response)
                })
        }
        else{

            alert("Passwords do not match")
        }
    }
    
    })


    .controller('loginController',function($scope,$rootScope,$http,Auth){
    
        console.log("LOGIN CONTROLLER RUNNING!");

        $scope.login = function(){
            
            $scope.data = {
                
                'username' : $scope.username,
                'password' : $scope.password
            
            }
            
            Auth.login($scope.data)
        
         }

     })

    .controller('mainController',function($scope,$http,Auth,$location,$sce,$window,$timeout){
         
         console.log("mainCtrl RUNNING")
            //fetch user data
            $http.post('data/check_if_user_loggedIn.php')
            .success(function(response){
                if(response == '1')
                    $scope.log_val = true
            

                $http.post('data/get/get_user_data.php')
                    
                    .then(function(response){
                        console.log(response)
                    
                        $scope.username = response.data[0]
                        $scope.name = response.data[1]
                        
                
                })
                })

            
                
            $scope.show = function(){

                return $scope.log_val
            }

            $scope.placeholder_search = "Search"
            $scope.searchType = "video"
            
            $scope.search = function(){
            
            $scope.data = {
            
                     'search_string' : $scope.search_string
            
                }
                if($scope.search_string){
                if($scope.searchType == "video"){

                $scope.data.searchType = $scope.searchType
                console.log($scope.data)    
            
                $http.post('data/put/put_search_string.php',$scope.data)
            
                    .success(function(response){

                        console.log(response)
                         $window.location.href = "searchShow.html"
                    })
                }
                else if($scope.searchType == "profile"){

                    $scope.data.searchType = $scope.searchType
                    $http.post('data/put/put_search_string.php',$scope.data)
            
                    .success(function(response){

                        console.log(response)
                         $window.location.href = "searchProfile.html"
                    })

                }
            }
        
        else{

            $scope.placeholder_search = "Enter Something To Search For!"
        }
    }
        
        //logs out the user by calling the Auth.logout() Service
        
        $scope.logout = function(){
            
            console.log("LOGOUT FIRED")

            $scope.log_val = false

            Auth.logout()


        }
        
        $scope.title = []

        $scope.videoID = []

        $http.post('data/get/get_video_details_new.php')
            
            .then(function(response){
            
                $scope.responses_new = response;

                console.log($scope.responses_new)
        
        })
        $http.post('data/get/get_video_details_trending.php')
            
            .then(function(response){
            
                $scope.responses_trending = response;

                console.log($scope.responses_trending)
        
        })
        $http.post('data/get/get_video_details_popular.php')
            
            .then(function(response){
            
                $scope.responses_popular = response;

                console.log($scope.responses_popular)
        
        })

            $scope.goto_video = function(data){

            console.log("goto_video(data) working!")
            

            $window.location.href = 'video.php?videoID='+data
            
            }
    
            
    })

    .controller('searchController',function($scope,$http,$window){

        console.log("searchController RUNNING")
        
            $http.post('data/get/get_search_results.php')
                .success(function(response){
                        console.log(response)
                        $scope.responses = response;
            

                    })
        
    })

    //profile controller
    
    .controller('formController',function($filter,$scope,$http,Profile,$rootScope, $window,$controller,$q,$location){
        
        console.log("formController RUNNING!")

       $scope.edit_val = false
$scope.dont_show = false
$scope.editable = function(){

           
            $scope.dont_show=false

        }
        $scope.noneditable = function(){
            
            $scope.dont_show = true 
            
        }
                
        $scope.edit = function(){
                  
            $scope.edit_val = true


        }
        //yyyy-MM-DD
        
        var getUserData = function()    {
            $http.post("data/get/get_user_data_for_profile.php")

            .success(function(response){

                $scope.userData = response               
    
            })
                    .then(function(){
                        console.log($scope.userData)
                       
                
                        $scope.username = $scope.userData.username
                        $scope.profile_name = $scope.userData.profile_name
                    
                        $scope.gender = $scope.userData.gender
                        $scope.field_of_expertise = $scope.userData.field
                        $scope.userData.dob?$scope.date_of_birth = new Date($scope.userData.dob):$scope.date_of_birth = ' '
                        $scope.experience = String($scope.userData.experience)
                        $scope.about = $scope.userData.about
                        $scope.contact_number = $scope.userData.contact_number
                        $scope.email_id = $scope.userData.email_id
                        $scope.contact_number_access = $scope.userData.access
                        console.log($scope.userData.dob)
                    

                   })
                }
                getUserData()
             
        $scope.cancel = function(){

            getUserData()
            $scope.edit_val = false
            
            
        }
        $scope.submit_contact = function(){
        
            console.log("CONTACT-SUBMITTED")
        
            $scope.data = {
        
                'contact_number': $scope.contact_number,
                'email_id': $scope.email_id,
                'access' : $scope.contact_number_access
        
            }
        
            Profile.submit_contact($scope.data)
$window.location.reload()
            
        }
            

        $scope.submit_profile = function(){
        
            console.log("PROFILE-SUBMITTED")

        
            $scope.data = {
        
                
                'profile_name': $scope.profile_name,
                'field': $scope.field_of_expertise,
                'date_of_birth': $filter('date')($scope.date_of_birth,'short','+0530'),
                'experience': $scope.experience,
                'about': $scope.about,
                'gender':$scope.gender
        
            }
        
            Profile.submit_profile($scope.data)
            console.log($scope.data)
            $scope.submit_contact()
            
        }
        
        $scope.isEditable = function(){
            
            return $scope.edit_val;
        }

$scope.profilepicDeferred = $q.defer();
        $scope.profilepicPromise = $scope.profilepicDeferred.promise;
        $scope.profilepicUpload = function(){

        
        

               var file = $scope.profilepic
               
               $scope.file = $scope.profilepic
               
               console.log('file is ' );
               
               console.log($scope.file);
               
               var uploadUrl = "/fileUpload";

               var fd = new FormData();
               
               fd.append('file', file);
               
               fd.append('username',$scope.username)

               fd.append('type',"profile")
            
             
              
                $http.post('data/put/upload_profile_cover_pic_to_server.php', fd, {
               
                  transformRequest: angular.identity,
               
                  headers: {'Content-Type': undefined}
               
               })
            
                .success(function(response){
                        
                        console.log("IMAGE UPLOADED")
                        console.log(response)
                        
                        if(response.status == '1')
                        $scope.profilepicDeferred.resolve("1")
                        else
                        $scope.profilepicDeferred.reject(response.status)    
                        //$scope.upload_image = true                    
                        
                        })
           
                }
             
             $scope.profilepicPromise
                .then(function(data){
                    $window.location.reload()
                },
                function(error){ 
                    console.log(error)                         
                    alert(error)
                })
                                                                        
                             
                                                                   
 $scope.coverpicDeferred = $q.defer()
             $scope.coverpicPromise = $scope.coverpicDeferred.promise;             
        $scope.coverpicUpload = function(){


               var file = $scope.coverpic
               
               $scope.file = $scope.coverpic
               
               console.log('file is ' );
               
               console.log($scope.file);
               
               var uploadUrl = "/fileUpload";

               var fd = new FormData();
               
               fd.append('file', file);
               
               fd.append('username',$scope.username)
            
               fd.append('type',"cover")
              
                $http.post('data/put/upload_profile_cover_pic_to_server.php', fd, {
               
                  transformRequest: angular.identity,
               
                  headers: {'Content-Type': undefined}
               
               })
            
                .success(function(response){
                        
                        console.log("IMAGE UPLOADED")
                        console.log(response)
                        
                        if(response.status == '1')
                        $scope.coverpicDeferred.resolve("1")
                        else
                        $scope.coverpicDeferred.reject(response.status)    
                        //$scope.upload_image = true                    
                        
                        })
           
                }
                $scope.coverpicPromise
                    .then(function(data){
                        $window.location.reload()
                    },
                    function(error){
                        console.log(error)
                        alert(error)
                    })
        

                


        

    })
    
    .controller('videoDetailsController',function($scope,$http,$timeout,Video,$window,$sce){

        console.log("videoDetailsController RUNNING!")

        $http.post('data/get/get_video_details_for_userClicked.php')
        .then(function(response){
            console.log(response)
          $scope.title = response.data[0].title;
          $scope.description = response.data[0].description;
          //console.log(response.data[0].description)
          $scope.views = response.data[0].views;
          $scope.genre = response.data[0].genre;
          $scope.videoID = response.data[0].videoID;

          
        
      })
        //fetches CastDetails
        $http.post('data/get/get_cast_details_for_userClicked.php')
        .then(function(response){
            //data[1] - filmak users
            console.log(response.data[1])
            $scope.filmak_users = response.data[1]
            //data[0] - non-filmak users
            console.log(response.data[0])
            $scope.non_filmak_users = response.data[0]
        })
      
          
        
       
        $timeout(function(){
       
            $scope.data = {
       
                'videoID' : $scope.videoID
            }
            console.log("TIMEOUT FIRED")
            Video.view_up($scope.data)
        },30000)

        $scope.goto_profile = function(username){

            $window.location.href = "view.php?username="+username
        }
        $scope.showError = function(){
            //show error for 5 seconds.
            $scope.error = $sce.trustAsHtml("not a member")
            $timeout(function(){
                $scope.error = ''
            },2000)
        }




    })

    .controller('viewController',function($scope,$http){

        $scope.public_val = 0

        $scope.isPublic = function(){

        console.log($scope.public_val)
        return $scope.public_val

        }

        
        $http.post('data/get/get_user_data_for_view.php')
        .success(function(response){

            console.log(response)
            $scope.profile = response;
            $scope.profile.dob = new Date(response.dob)
            console.log($scope.profile)
            
            if(response.access == '1'){$scope.public_val = 1}
            //$scope.profile_name = response.data.profile_name
        })

    })

    .controller('filmSubmissionController',function($scope,$http,Auth,$window,$q,$sce){
        
        console.log("filmSubmissionCtrl RUNNING");

        $scope.deferred = $q.defer();
        $scope.promise = $scope.deferred.promise;

        $scope.upload_val = false
        //If the video has been uploaded,returns true. Cast details to be submitted then.
        $scope.isUploaded = function(){

            return $scope.upload_val
        }

        //Video Details
        $scope.videoURL;
        $scope.title;
        $scope.description;
        $scope.genre;
        //Cast Details
        $scope.member_name
        $scope.isMember=1;
        $scope.field="Director"
        $scope.placeholder_cast = "Enter the Filmak user's UserName(GMail address)"

        $scope.change = function(){
        $scope.isMember==1?$scope.placeholder_cast = "Enter the Filmak user's UserName(GMail address)":$scope.placeholder_cast = "Enter his/her name" 
        }//Function to upload File. Fucked up two hours of life beyond anything
         $scope.uploadFile = function(){
            
                   
               var file = $scope.myFile;
               
               $scope.file = $scope.myFile
               
               console.log('file is ' );
               
               console.log($scope.file);
               
               var uploadUrl = "/fileUpload";

               var fd = new FormData();
               
               fd.append('file', file);
               
               fd.append('videoID',$scope.videoID)
            
             
              
                $http.post('data/put/upload_image_to_server.php', fd, {
               
                  transformRequest: angular.identity,
               
                  headers: {'Content-Type': undefined}
               
               })
            
                .success(function(response){
                        
                        console.log("IMAGE UPLOADED")
                        console.log(response)
                        
                        if(response.status == '1')
                        $scope.deferred.resolve("1")
                        else
                        $scope.deferred.reject(response.status)    
                        //$scope.upload_image = true                    
                        
                        })
           
                }
                //frustation


                //Function to add video to database,calls uploadFile()
        $scope.submit = function(){
            
            //sanitize the videoURL to videoID
            var pos = String($scope.videoURL).indexOf('v=')

            $scope.videoID = $scope.videoURL.slice(pos+2)

            $http.get(' https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id='+$scope.videoID+'&key=AIzaSyCF5LnKXJWU1uQRh3LgQLXo3VDF78Dfxz4')

                .success(function(response){
                    console.log(response)
                    //if the id is valid
                    if(response.pageInfo.resultsPerPage == '1'){
                        var string = response.items[0].contentDetails.duration

                        var seconds = 0
                        var minutes = ''
                        var duration = 0
                        var i = 2
                        if(string[2] != 'S'||string[3] != 'S'){
                           while(string[i] != 'M'){
                                minutes = minutes + string[i]
                                i = i +1;
                            }
                            console.log("MINUTES"+minutes)
                            duration = Number(minutes)*60
                            i = i + 1
                        }
                        
                        while(string[i] != 'S'){
                            seconds = seconds + string[i]
                            i = i + 1
                        }
                        console.log("SECONDS"+seconds)
                        duration += Number(seconds)
                        console.log(duration)
                        

                        $scope.data = {

                        
                            'videoID' : $scope.videoID,
                            'title' : $scope.title,
                            'description' : $scope.description,
                            'genre' : $scope.genre,
                            'duration' : duration

                        }
            
                        console.log($scope.data)

                        var fd = new FormData();
                        var file = $scope.myFile;
               
                            fd.append('file', file);
               
                            $http.post('data/check_uploaded_image.php', fd, {
               
                                transformRequest: angular.identity,
               
                                headers: {'Content-Type': undefined}
               
                            })
            
                                .success(function(response){

                                    if(response['status'] == '1'){

                                           $http.post('data/put/put_video_details.php',$scope.data)
            
                                                .success(function(response){
            
                                                        if(response == 1){
            
                                                            console.log("VIDEO DETAILS ADDED TO MYSQL")
           
                                                            $scope.uploadFile()
                                    
                                                            $scope.promise

                                                                .then(function(data){
                                        
                                                                    $scope.upload_val = true
                                                    
                                                                },

                                                                    function(error){
                                                                        
                                                                        alert(error)
                                                                        $http.post('delete/delete_video.php');
                                   
                                                                    });
                                                        }//VIDEO CHECK IF
                                                        else{
                                                            $scope.error = "Video already added"
                                                        }
                                                })
                                    }//IMAGE SIZE CHECK IF
                                
                                    else{
                                    
                                        alert(response['status']+" Upload a picture of square dimensions")
                                    }

                                })

                        }//VIDEO URL CHECK IF
                        else{
                            alert("Video URL - Invalid")
                        }
            
            
                    })
        
        }
        $scope.putUserIntoDb = function(){

             $http.post('data/put/cast_add.php',$scope.data)
                
                            .success(function(response){

                 //               console.log("CAST ADDED")

                            })
    } 
        $scope.added_casts = [];
        $scope.add_cast = function(){

            $scope.data = {

                'member_name' : $scope.member_name,
                'field'    : $scope.field,
                'isMember'    :$scope.isMember
            }
            console.log($scope.data)
        

            if($scope.isMember == '1'){

                

                $http.post('data/check_if_user.php',$scope.data)

                    .success(function(response){

                        console.log($scope.data)

                        if(response['status'] == '1'){

                            $scope.putUserIntoDb();
                            $scope.added_casts.push(response['profile_name'])


                        }
                        else{

                            $scope.error_cast = "Invalid Username"
                        }

                    })

            }
            else{

                $scope.putUserIntoDb();
                $scope.added_casts.push($scope.member_name)
            }
            $scope.member_name =''
            $scope.field = ''
        }
        $scope.done = function(){
            $window.location.href = "home.html"
        }
        
    })

    .controller('passwordRecoveryController',function($scope,$http){

        $scope.username;
        $scope.submit = function(){
            $scope.data = {

                'username' : $scope.username
            }
        
            $http.post('data/passcode_gen.php',$scope.data)
                .then(function(response){
                    console.log(response)
                    if(response.data.status == 1){alert("Password reset link sent to your mail")}
                        else {alert(response.data.status)}
                })

        }

    })
    

    .factory('Profile',function($http,$rootScope){

        var service = {}

        service.submit_profile = function(data){

        //       console.log("SUBMIT_PROFILE - PROFILE SERVICE")
            
                $http.post('data/put/update_profile.php',data)

                    .success(function(response){
            
            //   console.log(response)
            
                    })
            
        }

        service.submit_contact = function(data){
            
            $http.post('data/put/update_contact.php',data)
            
                .success(function(response){
            //
            })
        }    
        service.fetch_user_data = function(data){
            
            console.log("FETCHING USER DATA")
            
            $http.post("data/get/get_user_data_for_profile.php",data)
            
            .success(function(response){
            
               return response

            })

        }    
        return service

    })

    .factory('Auth',function($http,$rootScope,$location,$window){
        
        var service ={}
        
        service.login = function(data){    
            
            $http.post('login/login.php',data)
            
                .success(function(response){
        
            //login.php returns 1 if the user is valid
        
                    if(response[0] == '1'){
                        
                        $window.location.href = 'home.html'

                    }
        
                    else{
                    
                   alert("Invalid Username (or) Wrong Password");
                
                    }
            
                 })
        
        }
        
        service.logout = function(){
        
           
           
            $http.post('login/logout.php')

                .then(function(){

                    $window.location.href = 'home.html'

                })
        }
        

        return service;
    })
    
    
    .factory('Video',function($http){

        var service = {}

        service.view_up = function(data){

            $http.post('data/video_view_up.php',data)
            
            .success(function(response){

                //console.log(response)
            })
        }
        return service
    })

    .config(function($httpProvider){

    })

    .filter('nullFilter',function(){

        return function(input){
            return input=='null'? " " : input
        }
    })
    .filter('negativeFilter',function(){

        return function(input){
            return input==0?" ":input
        }
    })



    