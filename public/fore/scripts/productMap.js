require.config({
  paths: {
    'jquery': '../js/jquery.2.1.1min',
    'F': '../js/function',
    'template': '../js/template-web',
    'api': '../api/index',
    'bookCase': '../api/bookCase/index',
    'wx': '../js/jweixin'
  }
})

require(['jquery', 'F', 'bookCase', 'wx'], function ($, F, bookCase, wx) {

  /**
   * 监听页面加载完成
   *
   * initDom 初始化对于原始Dom的操作
   *
   * F.display("容器","渲染数据","Dom操作")
   *
   */
  $(function () {
    // 全局存储用户id
    var options = {
      city: '廊坊市',
      lng: '116.80504',
      lat: '39.96094',
      positions: [{x: '116.481181', y: '39.989792'}],
      wxMap: {
        jsApiList: 'openLocation,getLocation',
        debug: 1

      }
    }

    initDom()

    function getBookCaseList () {
      bookCase.getBookCaseList(options, function (res) {
        console.log(res)
        options.positions = []
        for (var i = 0; i < res.length; i++) {
          options.positions[i] = {
            x: res[i].lng,
            y: res[i].lat,
            caseId: res[i].id,
            caseName: res[i].name,
            img: res[i].cover,
            distance: res[i].distance.toFixed(1)
          }
        }
        storeMapList(options.positions)
      })
    }

    // 绘制门店列表
    function storeMapList (positions) {

      var map, geolocation
      //    地图初始化
      map = new AMap.Map('container', {
        resizeEnable: true,
        zoom: 14,
        center: [116.805, 39.960]
      })
      console.log(map.getCenter())

      map.on('click', function () {
        console.log(222)
      })

      //    加载地图，调用浏览器定位服务
      map.plugin('AMap.Geolocation', function () {
        geolocation = new AMap.Geolocation({
          enableHighAccuracy: true,//是否使用高精度定位，默认:true
          timeout: 10000,          //超过10秒后停止定位，默认：无穷大
          buttonOffset: new AMap.Pixel(10, 20),//定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
          zoomToAccuracy: true,      //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
          buttonPosition: 'RB'
        })
        map.addControl(geolocation)
        geolocation.getCurrentPosition()
        AMap.event.addListener(geolocation, 'complete', onComplete)//返回定位信息
        AMap.event.addListener(geolocation, 'error', onError)      //返回定位出错信息
      })

      //添加marker标记
      map.clearMap()
      var markers = new Array
      for (var i = 0; i < positions.length; i++) {
        markers[i] = new AMap.Marker({
          id: i,
          map: map,
          icon: 'image/guizi4.png',
          position: [positions[i].x, positions[i].y]
        })

//        //鼠标点击marker弹出自定义的信息窗体
        AMap.event.addListener(markers[i], 'click', function (e) {
          console.log(e.target.F.id)
          $('.InfoWindow>.headImg').attr('src', positions[e.target.F.id].img)
          $('.InfoWindow>.content>h5>span').text(positions[e.target.F.id].caseName)
          $('.InfoWindow>.content>p>span').text(positions[e.target.F.id].distance)
          $('.InfoWindow>.bottom>.toMessage').attr('href', 'guiziM.html?caseid=' + positions[e.target.F.id].caseId)
          $('.InfoWindow').css('display', 'block')

          // 点击导航 唤起微信地图
          $('.InfoWindow>.bottom>.navigation').click(function () {
            bookCase.getMapWxconfig(options.wxMap, function (res) {
              console.log(res)
              wx.config({
                debug: true,
                appId: res.appId,
                timestamp: res.timestamp,
                nonceStr: res.nonceStr,
                signature: res.signature,
                jsApiList: res.jsApiList
              })

              wx.ready(function () {
                wx.openLocation({
                  latitude: 0, // 纬度，浮点数，范围为90 ~ -90
                  longitude: 0, // 经度，浮点数，范围为180 ~ -180。
                  name: '', // 位置名
                  address: '', // 地址详情说明
                  scale: 1, // 地图缩放级别,整形值,范围从1~28。默认为最大
                  infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
                })
              })
            })

          })
        })
      }

      //关闭信息窗体
      $('.InfoWindow>.back').click(function () {
        $('.InfoWindow').css('display', 'none')
      })
    }

    //解析定位结果
    function onComplete (data) {
      var str = ['定位成功']
      str.push('经度：' + data.position.getLng())
      str.push('纬度：' + data.position.getLat())
      if (data.accuracy) {
        str.push('精度：' + data.accuracy + ' 米')
      }//如为IP精确定位结果则没有精度信息
      str.push('是否经过偏移：' + (data.isConverted ? '是' : '否'))
      document.getElementById('tip').innerHTML = str.join('<br>')
    }

    //解析定位错误信息
    function onError (data) {
      // document.getElementById('tip').innerHTML = '定位失败'
    }

    function initDom () {
      getBookCaseList()
    }
  })
})