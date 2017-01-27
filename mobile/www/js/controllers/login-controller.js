/**
 * Created by k-hei on 27/01/2017.
 */
(function () {
  'use strict';
  MaterateTest.controller("LoginController", function ($scope, $state, $ionicPopup, UserModel, storage) {
    $scope.email = "";
    $scope.password = "";

    $scope.doLogin = function () {
      var access = {email: $scope.email, password: $scope.password};
      UserModel.login(access)
        .then(function (response) {
          storage.user.set(response);
          $state.go("#home");
        }).catch(function (err) {
        $ionicPopup.alert({
          title: 'Ops! :(',
          template: 'Usuário ou senha incorreta!'
        });
      });
    }
  });
})();

