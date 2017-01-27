/**
 * Created by k-hei on 27/01/2017.
 */
(function () {
  'use strict';
  MaterateTest.controller("EditController", function ($scope, $state, $ionicPopup, UserModel, storage) {
    $scope.dataUser = storage.user.get();

    $scope.name = $scope.dataUser.name;
    $scope.email = $scope.dataUser.email;
    $scope.password = "";

    $scope.doEdit = function () {
      var data = {name: $scope.name, email: $scope.email, password: $scope.password};
      UserModel.edit(data, $scope.dataUser.id)
        .then(function (response) {
          storage.user.set({id: $scope.dataUser.id, name: $scope.name, email: $scope.email});
          $ionicPopup.alert({
            title: 'Yeah! :)',
            template: 'Dados alterados com sucesso!'
          }).then(function(){
            $state.go("home");
          });
        }).catch(function (err) {
        $ionicPopup.alert({
          title: 'Ops! :(',
          template: 'Usuário ou senha incorreta!'
        });
      });
    }
  });
})();

