require.config({
  paths: {
    'jquery': '../js/jquery.2.1.1min',
    'template': '../js/template-web',
    'F': '../js/function',
    'api': '../api/index',
    'wx': '../js/jweixin',
    'mine': '../api/mine/index'
  },
  urlArgs: 'v=' + new Date().getTime()
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
      uid: ''
    }

    initDom()
    F.wxLogin(function (data) {
      options.uid = data.uid
      mine.getMyMessage(options, function (res) {
        console.log(res)
        F.display('mine', res, function () {
          var Sign = res.sign
          $('.mine_top>.money>p>span').click(function () {
            location.href = 'myWallet.html'
          })

          $('.mine_top>.content>.button').click(function () {
            var that = $(this)
            mine.userSign(options, function (res) {
              that.removeClass('button')
              that.text('已连续打卡' + (Sign + 1) + '天')
            })
          })
        })
      })

    })

    function initDom () {

    }

  })

})