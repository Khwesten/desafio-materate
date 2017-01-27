/**
 * Created by k-hei on 27/01/2017.
 */
(function () {
  'use strict';
  MaterateTest.controller("EditController", function ($scope, $state, $ionicPopup, UserModel, storage) {
    var dataUser = storage.user.get();

    $scope.name = dataUser.name;
    $scope.email = dataUser.email;
    $scope.password = "";

    $scope.doEdit = function () {
      var data = {name: $scope.name, email: $scope.email, password: $scope.password};
      UserModel.edit(data, dataUser.id)
        .then(function (response) {
          storage.user.set({id: dataUser.id, name: $scope.name, email: $scope.email});
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

