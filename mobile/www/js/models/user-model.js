/**
 * Created by k-hei on 27/01/2017.
 */
(function () {
  'use strict';
  MaterateTest.factory('UserModel', function ($http, endPoint) {

    var basePath = 'user';

    var endpointLogin = endPoint.url.stage + basePath;

    return new function () {
      this.login = function (data) {
        return $http.post(endpointLogin + "/login", data)
          .then(function (response) {
            return response.data;
          });
      };

      this.register = function (data) {
        return $http.post(endpointLogin + "/register", data)
          .then(function (response) {
            return response.data;
          });
      };

      this.edit = function (data, id) {
        return $http.put(endpointLogin + "/edit/" + id, data)
          .then(function (response) {
            return response.data;
          });
      };
    };
  });
})();
