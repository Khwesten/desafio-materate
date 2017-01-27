MaterateTest.run(function ($rootScope, $state) {

  $rootScope.$on("$stateChangeStart", function (event, next) {

    var session = $.jStorage.get('user-session');

    if (next.url) {
      var isNotAuthRoute = next.name != 'register' && next.name != 'login';

      if (isNotAuthRoute) {
        if (!session) {
          window.location.href = '/#/login';
        }
      }
    }
  });
});
