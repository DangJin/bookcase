<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

\think\Route::group(
    'index', [
        'wallet'                 => ['index/wallet/index', ['method' => 'get']],
        'bookcase/list'          => ['index/bookCase/getBookcaseList',
                                     ['method' => 'get']],
        'book/info'              => ['index/book/getBookInfo',
                                     ['method' => 'get']],
        'book/catelog'           => ['index/book/getBookCatelog',
                                     ['method' => 'get']],
        'book/wish'              => ['index/book/add2Wish',
                                     ['method' => 'get']],
        'book/buy'               => ['index/book/Order4Buy',
                                     ['method' => 'get']],
        'borrow/getLease'        => ['index/borrow/getLease',
                                     ['method' => 'get']],
        'bookcase/drawers'       => ['index/bookCase/drawers',
                                     ['method' => 'get']],
        'bookcase/books'         => ['index/bookCase/getBookcaseBooks',
                                     ['method' => 'get']],
        'bookcase/search'        => ['index/bookCase/searchBook',
                                     ['method' => 'get']],
        'persCenter/myBorrow'    => ['index/persCenter/myBorrow',
                                     ['method' => 'POST']],
        'persCenter/myWish'      => ['index/persCenter/myWish',
                                     ['method' => 'POST']],
        'persCenter/myBalance'   => ['index/persCenter/myBalance',
                                     ['method' => 'GET']],
        'persCenter/userProfile' => ['index/persCenter/userProfile',
                                     ['method' => 'GET']],
        'persCenter/myCoin'      => ['index/persCenter/myReadCoin',
                                     ['method' => 'GET']],
        'persCenter/myBuyout'    => ['index/persCenter/myBuyout',
                                     ['method' => 'GET']],
        'sign'                   => ['index/sign/sign',
                                     ['method' => 'GET']],
        'order/setPay'           => ['index/order/getPayConfig',
                                     ['method' => 'GET']],
    ]
);

\think\Route::group(
    'util', [
        'sendCode'          => ['util/alidayu/sendCode', ['method' => 'post']],
        'getBookInfo'       => ['util/douban/getBookByIsbn',
                                ['method' => 'get']],
        'status/getAlidayu' => [
            'util/globalStatus/getAlidayu',
            ['method' => 'GET'],
        ],
    ]
);


\think\Route::group(
    'weixin', [
        'init'     => ['wechat/index/index', ['method' => 'GET']],
        'wxconfig' => ['wechat/jsSdk/getWxConfig', ['method' => 'POST']],
        'oauth'    => ['wechat/oauth/oauth_callback', ['method' => 'GET']],
        'menu'     => ['wechat/menu/currentMenu', ['method' => 'GET']],
        'addMenu'  => ['wechat/menu/addMenu', ['method' => 'POST']],
        'delMenu'  => ['wechat/menu/delMenu', ['method' => 'GET']],
    ]
);

\think\Route::group(
    'wxpay', [
        'init'      => ['wxpay/index/index', ['method' => 'GET']],
        'payConfig' => ['wxpay/Jssdk/getJssdk', ['method' => 'POST']],
        'order'     => ['wxpay/Order/orderUnify', ['method' => 'GET']],
        'notice'    => ['wxpay/Order/notice', ['method' => 'POST ']],
    ]
);

\think\Route::group(
    'admin', [

        //用户管理
        'user/select'   => ['admin/user/select', ['method' => 'GET']],
        'user/update'   => ['admin/user/update', ['method' => 'POST']],
        'user/delete'   => ['admin/user/delete', ['method' => 'POST']],
        'user/add'      => ['admin/user/add', ['method' => 'POST']],

        //报修类型管理
        'rtype/select'  => ['admin/rtype/select', ['method' => 'GET']],
        'rtype/update'  => ['admin/rtype/update', ['method' => 'POST']],
        'rtype/delete'  => ['admin/rtype/delete', ['method' => 'POST']],
        'rtype/add'     => ['admin/rtype/add', ['method' => 'POST']],

        //订单管理
        'order/select'  => ['admin/order/select', ['method' => 'GET']],
        'order/update'  => ['admin/order/update', ['method' => 'POST']],
        'order/delete'  => ['admin/order/delete', ['method' => 'POST']],
        'order/add'     => ['admin/order/add', ['method' => 'POST']],

        //订单管理
        'credet/select' => ['admin/creDet/select', ['method' => 'GET']],
        //    'credet/update' => ['admin/creDet/update', ['method' => 'POST']],
        //    'credet/delete' => ['admin/creDet/delete', ['method' => 'POST']],
        //    'credet/add' => ['admin/creDet/add', ['method' => 'POST']],

    ]
);

