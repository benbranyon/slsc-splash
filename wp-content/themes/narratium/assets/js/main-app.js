
/**
* This is the main app for Angularjs, its called in the body of the site.
*/
var main_app = angular.module('main_app', ['ngMaterial']);
main_app.config(['$compileProvider', function ($compileProvider) {
    $compileProvider.debugInfoEnabled(false);
}]);
