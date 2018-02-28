require.config({
  paths: {
    'jquery': '../js/jquery.2.1.1min',
    'template': '../js/template-web',
    'F': '../js/function',
    'api': '../api/index',
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
      book_id: ''
    }

    initDom()

    bookCase.getBookMessage(options, function (res) {
      console.log(res)
      F.display('productM', res, function () {

        // 图书简介
        $('.productM_top>.text>a').click(function () {
          $(this).toggleClass('active')
          $(this.previousSibling.previousSibling).toggleClass('active')
          if ($(this).attr('class') === 'active') {
            $(this).text('收起')
          } else {
            $(this).text('更多')
          }
        })


        $('.productM_bottom>a').eq(0).click(function () {
          bookCase.addMyWant(options, function (res) {
            console.log(res)
          })
        })

      })
    })

    function initDom () {
      options.book_id = F.getUrlParams('bid')
    }

  })

})