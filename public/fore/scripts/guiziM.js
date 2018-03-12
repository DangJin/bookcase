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
      case_id: '16'
    }

    initDom()

    bookCase.getBookCaseMessage(options, function (res) {
      console.log(res)
      F.display('guiziM', res, function () {

        // 跳转图书详情页
        $('.list>ul>li>a').click(function () {
          var Param = {
            bid: $(this).data('bid'),
            books_id: $(this).data('books_id'),
            case_id: options.case_id,
            col: $(this).data('col'),
            row: $(this).data('row')
          }
          localStorage.setItem('Param', JSON.stringify(Param))
          location.href = 'productM.html'
        })

      })
    })

    function initDom () {
      options.case_id = F.getUrlParams('case_id')
    }

  })

})