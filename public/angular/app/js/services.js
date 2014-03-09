'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('myApp.services', []).
  value('version', '0.1')
   // factory('testFactory',function(){
    //this.testF = "fjoaiwejfoi";
    //this.iArtOrder = function(){
        //return "fuck factory"
    //}
//}).
.service('orderService',function($http){
    this.totalCount = 0;
    this.totalPrice = 0;
    this.ifDisplay = "none";
    this.order=[];



    this.addDish = function(dish){
        this.totalCount += 1;
        var i=this.searchDish(dish);
        if(i!=null){
            this.order[i].count += 1;
        return this.order[i].count;
        }else{
            dish.count = 1;
            this.order.push(dish);
            return dish.count;
        }
        this.checkDispaly;
    }

    this.subDish = function(dish){
        this.totalCount -= 1;
        var i=this.searchDish(dish);
        if(this.order[i].count>1){
            this.order[i].count -= 1;
        return this.order[i].count;
        }else{
            this.order.splice(i,1);
            dish.count = 0;
            return dish.count;
        }

    }

    this.searchDish=function(dish){
        if(this.order.length==0)return null;
        for(var i = 0; this.order[i];i++){
            if(dish.id==this.order[i].id){
                return i;
            }
        }
    }

    this.checkDisplay = function(){
        if(this.totalCount > 0){
            this.totalprice = 0;
            this.totalcount = 0;
            for(var i =0; this.order[i]; i++){
                this.totalprice += this.order[i].price*this.order[i].count;
                this.totalcount += this.order[i].count;

            }
            this.ifDisplay = "block";
            return "block";
        }
        return "none";
    }
})

  .service('testService',function(){
    this.label = "this is a service";
});
