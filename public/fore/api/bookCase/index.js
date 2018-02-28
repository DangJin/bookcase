define(['api'], function (api) {
  const BookCase = api.api.BookCase || ''

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

  // 加入心愿单
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

  return {
    getBookCaseMessage: getBookCaseMessage,
    getBookMessage: getBookMessage,
    addMyWant: addMyWant,
    getArticleList: getArticleList
  }
})