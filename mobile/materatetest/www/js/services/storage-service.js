/**
 * Created by k-hei on 27/01/2017.
 */
(function () {
  'use strict';
  MaterateTest.factory('storage', function () {

    var _user = new function () {
      this.get = function () {
        var session = $.jStorage.get('user-session');
        if (session)
          return session;
      };
      this.set = function (data) {
        return $.jStorage.set('user-session', data);
      };
    };

    return {
      user: _user
    };
  });
})();
