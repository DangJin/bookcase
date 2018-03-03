define(['api'], function (api) {
  const BookCase = api.api.BookCase || ''

<<<<<<< HEAD
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
=======
>>>>>>> master
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
        book_id: options.book_id
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

<<<<<<< HEAD

  // 图书目录
  var getArticleList = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: BookCase.getArticleList,
      data: {
        book_id: options.book_id
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

=======
>>>>>>> master
  // 加入心愿单
  var addMyWant = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: BookCase.addMyWant,
      data: {
        book_id: options.book_id
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

<<<<<<< HEAD
  // 微信地图导航
  var getMapWxconfig = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: BookCase.getMapWxconfig,
      data: {
        jsApiList: options.jsApiList,
        debug: options.debug
=======
  // 加入心愿单
  var getArticleList = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: BookCase.getArticleList,
      data: {
        book_id: options.book_id
>>>>>>> master
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

<<<<<<< HEAD

  return {
    getBookCaseList: getBookCaseList,
    getBookCaseMessage: getBookCaseMessage,
    getBookMessage: getBookMessage,
    getArticleList: getArticleList,
    addMyWant: addMyWant,
    getMapWxconfig: getMapWxconfig
=======
  return {
    getBookCaseMessage: getBookCaseMessage,
    getBookMessage: getBookMessage,
    addMyWant: addMyWant,
    getArticleList: getArticleList
>>>>>>> master
  }
})