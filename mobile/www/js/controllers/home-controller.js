/**
 * Created by k-hei on 27/01/2017.
 */
(function () {
  'use strict';
  MaterateTest.controller("HomeController", function ($scope, $state, storage, UserModel) {
    $scope.user = storage.user.get();
    $scope.sessions = [];

    $scope.username = $scope.user.name;

    UserModel.getSessions($scope.user.id)
      .then(function (data) {
        $scope.sessions = data;
      });

    $scope.out = function () {
      UserModel.logout($scope.user.id)
        .then(function () {
          $.jStorage.flush();
          $state.go('login', {}, {reload: true})
        });
    }
  });
})();
