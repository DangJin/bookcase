define(function () {

  var root = 'http://tpbook.codwiki.cn'

  var api = {

    // 产品接口
    Product: {
      getProductList: root + '/index/chart/select'
    },

    // 个人信息接口
    Mine: {
      getMyMessage: root + '/index/persCenter/userProfile', //个人信息
      getMyWallet: root + '/index/persCenter/myBalance',   //我的钱包
      userSign: root + '/index/sign/sign',                //用户签到
      getMyBorrow: root + '/index/persCenter/myBorrow',  //我的图书借环
      getMyWantList: root + '/index/persCenter/myWish',  //我的心愿单
      getPayNum: root + '/index/config/getPayNum',      //获取充值金额选项
      createOrder: root + '/index/order/createOrder',   //生成订单接口
      getDeposit: root + '/index/config/getDeposit'   //获取押金规格
    },

    // 书柜接口
    BookCase: {
      getBookCaseList: root + '/index/bookcase/list',    //书柜列表
      getBookCaseMessage: root + '/index/bookcase/books',  //书柜详情
      getBookMessage: root + '/index/book/info',          //图书详情
      addMyWant: root + '/index/book/wish',             //添加心愿单
      getArticleList: root + '/index/book/catelog',      //获取图书目录
      getMapWxconfig: root + '/weixin/wxconfig',        //调取微信地图
      addBorrow: root + '/index/borrow/addBorrow',  //生成借阅订单接口
      getBorrowOrder: root + '/index/borrow/getBorrowOrder',  //还书检查损坏程度
      showOrder: root + '/index/borrow/showOrder',  //生成赔偿订单
      createOrder: root + '/index/order/createOrder'  //结算租金 支付
    },

    //微信地图接口
    Map: {}
  }
  return {
    api: api
  }
})