<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="UTF-8">
    <title>老虎买房</title>
    <style type="text/css">
        *{margin: 0;padding:0;box-sizing: border-box}
        html,body{width: 100%;height: 100%}
        .search-container{width: 700px;margin: 30px auto;position: relative;}
        .search-bar{width: 100%;font-size: 0}
        .search-bar input{width: 90%;height: 40px;line-height: 40px;text-indent: 5px;font-size: 20px;border:1px solid black;outline: none;}
        .search-bar span{display: inline-block;font-size: 20px;width: 10%;text-align: center;line-height:40px;height: 40px;background: red;color:white;cursor: pointer;letter-spacing: 5px}
        .search-sub{position: absolute;left: 0;top:40px;width: 100%;min-height: 40px;background: white}
        .search-sub p{color:red;display: none}
        .search-sub ul{width: 90%;height: 200px;border:1px solid darkgray;border-top: none;overflow: scroll;}
        .search-sub ul li{width:100%;height: 40px;line-height: 40px;text-indent: 5px;border-bottom: 1px solid gray;border-top: none;font-size: 16px;color: #333333;list-style: none}
        .search-sub ul li:hover{background: blue;color: white}
        #loading{position: absolute;right: 73px;top: 10px;width: 20px;display: none;}
        .detail-container{width: 700px;margin:10px auto;display: none;}
        .detail-container p{width: 100%;min-height: 40px;line-height:40px;font-size:16px}
        #map{width: 100px;height:40px;background: red;text-align: center;line-height: 40px;color: white;position: absolute;right:-120px;top:0;}
        #mapDetail{width: 800px;height: 600px;margin: 10px auto 30px;}
        .school{margin-left: 30px}
    </style>
    <script type="text/javascript" src="/Tiger/Public/lib/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="/Tiger/Public/lib/angular.min.js"></script>
    <script src="http://ditu.google.cn/maps/api/js?key=AIzaSyANJd8LvehOZALjsjZnRj8XsK9egZqSNek&sensor=false" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="/Tiger/Public/js/index.js"></script>
</head>
<body ng-controller="searchCtrl">
	<div class="search-container"  >
        <a id="map" href="/Tiger/Public/googleMap-demo/index.html" target="_blank">地图</a>
        <div class="search-bar">
            <input type="search" placeholder="Search Here" ng-model="search" ng-change="find()" id="search">
            <span class="search-btn">搜索</span>
            <img src="/Tiger/Public/img/loading-icon.gif" id="loading"/>
        </div>
       <div class="search-sub" ng-hide="flag">
           <ul class="info">
               <li ng-repeat="house in houseData" ng-click="detail(house)">
                   <span>{{house.address}}</span> , <span>{{house.suburb}}</span> , <span>{{house.city}}</span>
               </li>
           </ul>
           <p class="err">没有相应的数据</p>
       </div>
    </div>
    <div class="detail-container"></div>
    <div id="mapDetail"></div>
</body>
</html>