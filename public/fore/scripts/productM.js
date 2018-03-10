require.config({
    paths: {
        'jquery': '../js/jquery.2.1.1min',
        'template': '../js/template-web',
        'F': '../js/function',
        'api': '../api/index',
        'wx': '../js/jweixin',
        'bookCase': '../api/bookCase/index'
    }
})

require(['jquery', 'F', 'bookCase'], function ($, F, bookCase) {

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
            book_id: ''
        };

        initDom();

        bookCase.getBookMessage(options, function (res) {
            console.log(res);
            F.display('productM', res, function () {
                var ws = new WebSocket('ws://39.104.76.182:8383');
                // 图书简介
                $('.productM_top>.text>a').click(function () {
                    $(this).toggleClass('active')
                    $(this.previousSibling.previousSibling).toggleClass('active')
                    if ($(this).attr('class') === 'active') {
                        $(this).text('收起')
                    } else {
                        $(this).text('更多')
                    }
                });

                var object = {
                    'type': 'control',
                    'id': '01020304',
                    'row': '01',
                    'col': '01'
                };

                //借书、开柜
                $('.productM_a>a').eq(2).click(function () {
                    // ws.onopen = function () {
                    //     ws.send(JSON.stringify(object))
                    // };
                    ws.send(JSON.stringify(object))
                });

                ws.onclose = function (ev) {
                    console.log(ev)
                };
                ws.onmessage = function (ev) {

                    // 如果门打开，将订单生效
                    console.log(ev)
                };
                //加入心愿单
                $('.productM_bottom>a').eq(0).click(function () {
                    bookCase.addMyWant(options, function (res) {
                        alert(res)
                        console.log(res)
                    })
                })

            })
        })

        function initDom() {
            options.book_id = F.getUrlParams('bid')
        }

    })

})