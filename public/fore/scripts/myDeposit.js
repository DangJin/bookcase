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
      F.display('myDeposit', options, function () {

        $('.select>ul>li').click(function () {
          if ($(this).attr('class') !== 'active') {
            $('.select>ul>li').removeClass('active')
            $(this).addClass('active')
            $('.myDeposit>a').addClass('active')
          } else {
            $('.select>ul>li').removeClass('active')
            $('.myDeposit>a').removeClass('active')
          }
        })
      })
    })

    function initDom () {

    }

  })

})