angular.module('filmak.in',['ngCookies'])
	
    .run(function(Auth,$sce,$rootScope){
		//RUNS BEFORE CONTROLLERS DO
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
    .controller('loginController',function($scope,$rootScope,$http,Auth,$cookies){
    
        console.log("LOGIN CONTROLLER RUNNING!");

        //Username,Password in login.html
        $scope.username;
        $scope.password;
        //data - js object to be sent to login.php for validation
      
        //login - cookie "logval" => "true" if user is valid else "false"
        $scope.login = function(){
            $scope.data = {
                
                'username' : $scope.username,
                'password' : $scope.password
            
            }
            
            Auth.login($scope.data)
        
         }

     })

    .controller('mainController',function($scope,$http,Auth,$cookies,$location,$sce,$window,$timeout){
         console.log("mainCtrl RUNNING")
            if(Auth.isLoggedIn() == true){
            $scope.name = $cookies.get('name')
            $scope.username = $cookies.get('username')
        }
                
            

             
            $scope.show = function(){

            return Auth.isLoggedIn()

        }
        $scope.search = function(){
            $window.location.href = 'search.php?search_string='+$scope.search_string
        }
        
        //logs out the user by deleting the cookie 
        $scope.logout = function(){
            console.log("LOGOUT FIRED")

            Auth.logout()

        }
        

       $scope.title = []

       $scope.videoID = []

        $http.post('data/get_video_details.php')
        .then(function(response){
            
            $scope.responses = response;

            console.log($scope.responses)

            /*for(i=0,l=$scope.responses.data.length;i<l;i++){

                $scope.title[i] = $scope.responses.data[i].title;
                $scope.videoID[i] = $scope.responses.data[i].videoID;
               
            }*/

        })


        

        
        
        
        
            
            


        $scope.goto_video = function(data){

            console.log("goto_video(data) working!")
            

            $window.location.href = 'video.php?videoID='+data
            


        }
    
            
        


    })
    .controller('formController',function($scope,$http,Profile,$rootScope, $window){
                

              console.log("formController RUNNING!")
              $scope.profile_name = $scope.name;
              $scope.username = {

                'username' : $scope.username
              
              }
              $scope.edit_val = false
            $scope.edit = function(){
                $scope.edit_val = true
            }
            $http.post("profile/fetch_user_data.php",$scope.username)
            .success(function(response){
               $scope.userData = response
           }).then(function(){
                $scope.username = $scope.userData.username
                $scope.profile_name = $scope.userData.name
                $scope.gender = $scope.userData.gender
                $scope.field_of_expertise = $scope.userData.field
                $scope.birth_year = Number($scope.userData.birth_year)
                $scope.birth_date = Number($scope.userData.birth_date)
                $scope.experience = String($scope.userData.experience)
                $scope.about = $scope.userData.about
                $scope.contact_number = $scope.userData.contact_number
                $scope.email_id = $scope.userData.email_id

               })
              

        
              //

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
                'username' :$scope.username,
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
    
    .controller('videoDetailsController',function($scope,$http,$cookies,$timeout,Video){

        console.log("videoDetailsController RUNNING!")
        $http.post('videoDetailsFetch.php')
        .then(function(response){
            console.log(response)
          $scope.title = response.data[0].title;
          $scope.description = response.data[0].description;
          $scope.views = response.data[0].views;
          $scope.genre = response.data[0].genre;
          $scope.videoID = response.data[0].videoID;
          $scope.casts = response.data[1].cast;
          for(cast in $scope.casts){
            console.log($scope.casts[cast])
          }

        })
        $timeout(function(){
            $scope.data = {
                'videoID' : $scope.videoID
            }
            console.log("TIMEOUT FIRED")
            Video.view_up($scope.data)
        },10000)




    })

    .controller('filmSubmissionController',function($scope,$http,Auth,$cookies,Youtube){
        console.log("videoCtrl RUNNING");
        
        $scope.videoID;
        $scope.title;
        $scope.description;
        $scope.genre;

         $scope.uploadFile = function(){
               var file = $scope.myFile;
               $scope.file = $scope.myFile
               console.log('file is ' );
               console.log($scope.file);
               
               var uploadUrl = "/fileUpload";

               var fd = new FormData();
               fd.append('file', file);
            
               $http.post('imageUpload.php', fd, {
                  transformRequest: angular.identity,
                  headers: {'Content-Type': undefined}
               })
            
               .success(function(response){
                console.log("IMAGE UPLOADED")
                console.log(response)
               })
           }
        $scope.submit = function(){
            $scope.

            $scope.data = {

            'username' : $cookies.get('username'),
            'videoID' : $scope.videoID,
            'title' : $scope.title,
            'description' : $scope.description,
            'genre' : $scope.genre

            }

            
            console.log($scope.data)

            $http.post('youtube/save_data.php',$scope.data)
            .success(function(response){
                if(response == 1){
                        console.log("VIDEO DETAILS ADDED TO MYSQL")
                       $scope.uploadFile()
             }
           
            }).then(function(){

                Youtube.duration($scope.data);

            })

            

        }

    })
 	

    .factory('Profile',function($http,$rootScope){

        var service = {}

        service.submit_profile = function(data){

            console.log("SUBMIT_PROFILE - PROFILE SERVICE")
            $http.post('profile/update_profile.php',data)
            .success(function(response){
                console.log(response)
            
                })
            
            }

        service.submit_contact = function(data){
            console.log("SUBMIT_CONTACT - profile service")
            $http.post('profile/update_contact.php',data)
            .success(function(response){
                console.log(response)
            })
        }    
        service.fetch_user_data = function(data){
            console.log("FETCHING USER DATA")
            $http.post("profile/fetch_user_data.php",data)
            .success(function(response){
               return response

            })

        }    
        return service

    })

    .factory('Auth',function($http,$rootScope,$cookies,$location,$window){
 		
        var service ={}
        
        service.login = function(data){
        
            console.log("SENDING DATA")
            var username = data.username
            $http.post('login/login.php',data)
            .success(function(response){
        
        //login.php returns 1 if the user is valid
        
                if(response[0] == '1'){
                    
                    console.log("LOGGED IN - COOKIE CREATED")

                    $cookies.put('logval','true')
                    $cookies.put('name',response[1])
                    $cookies.put('username',username)
                    //SHOULD BE REFRESHED!
                    $window.location.reload()
                    $window.location.href = 'home.html'
        
                }
        
                else{
                    
                    console.log("FALSE CREDENTIALS")
                    console.log(response)
                    $cookies.put('logval','false')
                }
            
            })
        
        }
        
        service.logout = function(){
        
            $cookies.remove('name')
            $cookies.remove('username')
            $cookies.remove('logval')
            $http.post('login/logout.php');

            console.log("LOGOUT")
        
        }
        
        service.isLoggedIn = function(){
        
            var logval = $cookies.get('logval');
            if(logval == 'true'){
                return true
            }
            return false
        
        }
        return service;
    })
    
    .factory('Youtube',function($http){

        var service = {}

        service.duration = function(data){

            $http.post('youtube_duration_fetch.php',data)
            .success(function(response){
                console.log(response)
            })
        }

        return service;

    })

    .factory('Video',function($http){

        var service = {}

        service.view_up = function(data){

            $http.post('video_view_up.php',data)
            .success(function(response){
                console.log(response)
            })
        }
        return service
    });

    