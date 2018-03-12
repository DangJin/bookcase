require.config({
  paths: {
    "jquery": "../js/jquery.2.1.1min",
    "template": "../js/template-web",
    "F": "../js/function",
    'wx': '../js/jweixin'
  }
});

require(["jquery", "F"], function ($, F) {

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
      isDeposit: 2
    };


    F.display("deposit", options)

  });


});