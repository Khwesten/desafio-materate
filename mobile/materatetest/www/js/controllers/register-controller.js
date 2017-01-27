/**
 * Created by k-hei on 27/01/2017.
 */
(function () {
  'use strict';
  MaterateTest.controller("RegisterController", function ($scope, $state, $ionicPopup, UserModel) {
    $scope.name = "";
    $scope.email = "";
    $scope.password = "";

    $scope.doRegister = function () {
      var access = {name: $scope.name, email: $scope.email, password: $scope.password};
      UserModel.register(access)
        .then(function (response) {
          $ionicPopup.alert({
            title: 'Yeah! :)',
            template: "Cadastro efetuado com sucesso!"
          }).then(function() {
            $state.go("login");
          });
        }).catch(function (err) {
          $ionicPopup.alert({
            title: 'Ops! :(',
            template: err.data
          });
      });
    }
  });
})();

