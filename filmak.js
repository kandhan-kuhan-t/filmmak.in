angular.module('filmak.in',['ngCookies','ngRoute'])
	
    .run(function(){
		//RUNS BEFORE CONTROLLERS DO
	})
    
    .controller('login',function($scope,$rootScope,$http,Auth,$cookies){
    
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

    .controller('mainController',function($scope,$http,Auth,$cookies){

                //function to return user's session state
        $scope.show = function(){

            return Auth.isLoggedIn()

        }
        
        //logs out the user by deleting the cookie 
        $scope.logout = function(){

            Auth.logout()

        }
        if(Auth.isLoggedIn() == true){
                $scope.username = 'kandha'
                $scope.data = {

                    'username' : $scope.username
                }

                console.log("I RUN WHEN YOURE VALID")
                $http.post('data/get_user_data.php',$scope.data)
                .success(function(response){
                   //populates the user details
                    $scope.username = response['name']
                                       
                })
        }


    })
 	

    .factory('Auth',function($http,$rootScope,$cookies,$location){
 		
        var service ={}
        
        service.login = function(data){
        
            console.log("SENDING DATA")
        
            $http.post('login/login.php',data)
            .success(function(response){
        
        //login.php returns 1 if the user is valid
        
                if(response == '1'){
                    
                    console.log("LOGGED IN - COOKIE CREATED")
                    $cookies.put('logval','true')
                  
                    $location.path('/')
        
                }
        
                else{
                    
                    console.log("FALSE CREDENTIALS")
                    console.log(response)
                    $cookies.put('logval','false')
                }
            
            })
        
        }
        
        service.logout = function(){
        
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
    

    .config(function($routeProvider){
    
            $routeProvider
            .when('/',{
                templateUrl:'index.html',
                controller:'mainController',
                controllerAs:'main'

            })
    
            .when('/login',{
                templateUrl:'login/login.html',
                controller:'login',
                controllerAs:'log'
    
            })
    
        });		
 	

	
	
    