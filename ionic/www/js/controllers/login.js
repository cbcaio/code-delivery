angular.module('starter.controllers',[])
.controller('LoginCtrl',['$scope', 'OAuth', '$state','$ionicPopup', function($scope, OAuth, $state, $ionicPopup){

        $scope.user = {
            username: '',
            password: ''
        };

        $scope.state = $state.current;

        $scope.login = function (){
            OAuth.getAccessToken($scope.user)
                .then( function(data){
                    $state.go('home');
                }, function(responseError) {
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Login e/ou senha inválidos'
                    })
                    console.debug(responseError);
                });
        };
}]);