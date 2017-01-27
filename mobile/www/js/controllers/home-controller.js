/**
 * Created by k-hei on 27/01/2017.
 */
(function () {
  'use strict';
  MaterateTest.controller("HomeController", function ($scope, $state, storage) {
    $scope.user = storage.user.get();

    $scope.username = $scope.user.name;

    // location.reload();

    $scope.logout = function () {
      $.jStorage.flush();
      $state.go('login');
    }
  });
})();
