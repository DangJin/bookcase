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
<<<<<<< HEAD
      case_id: ''
=======
      case_id: '1'
>>>>>>> master
    }

    initDom()

    bookCase.getBookCaseMessage(options, function (res) {
      console.log(res)
      F.display('guiziM', res, function () {})
    })

    function initDom () {
<<<<<<< HEAD
      options.case_id = F.getUrlParams('caseid')
=======
>>>>>>> master
    }

  })

})