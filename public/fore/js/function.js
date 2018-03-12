define(['jquery', 'template', 'wx'], function ($, template, wx) {

  var display = function (container, data, callback) {
    if ($('#' + container).length !== 0) {
      var h = template(container, {data: data})
      if ($('.' + container).length !== 0) {
        $('.' + container).html(h)
        if (typeof callback === 'function') {
          callback.call(this)
        }
      } else {
        throw new Error('容器不存在')
      }
    } else {
      throw new Error('模板不存在')
    }
  }

  /**
   * 获取 URL 参数
   * @param name
   * @returns {*}
   */
  function getUrlParam (name) {
    var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)')
    var r = window.location.search.substr(1).match(reg)
    if (r != null) return unescape(r[2])
    return null
  }

  /**
   * 微信登录
   * @param callback
   */
  function wxLogin (callback) {
    var appId = 'wx5c1a89ec7428682c'
    var oauth_url = 'http://tpbook.codwiki.cn/weixin/oauth'
    var url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' + appId + '&redirect_uri=' + location.href.split('#')[0] + '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect'
    var isLogin = sessionStorage.getItem('user')
    var code = getUrlParam('code')
    if (!code && !isLogin) {
      window.location = url
    } else {
      if (isLogin) {
        var _user = JSON.parse(isLogin)
        var user = {
          id: _user.openId,
          uid: _user.userId
        }
        callback(user)
      } else {
        $.ajax({
          type: 'GET',
          url: oauth_url,
          dataType: 'json',
          data: {
            code: code
          },
          success: function (data) {
            if (data.code === 200) {
              // 做本地存储
              var user = {
                userId: data.data.uid, openId: data.data.id
              }
              sessionStorage.setItem('user', JSON.stringify(user))
              callback(data.data)
            }
          },
          error: function (error) {
            console.log(error)
          }
        })
      }
    }
  }

  /**
   * 初始化 weixin-js-sdk
   * @param callback
   */
  function initJssdk (callback) {
    $.ajax({
      type: 'POST',
      url: 'http://tpbook.codwiki.cn/weixin/wxconfig',
      dataType: 'json',
      data: {
        jsApiList: 'openLocation,chooseWXPay',
        debug: 0,
        url: location.href.split('#')[0]
      },
      success: function (data) {
        wx.config(data.data)
        callback(true)
      },
      error: function (error) {
        callback(false)
      }
    })
  }

  /**
   * 统一下单
   * @param body
   * @param total_fee
   * @param openid
   * @param out_trade_no
   * @param callback
   */
  function orderUnify (body, total_fee, openid, out_trade_no, callback) {
    $.ajax({
      type: 'GET',
      url: 'http://tpbook.codwiki.cn/wxpay/order',
      dataType: 'json',
      data: {
        body: body,
        openid: openid,
        total_fee: total_fee,
        out_trade_no: out_trade_no
      },
      success: function (data) {
        if (data.code === 200) {
          callback(data.data.prepay_id)
        }
      },
      error: function (error) {
        $('body').append(error)
      }
    })
  }

  /**
   * 微信支付
   * @param prepay_id
   * @param callback
   */
  function wxPay (prepay_id, callback) {
    $.ajax({
      type: 'POST',
      url: 'http://tpbook.codwiki.cn/wxpay/payConfig',
      data: {
        prepayId: prepay_id
      },
      dataType: 'json',
      success: function (data) {
        var config = data.data
        wx.ready(function () {
          wx.chooseWXPay({
            timestamp: config['timestamp'],
            nonceStr: config['nonceStr'],
            package: config['package'],
            signType: config['signType'],
            paySign: config['paySign'], // 支付签名
            success: function (res) {
              callback(res)
            }, fail: function (error) {
              callback(error)
            }
          })
        })
      },
      error: function (error) {
        $('body').append(error.errMsg)
      }
    })
  }

  function shareTimeline (title, imgUrl) {
    wx.onMenuShareTimeline({
      title: title, // 分享标题
      url: location.href.split('#')[0],// 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
      imgUrl: imgUrl, // 分享图标
      success: function () {
      },
      cancel: function () {

      }
    })
  }

  return {
    display: display,
    getUrlParams: getUrlParam,
    wxLogin: wxLogin,
    initJssdk: initJssdk,
    orderUnify: orderUnify,
    shareTimeline: shareTimeline,
    wxPay: wxPay
  }
})