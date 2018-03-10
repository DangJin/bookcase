require.config({
  paths: {
    'jquery': '../js/jquery.2.1.1min',
    'template': '../js/template-web',
    'F': '../js/function',
    'api': '../api/index',
    'wx': '../js/jweixin',
    'bookCase': '../api/bookCase/index'
  }
})

require(['jquery', 'F', 'bookCase'], function ($, F, bookCase) {

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
    var options = {}

    initDom()

    F.wxLogin(function (data) {
      // 开始其他业务逻辑
      var openId = data.id
      var userId = data.uid

      F.display('book', options, function () {
        // 支付业务逻辑
        $('#pay').click(function () {
          F.initJssdk(function (status) {
            if (status) {
              var body = '订单测试'
              var total_fee = 1
              F.orderUnify(body, total_fee, openId, function (prepay_id) {
                F.wxPay(prepay_id)
              })
            }
          })
        })
      })
    })

    function initDom () {

    }

  })

})