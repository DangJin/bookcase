define(['api'], function (api) {
  const BookCase = api.api.BookCase || ''

  // 某区域书柜列表
  var getBookCaseList = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: BookCase.getBookCaseList,
      data: {
        city: options.city,
        lng: options.lng,
        lat: options.lat
      },
      dataType: 'json',
      success: function (res) {
        if (res.code === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.message)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }
  // 书柜详情
  var getBookCaseMessage = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: BookCase.getBookCaseMessage,
      data: {
        case_id: options.case_id
      },
      dataType: 'json',
      success: function (res) {
        console.log(res)
        if (res.code === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.message)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  // 图书详情
  var getBookMessage = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: BookCase.getBookMessage,
      data: {
        book_id: options.bid
      },
      dataType: 'json',
      success: function (res) {
        if (res.code === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.message)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  // 图书目录
  var getArticleList = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: BookCase.getArticleList,
      data: {
        book_id: options.bid
      },
      dataType: 'json',
      success: function (res) {
        if (res.code === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.message)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  // 加入心愿单
  var addMyWant = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: BookCase.addMyWant,
      data: {
        book_id: options.bid
      },
      dataType: 'json',
      success: function (res) {
        if (res.code === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.message)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  // 图书借阅
  var addBorrow = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: BookCase.addBorrow,
      data: {
        uid: options.uid,
        books_id: options.books_id
      },
      dataType: 'json',
      success: function (res) {
        callback.call(this, res)
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  // 微信地图导航
  var getMapWxconfig = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: BookCase.getMapWxconfig,
      data: {
        jsApiList: options.jsApiList,
        debug: options.debug,
        url: location.href.split('#')[0]
      },
      dataType: 'json',
      success: function (res) {
        if (res.code === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.message)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }


  //还书检查损坏程度
  var getBorrowOrder = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: BookCase.getBorrowOrder,
      data: {
        borrow_id: options.borrow_id
      },
      dataType: 'json',
      success: function (res) {
        if (res.status === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.message)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  //还书检查损坏程度
  var showOrder = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: BookCase.showOrder,
      data: {
        borrow_id: options.borrow_id,
        con_id: options.con_id
      },
      dataType: 'json',
      success: function (res) {
        if (res.status === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.message)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  //  结算租金 支付
  var createOrder = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: BookCase.createOrder,
      data: {
        uid: options.uid,
        books_id: options.books_id,
        con_id: options.con_id,
        amount: options.amount,
        type: options.type
      },
      dataType: 'json',
      success: function (res) {
        console.log(res, 'index')
        if (res.status === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.message)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  return {
    getBookCaseList: getBookCaseList,
    getBookCaseMessage: getBookCaseMessage,
    getBookMessage: getBookMessage,
    getArticleList: getArticleList,
    addMyWant: addMyWant,
    getMapWxconfig: getMapWxconfig,
    addBorrow: addBorrow,
    getBorrowOrder: getBorrowOrder,
    showOrder: showOrder,
    createOrder: createOrder
  }
})