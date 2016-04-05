angular.module('filmak.in',['ngCookies'])
	
    .run(function(Auth,$sce,$rootScope,$http,$window){
		//RUNS BEFORE CONTROLLERS DOw
        console.log("FILMAK.IN RUNNING!")
     
        
       
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
   
        .success(function(){
    
            $window.location.href = 'register.html'
   
        })
    
    }
   
   window.onSignIn = onSignIn;
 
   
})

    .controller('registrationController',function($scope,$http,$window){

        $scope.profile_name;
        
        $scope.password;

        

        $scope.submit = function(){

            $scope.data = {

            'profile_name' : $scope.profile_name,

            'password' : $scope.password
        }

            $http.post('login/register_add_user.php',$scope.data)

                .success(function(response){

                $window.location.href = 'login.html'
                //console.log(response)
                })
        }
    
    })


    .controller('loginController',function($scope,$rootScope,$http,Auth,$cookies){
    
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
            
            $scope.search = function(){
            
                $scope.data = {
            
                     'search_string' : $scope.search_string
            
                }
            
                $http.post('data/put/put_search_string.php',$scope.data)
            
                    .success(function(response){
            
                         $window.location.href = "searchShow.html"
                    })
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
    
    .controller('formController',function($scope,$http,Profile,$rootScope, $window,$controller){
                
        
        console.log("formController RUNNING!")

       $scope.edit_val = false
                
        $scope.edit = function(){
                
            $scope.edit_val = true

        }

        
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
                        if(($scope.userData.birth_year))$scope.birth_year = Number($scope.userData.birth_year)
                        if($scope.userData.birth_date)$scope.birth_date = Number($scope.userData.birth_date)
                        if($scope.userData.experience)$scope.experience = String($scope.userData.experience)
                        if(($scope.userData.about))$scope.about = $scope.userData.about
                        if($scope.userData.contact_number)$scope.contact_number = $scope.userData.contact_number
                        if($scope.userData.email_id)$scope.email_id = $scope.userData.email_id
                    

                   })
             

        $scope.submit_contact = function(){
        
            console.log("CONTACT-SUBMITTED")
        
            $scope.data = {
        
                'contact_number': $scope.contact_number,
                'email_id': $scope.email_id
        
            }
        
            Profile.submit_contact($scope.data)
            
        }
            

        $scope.submit_profile = function(){
        
            console.log("PROFILE-SUBMITTED")
        
            $scope.data = {
        
                
                'profile_name': $scope.profile_name,
                'field': $scope.field_of_expertise,
                'birth_year': $scope.birth_year,
                'birth_date': $scope.birth_date,
                'experience': $scope.experience,
                'about': $scope.about,
                'gender':$scope.gender
        
            }
        
            Profile.submit_profile($scope.data)
            $scope.submit_contact()
            $window.location.reload()
        }
        
        $scope.isEditable = function(){
            
            return $scope.edit_val;
        }

    })
    
    .controller('videoDetailsController',function($scope,$http,$cookies,$timeout,Video,$window,$sce){

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
            console.log("NOT A MEMBER")
            $scope.error = $sce.trustAsHtml("Not a Member")
        }




    })

    .controller('viewController',function($scope,$http){

 
        $http.post('data/get/get_user_data_for_view.php')
        .success(function(response){

            console.log(response)
            $scope.profile = response;
            console.log($scope.profile)
            //$scope.profile_name = response.data.profile_name
        })
    })

    .controller('filmSubmissionController',function($scope,$http,Auth,$cookies,$window){
        
        console.log("filmSubmissionCtrl RUNNING");

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
        $scope.isMember;
        $scope.field;
        //Function to upload File. Fucked up two hours of life beyond anything
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
                    
                        return response
                        })
           
                }
                //frustation

                //Function to add video to database,calls uploadFile()
        $scope.submit = function(){
            
            //sanitize the videoURL to videoID
            var pos = String($scope.videoURL).indexOf('v=')

            $scope.videoID = $scope.videoURL.slice(pos+2)

            console.log($scope.videoID)

            $http.get(' https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id='+$scope.videoID+'&key=AIzaSyCF5LnKXJWU1uQRh3LgQLXo3VDF78Dfxz4')

                .success(function(response){
                    //if the id is valid
                    if(response.pageInfo.resultsPerPage == '1'){

                        $scope.data = {

                        
                            'videoID' : $scope.videoID,
                            'title' : $scope.title,
                            'description' : $scope.description,
                            'genre' : $scope.genre,
                            'duration' : response.items[0].contentDetails.duration

                    }
            
                        console.log($scope.data)
            
                        $http.post('data/put/put_video_details.php',$scope.data)
            
                            .success(function(response){
            
                                if(response == 1){
            
                                    console.log("VIDEO DETAILS ADDED TO MYSQL")
           
                                    
                                    $scope.uploadFile()
                                    //changes the upload_val to true so that isUploaded() returns true
                                    $scope.upload_val = true
                                    

                                    
        
                                }

                            })

                    }
                
                else{

                    $scope.error = "Invalid URL"
            
                    console.log($scope.error)
                }
            
            })
        
        }
        $scope.putUserIntoDb = function(){

             $http.post('data/put/cast_add.php',$scope.data)
                
                            .success(function(response){

                                console.log("CAST ADDED")

                            })
    } 
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

                        if(response == '1'){

                            $scope.putUserIntoDb();

                        }
                        else{

                            $scope.error_cast = "Invalid Username"
                        }

                    })

            }
            else{

                $scope.putUserIntoDb();
            }
        }
        
    })
 	

    .factory('Profile',function($http,$rootScope){

        var service = {}

        service.submit_profile = function(data){

            console.log("SUBMIT_PROFILE - PROFILE SERVICE")
            
            $http.post('data/put/update_profile.php',data)

            .success(function(response){
            
                console.log(response)
            
                })
            
            }

        service.submit_contact = function(data){
            
            console.log("SUBMIT_CONTACT - profile service")
            
            $http.post('data/put/update_contact.php',data)
            
            .success(function(response){
            
                console.log(response)
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

    .factory('Auth',function($http,$rootScope,$cookies,$location,$window){
 		
        var service ={}
        
        service.login = function(data){
        
            console.log("SENDING LOGIN CREDENTIALS")
            
            var username = data.username
            
            $http.post('login/login.php',data)
            
            .success(function(response){
        
            //login.php returns 1 if the user is valid
        
                if(response[0] == '1'){
                    
                    console.log("LOGGED IN")

                    //$cookies.put('logval','true')

                    //SHOULD BE REFRESHED!
                    
                    $window.location.href = 'home.html'

                    $window.location.reload()
        
                }
        
                else{
                    
                    console.log("FALSE CREDENTIALS")
                    console.log(response)
                    $cookies.put('logval','false')
                }
            
            })
        
        }
        
        service.logout = function(){
        
           
           
            $http.post('login/logout.php');

            $window.location.href = 'home.html'

            console.log("LOGOUT")
        
        }
        

        return service;
    })
    
    
    .factory('Video',function($http){

        var service = {}

        service.view_up = function(data){

            $http.post('data/video_view_up.php',data)
            
            .success(function(response){

                console.log(response)
            })
        }
        return service
    });

    