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
      uid: '',
      bid: '',
      books_id: '',
      case_id: '',
      row: '',
      col: ''
    }

    initDom()

    F.wxLogin(function (data) {
      options.uid = data.uid
      console.log(options)
      bookCase.getBookMessage(options, function (res) {
        console.log(res)
        F.display('productM', res, function () {

          // 图书简介展开
          $('.productM_top>.text>a').click(function () {
            $(this).toggleClass('active')
            $(this.previousSibling.previousSibling).toggleClass('active')
            if ($(this).attr('class') === 'active') {
              $(this).text('收起')
            } else {
              $(this).text('更多')
            }
          })

          //借书验证
          $('.productM_a>a').eq(2).click(function () {
            bookCase.addBorrow(options, function (res) {
              console.log(res)
              if (res.status === 200) {
                alert(res.data)
                var Param = {
                  id: options.case_id,
                  row: options.row,
                  col: options.col
                }
                localStorage.setItem('Param', JSON.stringify(Param))
                location.href = 'borrowSuccess.html'
              } else if (res.status === 400) {
                alert(res.msg)
                if (res.code === 901) {
                  location.href = 'myDeposit.html'
                }
              }
            })
          })

          //加入心愿单
          $('.productM_bottom>a').eq(0).click(function () {
            bookCase.addMyWant(options, function (res) {
              alert(res)
              console.log(res)
            })
          })

        })
      })
    })

    function initDom () {
      var Params = JSON.parse(localStorage.getItem('Param'))
      options.bid = Params.bid
      options.books_id = Params.books_id
      options.case_id = Params.case_id
      options.row = Params.row
      options.col = Params.col
    }

  })

})