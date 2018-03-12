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
    var options = {
      user_id: '',
      page: '',
      limit: '',
      type: 2,
      data: []
    }

    initDom()

    F.wxLogin(function (data) {
      options.user_id = data.uid
      getMyBorrow()
    })

    $('.select>ul>li').click(function () {
      if ($(this).attr('class') !== 'active') {
        options.type = $(this).data('value')
        getMyBorrow()
        $('.select>ul>li').toggleClass('active')
      }
    })

    function getMyBorrow () {
      mine.getMyBorrow(options, function (res) {
        console.log(res)
        options.data = res
        F.display('list', options, function () {
          $('.operation>a').click(function () {
            var Param = {
              title: $(this).data('title'),
              cover: $(this).data('cover'),
              borrow_id: $(this).data('borrow_id'),
              books_id:  $(this).data('books_id')
            }
            localStorage.setItem('Param', JSON.stringify(Param))
            location.href = 'selectDamage.html'
          })
        })
      })
    }

    function initDom () {
    }

  })

})