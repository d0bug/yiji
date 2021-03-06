<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
    <style type="text/css">
        body, html
        {
            width: 100%;
            height: 100%;
            overflow: hidden;
            margin: 0;
        }
        #allmap
        {
            height: 50%;
            width: 40%;
            float: left;
            border-right: 2px solid #bcbcbc;
        }
        #r-result
        {
            height: 100%;
            width: 55%;
            float: left;
        }
    </style>
	<script type="text/javascript" src="/tpl/Pc/default/common/js/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=nLpN5iKztxIWsPqgwsyrruUG"></script>
    <script type="text/javascript">

    </script>
</head>
<body>
    <input id="btn_show" type="button" value="button" />
    <div id="allmap">
    </div>
    <%--style="display:none"--%>
    <div id="r-result">
    </div>
</body>
</html>
<script type="text/javascript">
    //定义集合用来存放沿线的坐标值
    var chartData = [];
    //加载地图
    var map = new BMap.Map("allmap");
    map.centerAndZoom(new BMap.Point(118.10000, 24.46667), 11);
    var walking = new BMap.WalkingRoute(map, { renderOptions: { map: map, autoViewport: true} });
    var startpoint = new BMap.Point(118.112917, 24.435153);
    var endpoint = new BMap.Point(118.1086487, 24.439108);
    walking.search(startpoint, endpoint);
    //通过setSearchCompleteCallback回调事件可以把步行间的坐标信息获取
    walking.setSearchCompleteCallback(function (rs) {
        var pts = walking.getResults().getPlan(0).getRoute(0).getPath();
        for (var i = 0; i < pts.length; i++) {
            chartData.push(new BMap.Point(pts[i].lat, pts[i].lng));
        }
    });
    //另外两点的步行路线
    var walkings = new BMap.WalkingRoute(map, { renderOptions: { map: map, autoViewport: true} });
    var twoPoint = new BMap.Point(118.1286555, 24.4491888);
    walkings.search(endpoint, twoPoint);
    walkings.setSearchCompleteCallback(function (rs) {
        var pts = walkings.getResults().getPlan(0).getRoute(0).getPath();
        for (var i = 0; i < pts.length; i++) {
            chartData.push(new BMap.Point(pts[i].lat, pts[i].lng));
        }
    });
    //用来存放途经点的坐标
    var viaRouteData = [];
    viaRouteData.push(endpoint);

    $(function () {
        $("#btn_show").click(function () {
            //这边故意让它晚一秒运行，因为上面获取坐标信息是比较慢又是异步
            setTimeout(ShowRoute, 1000);
        });
    });

    function ShowRoute() {
        var firstPoint;
        var endPoint;
        var newChartData = [];
        //对坐标点重新定义
        $.each(chartData, function (item, value) {
            newChartData.push(new BMap.Point(value.lat, value.lng));
        });
        //为了获得起点及终点的坐标值,方便对它进行文字处理
        firstPoint = newChartData[0];
        endPoint = newChartData[newChartData.length - 1];
        //加载地图
        var maps = new BMap.Map("r-result");
        maps.centerAndZoom(new BMap.Point(118.10000, 24.46667), 15);
        //把步行线路的坐标集合转化成折线
        var polyline = new BMap.Polyline(newChartData, { strokeColor: "red", strokeWeight: 6, strokeOpacity: 0.5 });
        maps.addOverlay(polyline);

        //对起点、终点、途经点做一个简单的处理，泡泡跟文字提示
        var m1 = new BMap.Marker(firstPoint);
        var m2 = new BMap.Marker(endPoint);
        maps.addOverlay(m1);
        maps.addOverlay(m2);
        var lab1 = new BMap.Label("起点", { position: firstPoint });
        var lab2 = new BMap.Label("终点", { position: endPoint });
        maps.addOverlay(lab1);
        maps.addOverlay(lab2);

        $.each(viaRouteData, function (item, value) {
            var m = new BMap.Marker(value);
            maps.addOverlay(m);
            var lab = new BMap.Label("途经点", { position: value });
            maps.addOverlay(lab);
        });
    }
</script>