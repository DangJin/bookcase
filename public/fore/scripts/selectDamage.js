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
      title: '',
      cover: '',
      borrow_id: '',
      data: '',
      con_id: '-1',
      books_id: ''
    }

    initDom()

    F.wxLogin(function (data) {
      bookCase.getBorrowOrder(options, function (res) {
        console.log(res)
        options.data = res
        F.display('book', options, function () {
          $('.damage>select').on('change', function () {
            options.con_id = $('.damage>select').find('option:selected').data('id')
          })
          $('.operation>a').click(function () {
            var Param = {
              title: options.title,
              cover: options.cover,
              time: $('.content').find('c').text(),
              borrow_id: options.borrow_id,
              con_id: options.con_id,
              books_id: options.books_id
            }
            localStorage.setItem('Param', JSON.stringify(Param))
            location.href = 'peichang.html'
          })
        })
      })
    })

    function initDom () {
      var Param = JSON.parse(localStorage.getItem('Param'))
      options.title = Param.title
      options.cover = Param.cover
      options.borrow_id = Param.borrow_id
      options.books_id = Param.books_id
    }

  })

})