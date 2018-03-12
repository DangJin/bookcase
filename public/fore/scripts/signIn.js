require.config({
  paths: {
    'jquery': '../js/jquery.2.1.1min',
    'template': '../js/template-web',
    'F': '../js/function',
    'api': '../api/index',
    'wx': '../js/jweixin',
    'mine': '../api/mine/index'
  }
})

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
      res: [
        {
          value: '2',
          pro: '10'
        },
        {
          value: '5',
          pro: '25'
        },
        {
          value: '10',
          pro: '35'
        },
        {
          value: '20',
          pro: '15'
        },
        {
          value: '30',
          pro: '10'
        },
        {
          value: '50',
          pro: '5'
        }
      ],
      data: [
        {
          value: '50',
          pro: []
        },
        {
          value: '50',
          pro: []
        },
        {
          value: '50',
          pro: []
        },
        {
          value: '50',
          pro: []
        },
        {
          value: '50',
          pro: []
        },
        {
          value: '50',
          pro: []
        }
      ],
      CanClick: 1
    }

    initDom()

    F.wxLogin(function (res) {

    mine.getMyMessage(options, function (res) {
      console.log(res)
      F.display('signIn', options, function () {

        // 打开抽奖弹窗
        $('.sign>.content.active').click(function () {
          $('.select').css('display', 'block')
        })

        // 关闭抽奖弹窗
        $('.select>.content>a').click(function () {
          $('.select').css('display', 'none')
          $('.sign>.content').removeClass('active')
          $('.sign>.content').html('今日已签<br>明天再来')
        })

        $('.ruler>h5').click(function () {
          // console.log($(this).parent('.ruler').find('ul').toggleClass('active'))
          $(this).parent('.ruler').find('ul').toggleClass('active')
        })

        // 抽奖
        $('.text>ul>li').click(function () {
          // 判断是否可抽奖
          if (options.CanClick === 1) {
            options.CanClick = 0
            $('.select>.content>.title').find('span').text('0')

            $(this).addClass('active')
            //未选中的数组、随机概率值、选中的值
            var OtherList = [], RandomNum = 0, ThisValue
            // 计算每个选项选中的概率
            for (var i = 0; i < options.res.length; i++) {
              options.data[i].value = options.res[i].value
              var Numl = 0, Numr = 0
              for (var j = 0; j < i; j++) {
                Numl += parseInt(options.res[j].pro)
              }
              Numr = Numl + parseInt(options.res[i].pro)
              options.data[i].pro[0] = Numl
              options.data[i].pro[1] = Numr
            }
            // 生成随机数,抽取选项
            var mathRandom = parseInt(Math.random() * 100)
            console.log(options.data)
            console.log(mathRandom)
            for (var i = 0; i < options.data.length; i++) {
              if ((options.data[i].pro[0] <= mathRandom) && (mathRandom < options.data[i].pro[1])) {

                // 记录下当前选中值
                ThisValue = options.data[i].value
                // 将剩余选中值压进数组
                for (var j = 0; j < options.data.length; j++) {
                  if (i !== j) {
                    OtherList.push(options.data[j].value)
                  }
                }
              }
            }

            // 翻开当前选中卡牌
            $(this).find('span').text(ThisValue)
            $(this).find('.flipper').css('transform', 'rotateY(180deg)')
            // 打乱剩余选项
            OtherList.sort(randomsort)
            // 将剩余选项随机分配
            for (var i = 0; i < $('.text>ul>li').length; i++) {
              if ($('.text>ul>li').eq(i).attr('class') !== 'active') {
                $('.text>ul>li').eq(i).find('span').text(OtherList[RandomNum])
                RandomNum++
              }
            }
            setTimeout(TransformRoll, 300)
          }
        })
        // 抽奖翻牌动画
        function TransformRoll () {
          $('.text>ul>li>.flipper').css('transform', 'rotateY(180deg)')
        }

        // 打乱数组
        function randomsort (a, b) {
          return Math.random() > .5 ? -1 : 1
          //用Math.random()函数生成0~1之间的随机数与0.5比较，返回-1或1
        }
      })
    })

    })

    function initDom () {

    }

  })

})