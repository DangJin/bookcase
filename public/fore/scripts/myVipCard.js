require.config({
  paths: {
    'jquery': '../js/jquery.2.1.1min',
    'template': '../js/template-web',
    'F': '../js/function',
    'api': '../api/index',
    'wx': '../js/jweixin',
    'mine': '../api/mine/index'
  }
})

require(['jquery', 'F', 'mine'], function ($, F, mine) {

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
      mine.getMyMessage(options, function (res) {
        console.log(res)
        F.display('myVipCard', res, function () {
          $('.content>ul>li').click(function () {
            $('.content>ul>li').removeClass('active')
            $(this).addClass('active')
          })
        })
      })

    })

    function initDom () {

    }

  })

})