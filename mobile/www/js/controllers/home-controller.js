/**
 * Created by k-hei on 27/01/2017.
 */
(function () {
  'use strict';
  MaterateTest.controller("HomeController", function ($scope, storage) {

    var user = storage.user.get();

    $scope.username = user.name;
  });
})();
