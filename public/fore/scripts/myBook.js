require.config({
  paths: {
    'jquery': '../js/jquery.2.1.1min',
    'template': '../js/template-web',
    'F': '../js/function',
    'api': '../api/index',
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
      user_id: '1',
      page: '',
      limit: '',
      type: 2
    }

    initDom()


    $('.select>ul>li').click(function () {
      options.type = $(this).data('value')
      getMyBorrow()
      $('.select>ul>li').toggleClass('active')
    })

    function getMyBorrow () {
      mine.getMyBorrow(options, function (res) {
        console.log(res)
        F.display('list', res, function () {})
      })
    }

    function initDom () {
      getMyBorrow()
    }

  })

})