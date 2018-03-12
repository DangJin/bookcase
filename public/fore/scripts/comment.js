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
    var options = {
      bid: ''
    }

    initDom()

    F.wxLogin(function (data) {
      bookCase.getBookMessage(options, function (res) {
        console.log(res)
        F.display('title', res, function () {
          $('.title>.content>ul>li').click(function () {
            $('.title>.content>ul>li').removeClass('active')
            for (var i = 0; i < $(this).data('value'); i++) {
              $('.title>.content>ul>li').eq(i).addClass('active')
              $('.title>.content>strong>span').text(i + 1 + '.0')
            }
          })
        })
      })
    })

    function initDom () {
      options.bid = F.getUrlParams('bid')
    }

  })

})