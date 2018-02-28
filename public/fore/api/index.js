define(function () {

  var root = 'http://tpbook.codwiki.cn'

  var api = {

    // 产品接口
    Product: {
      getProductList: root + '/index/chart/select'
    },

    // 个人信息接口
    Mine: {
      getMyMessage: root + '/index/persCenter/userProfile',
      getMyWallet: root + '/index/persCenter/myBalance',
      userSign: root + '/index/sign/sign',
      getMyBorrow: root + '/index/persCenter/myBorrow',
      getMyWantList: root + '/index/persCenter/myWish'
    },

    // 柜子接口
    BookCase: {
      getBookCaseMessage: root + '/index/bookcase/books',
      getBookMessage: root + '/index/book/info',
      addMyWant: root + '/index/book/wish',
      getArticleList: root + '/index/book/catelog'
    }
  }
  return {
    api: api
  }
})