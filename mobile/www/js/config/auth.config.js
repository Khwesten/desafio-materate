MeuTutor.run(function ($rootScope, $http, $templateCache, $location, endPoint) {

    $rootScope.$on("$routeChangeStart", function (event, next) {

        var sub      =  window.location.hostname != 'mt-frontprova-stage.herokuapp.com' ? getSubdomain() : 'treinamento';

        // var sub = 'treinamento'

        var session  =  $.jStorage.get('session');
                        $.jStorage.set('subdomain', sub);

        getSchoolWithSubdomain(sub)
            .then(function (res) {
                var school = res;
                $.jStorage.set('logo', school.logo);
            }).catch(function (err) {
                if( window.location.hostname != 'mt-frontprova-stage.herokuapp.com') window.location.href = 'http://www.meututor.com.br';
        });
        if (next.$$route) {

            var rules = next.$$route.originalPath != '/register' &&
                        next.$$route.originalPath != '/new-password' &&
                        next.$$route.originalPath != '/new-password/:token' &&
                        next.$$route.originalPath != '/forgot-password'

            if (rules) {
                var path = $location.path();
                var port = window.location.port;
                if(port != 1234) mixpanel.track("[Open] : " + path.substring(1));
                next.$$route.originalPath ? path = next.$$route.originalPath.substring(1) : null;
                !session ? window.location.href = '/' : null;
                $.jStorage.set('path', path)
            }
        }
    });

    function getSubdomain() {
        var regexParse = new RegExp('[a-z\-0-9]{2,63}\.[a-z\.]{2,5}$');
        var urlParts   = regexParse.exec(window.location.hostname);
        return window.location.hostname.replace(urlParts[0], '').slice(0, -1);
    };

    function getSchoolWithSubdomain(subdomain) {
        return $http.get(endPoint.url.stage + 'school/subdomain/' + subdomain)
            .then(function (response) {
                return response.data;
            });
    };
});
