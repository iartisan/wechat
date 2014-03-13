'use strict';

/* Controllers */

angular.module('myApp.controllers', []).
  controller('MyCtrl1', [function() {

  }])
  .controller('bodyCtrl',[function(){
  }])
  .controller('footerCtrl',[function(){
  }])
  .controller('MenuCtrl', ['$scope','$http','orderService','$routeParams','$location',function($scope,$http,orderService,$routeParams,$location) {

      $scope.errors = [];
      $scope.msgs = [];

      $scope.getClass = function(path) {
    if ($location.path().substr(0, path.length) == path) {
      return "active"
    } else {
      return ""
    }
}

      //$scope.ifDisplay = iArtConfig.orderDisplay();

        //$scope.output = testService.label;

        $http.get('sendtype').success(function(data){
            $scope.categories = data;
        });
        $http.get('sendmylove').success(function(data){
            $scope.categories = data;
        });
        if($routeParams.name == 'index'){
                $http.get('sendmsg/index').success(function(data){
                    for(var i =0; data[i];i++)
                    {
                        data[i].count=0;
                        if(data[i].loves==null&&data[i].loves==0){
                            data[i].favorite=false;
                        }else if(data[i].loves == 1){
                            data[i].favorite=true;
                        }
                    }

                    $scope.dishes = data;
                if($scope.order.length!=0){
                    for(var i =0; $scope.order[i]; i++){
                            for(var j =0; $scope.dishes[j]; j++){
                                if($scope.order[i].id == $scope.dishes[j].id){
                                    $scope.dishes[j].count=$scope.order[i].count;
                                }
                            }
                    }
                }
                }).error(function(data,status,header,config){
                    //错误处理

                });
        }else{
                $http.get('sendmsg/'+$routeParams.name).success(function(data){
                    for(var i =0; data[i];i++)
                    data[i].count=0;
                    $scope.dishes = data;
                if($scope.order.length!=0){
                    for(var i =0; $scope.order[i]; i++){
                            for(var j =0; $scope.dishes[j]; j++){
                                if($scope.order[i].id == $scope.dishes[j].id){
                                    $scope.dishes[j].count=$scope.order[i].count;
                                }
                            }
                    }
                }
                }).error(function(data,status,header,config){
                    //错误处理

                });
        }

        $scope.if_like=function(dish){
                    $scope.dish=$http.get('sendlove/'+dish.id+'/'+!dish.favorite).success(function(data){
                        dish.favorite = !dish.favorite;
                        return dish;
                    }).error(function(){
                    })
        };
      //作用域真的要了解一下了
      //console.log($scope.dishes);

      $scope.order = orderService.order;

        $scope.ifDisplay = orderService.ifDisplay;
        $scope.totalcount = orderService.totalcount;
        $scope.totalprice = orderService.totalprice;

      this.searchDish=function(order_id){
      }

      $scope.addDish = function(dish){
         //$http.post('json/addDish.php',dish).success(function(data,status,headers,config){
              //console.log(data);
          //})
          //$scope.ifDisplay = "block";
          
            dish.count=orderService.addDish(dish);
          $scope.order = orderService.order;
          $scope.ifDisplay = orderService.ifDisplay;
          $scope.totalprice = orderService.totalprice;
          $scope.totalcount = orderService.totalcount;
          console.log(orderService.ifDisplay);
          
      }

      $scope.subDish = function(dish){
              dish.count=orderService.subDish(dish);
          $scope.order = orderService.order;
          $scope.ifDisplay = orderService.ifDisplay;
          $scope.totalprice = orderService.totalprice;
          $scope.totalcount = orderService.totalcount;
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
  .controller('OrderCtrl', ['$scope','$http','$location','orderService',function($scope,$http,$location,orderService) {
      $scope.order = orderService.order;
        $scope.totalcount = orderService.totalcount;
        $scope.totalprice = orderService.totalprice;
      $scope.ifOrderEmpty = 'none';
      
        $http.get('senduser').success(function(data){
            $scope.address=data[0];
        }).error(function(data,status,header,config){
        });

      $scope.addDish = function(dish){
          
            dish.count=orderService.addDish(dish);
          $scope.order = orderService.order;
          $scope.ifDisplay = orderService.checkDisplay();
        $scope.totalcount = orderService.totalcount;
        $scope.totalprice = orderService.totalprice;
          
      }

      $scope.subDish = function(dish){
              dish.count=orderService.subDish(dish);
          $scope.order = orderService.order;
        $scope.totalprice = orderService.totalprice;
        $scope.totalcount = orderService.totalcount;
          $scope.ifDisplay = orderService.checkDisplay();
          if($scope.order.length == 0){
              $scope.ifOrderEmpty = 'block';
        $scope.totalprice = 0;
          }
      }

      $scope.pushOrder = function(){
          $http.post('getmsg',$scope.order).success(function(data,status,headers,config){
              $location.path('/orderSuccess');
          }).error()
      }
  }])
  .controller('DishCtrl', ['$scope','$routeParams','orderService','$http',function($scope,$routeParams,orderService, $http) {
                $scope.dish_id = $routeParams.dishId;
                $http.get('sendone/'+$scope.dish_id).success(function(data){
                    $scope.dish = data[0];
                    $scope.dish.count = 0;
                    if($scope.dish.loves==null&&$scope.dish.loves==0){
                        $scope.dish.favorite = false;
                    }else if($scope.dish.loves=1){
                        $scope.dish.favorite = true;
                    }
                    console.log($scope.dish);
                $scope.dish.count = orderService.searchDishcount($scope.dish);
                }).error(function(data,status,header,config){
                    //错误处理

                });

                $scope.if_like = function(dish){
                    $http.get('sendlove/'+dish.id+'/'+!dish.favorite).success(function(data){
                        dish.favorite = !dish.favorite;
                    }).error(function(){
                    }
                    );
                        
                };

      $scope.addDish = function(dish){
          
            dish.count=orderService.addDish(dish);
          
      }

      $scope.subDish = function(dish){
              dish.count=orderService.subDish(dish);
      }
  }])
  .controller('AddressCtrl', ['$scope','$routeParams','orderService','$http','$location',function($scope,$routeParams,$orderService,$http,$location) {
      $scope.update = function(user){
          $scope.customer = angular.copy(user);
          $http.post('getclient',$scope.customer).success(function(data,status,headers,config){
              $location.path('/order');
          }).error()
      }
  }])
  .controller('TestCtrl', [function() {

  }])
  .controller('MyCtrl2', [function() {

  }]);
