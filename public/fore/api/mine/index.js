define(['api'], function (api) {
  const Mine = api.api.Mine || ''

  // 个人信息
  var getMyMessage = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: Mine.getMyMessage,
      data: {
        uid: options.uid
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

  // 我的钱包
  var getMyWallet = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: Mine.getMyWallet,
      data: {},
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

  // 签到
  var userSign = function (options, callback) {
    $.ajax({
      type: 'GET',
      url: Mine.userSign,
      data: {},
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

  // 我的在借图书
  var getMyBorrow = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: Mine.getMyBorrow,
      data: {
        user_id: options.user_id,
        page: options.page,
        limit: options.limit,
        type: options.type
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

  // 我的心愿单
  var getMyWantList = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: Mine.getMyWantList,
      data: {
        page: options.page,
        limit: options.limit
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

  // 获取可充值金额
  var getPayNum = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: Mine.getPayNum,
      data: {
        uid: options.uid
      },
      dataType: 'json',
      success: function (res) {
        if (res.status === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.msg)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  // 生成订单
  var createOrder = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: Mine.createOrder,
      data: {
        uid: options.uid,
        cid: options.cid,
        type: options.type
      },
      dataType: 'json',
      success: function (res) {
        if (res.status === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.msg)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  // 获取押金规格
  var getDeposit = function (options, callback) {
    $.ajax({
      type: 'POST',
      url: Mine.getDeposit,
      data: {},
      dataType: 'json',
      success: function (res) {
        if (res.status === 200) {
          callback.call(this, res.data)
        } else {
          callback.call(this, res.msg)
        }
      }, error: function (res) {
        throw new Error(res)
      }
    })
  }

  return {
    getMyMessage: getMyMessage,
    getMyWallet: getMyWallet,
    userSign: userSign,
    getMyBorrow: getMyBorrow,
    getMyWantList: getMyWantList,
    getPayNum: getPayNum,
    createOrder: createOrder,
    getDeposit: getDeposit
  }
})