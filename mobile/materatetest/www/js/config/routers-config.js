MaterateTest.config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider
        .state('login', {
            url: '/login',
            templateUrl: 'views/login.html',
            controller: 'LoginController'
        })
        .state('register', {
            url: '/register',
            templateUrl: 'views/register.html',
            controller: 'RegisterController'
        })
        .state('edit', {
            url: '/edit',
            templateUrl: 'views/edit.html',
            controller: 'EditController'
        })
        .state('home', {
            url: '/home',
            templateUrl: 'views/home.html',
            controller: 'HomeController'
        });

    $urlRouterProvider.otherwise('/login');
});
