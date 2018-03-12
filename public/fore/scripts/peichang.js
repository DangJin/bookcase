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
      openId: '',
      title: '',
      cover: '',
      time: '',
      borrow_id: '',
      con_id: '',
      data: '',
      uid: '',
      books_id: '',
      amount: '',
      type: '4'
    }

    initDom()

    F.wxLogin(function (data) {
      // 开始其他业务逻辑
      options.openId = data.id
      options.uid = data.uid
      bookCase.showOrder(options, function (res) {
        console.log(res)
        options.data = res
        options.amount = res.total
        UpDataHtml()
        setInterval(UpDataHtml, 10000)
      })
    })

    function UpDataHtml () {
      console.log(1)
      F.display('book', options, function () {
        $('.operation>a').off('click')
        $('.operation>a').click(function () {
          bookCase.createOrder(options, function (res) {
            console.log(res, '订单信息')
            // 开始充值
            var body = '还书费用'
            var openId = res.open_id
            var total_fee = res.amount
            var out_trade_no = res.number
            F.initJssdk(function (status) {
              if (status) {
                F.orderUnify(body, total_fee, openId, out_trade_no, function (prepay_id) {
                  F.wxPay(prepay_id, function (res) {
                    console.log(res)
                  })
                })
              }
            })
          })
        })
      })
    }

    function initDom () {
      var Param = JSON.parse(localStorage.getItem('Param'))
      options.title = Param.title
      options.cover = Param.cover
      options.time = Param.time
      options.borrow_id = Param.borrow_id
      options.con_id = Param.con_id
      options.books_id = Param.books_id
    }

  })

})