var app=angular.module('musejam',['mj-controller','mj-controller-1','ngRoute']);

app.config(function ($routeProvider) {
    $routeProvider
        .when('/view', {
            templateUrl: 'view.blade.php',
            controller: 'relations-view'
        })
        .when('/manage', {
            templateUrl: 'manage.blade.php',
            controller: 'relations-manage'
        })
        .otherwise({
            redirectTo: '/'
        });
});
