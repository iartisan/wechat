'use strict';

/* Controllers */

angular.module('myApp.controllers', []).
  controller('MyCtrl1', [function() {

  }])
  .controller('bodyCtrl',[function(){
  }])
  .controller('footerCtrl',[function(){
  }])
  .controller('MenuCtrl', ['$scope','$http','orderService',function($scope,$http,orderService) {

      $scope.errors = [];
      $scope.msgs = [];
      $scope.ifDisplay = orderService.ifDisplay;

      //$scope.ifDisplay = iArtConfig.orderDisplay();

//      $scope.output = testService.label;

      $http.get('sendmsg').success(function(data){
          for(var i =0; data[i];i++)
          data[i].count=0;
          $scope.dishes = data;
      }).error(function(data,status,header,config){
          //错误处理

      });

      $scope.addDish = function(dish){
         //$http.post('json/addDish.php',dish).success(function(data,status,headers,config){
              //console.log(data);
          //})
          //$scope.ifDisplay = "block";
          
            dish.count=orderService.addDish(dish);
          $scope.order = orderService.order;
          $scope.ifDisplay = orderService.checkDisplay();
          
      }

      $scope.subDish = function(dish){
              dish.count=orderService.subDish(dish);
          $scope.order = orderService.order;
          $scope.ifDisplay = orderService.checkDisplay();
      }

        $scope.$parent.myScrollOptions = {
            'sidebarScroll': {
                snap: false,
                onScrollEnd: function ()
                {
                }},
            'wrapper': {
                snap: false,
                onScrollEnd: function ()
                {
                }}
    };


    $scope.refreshiScroll3 = function ()
    {
        $scope.$parent.myScroll['sidebarScroll'].refresh();
        alert('wrapper3 refreshed');
    };


    $scope.refreshiScroll2 = function ()
    {
        $scope.$parent.myScroll['wrapper'].refresh();
        alert('testWrap2 refreshed');
    };

  }])
  .controller('OrderCtrl', ['$scope','$http','orderService',function($scope,$http,orderService) {
      $scope.order = orderService.order;
      $scope.ifOrderEmpty = 'none';
      
      $scope.addDish = function(dish){
          
            dish.count=orderService.addDish(dish);
          $scope.order = orderService.order;
          $scope.ifDisplay = orderService.checkDisplay();
          
      }

      $scope.subDish = function(dish){
              dish.count=orderService.subDish(dish);
          $scope.order = orderService.order;
          $scope.ifDisplay = orderService.checkDisplay();
          if($scope.order.length == 0){
              $scope.ifOrderEmpty = 'block';
          }
          console.log($scope.ifOrderEmpty);
      }

      $scope.pushOrder = function(){
          $http.post('getmsg',$scope.order).success(function(data,status,headers,config){
              console.log(data);
          }).error()
      }
  }])
  .controller('DishCtrl', ['$scope','$routeParams','orderService',function($scope,$routeParams,$orderService) {
      $scope.dish_id = $routeParams.dishId;

  }])
  .controller('TestCtrl', [function() {

  }])
  .controller('MyCtrl2', [function() {

  }]);
