'use strict';


// Declare app level module which depends on filters, and services
angular.module('myApp', [
  'ngRoute',
  'ngAnimate',
  'ngTouch',
  'ng-iscroll',
  'myApp.filters',
  'myApp.services',
  'myApp.directives',
  'myApp.controllers'
]).
config(['$routeProvider','$locationProvider', function($routeProvider,$locationProvider) {
  $routeProvider.when('/view1', {templateUrl: 'partials/partial1.html', controller: 'MyCtrl1'});
  $routeProvider.when('/view2', {templateUrl: 'partials/partial2.html', controller: 'MyCtrl2'});
  $routeProvider.when('/menu/:name', {templateUrl: 'part/menu.html', controller: 'MenuCtrl'});
  $routeProvider.when('/dish/:dishId', {templateUrl: 'part/dish.html', controller: 'DishCtrl'});
  $routeProvider.when('/order', {templateUrl: 'part/order.html', controller: 'OrderCtrl'});
  $routeProvider.when('/address', {templateUrl: 'part/address.html', controller: 'AddressCtrl'});
  $routeProvider.when('/orderSuccess', {templateUrl: 'part/orderSuccess.html'});
  $routeProvider.otherwise({redirectTo: '/menu/index'});
}]);
