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
});

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
            uid: '',
            cid: '',
            type: '5'
        };

        initDom();
        F.wxLogin(function (data) {
            options.uid = data.uid;
            mine.getPayNum(options, function (res) {
                F.display('recharge', res, function () {
                    $('.money_select>ul>li').eq(0).addClass('active')

                    $('.money_select>ul>li').click(function () {
                        $(this).siblings().removeClass('active')
                        $(this).addClass('active')
                        $('.dialog').css('display', 'none')
                    })

                    $('#other').click(function () {
                        $('.dialog').css('display', 'block')
                        if (parseInt($('#input').val()) === 0) {
                            $('.dialog>a').addClass('disabled')
                        }
                    })

                    $('.dialog>.title>span').click(function () {
                        $('.dialog').css('display', 'none')
                    })

                    $('.dialog>a').click(function () {
                        var Value = parseInt($('#input').val())
                        var Money = '<span>' + Value + '</span>'
                        $('#other').html(Money + '元')
                        $('.dialog').css('display', 'none')
                    })

                    $('#input').on('keyup', function () {
                        $('.dialog>a').removeClass('disabled')
                        if ($(this).val() > 200) {
                            $(this).val('200')
                        } else if (($(this).val() == '') || ($(this).val() == '0') || ($(this).val() == '00')) {
                            $('.dialog>a').addClass('disabled')
                        }
                    })

                    //点击充值按钮
                    $('.recharge>a').click(function () {
                        options.cid = $('.money_select>ul>.active').data('id')
                        mine.createOrder(options, function (res) {
                            // 开始充值
                            var body = '充值'
                            var openId = res.open_id
                            var total_fee = res.amount
                            var out_trade_no = res.number
                            F.initJssdk(function (status) {
                                if (status) {
                                    F.orderUnify(body, total_fee, openId, out_trade_no, function (prepay_id) {
                                        F.wxPay(prepay_id, function (res) {
                                            console.log(res)
                                        })
                                    })
                                }
                            })
                        })
                    })
                })
            })

        })

        function initDom() {
        }

    })

})