<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>雇主发布任务</title>
    <link href="/css/style.css" type="text/css" rel="stylesheet">
    <link href="/css/task.css" type="text/css" rel="stylesheet">
    <script src="/js/jquery.js"></script>
</head>

<body>
<?php
require(ECMS_PATH.'e/template/public/headeri.php');
?>
<form class="layui-form" action="/e/member/task/add_2.php" method="post">
    <div class="add_task">
        <div class="main add_title yuan">发布任务</div>
        <form class="layui-form">
        <!-- 表单详情 -->
        <div class="main add_info yuan">
            <h3>发布任务详情</h3>
            <div class="add_type clearfix">
                <ul>
                    <li><i class="add_n1"></i>
                        <p>选择交易模式</p></li>
                    <li><i class="add_n2 current"></i>
                        <p>描述任务需求</p></li>
                    <li><i class="add_n3"></i>
                        <p>核对交易清单</p></li>
                    <li><i class="add_n4"></i>
                        <p>成功发布任务</p></li>
                </ul>
            </div>

            <div class="add_iden">竞标悬赏</div>

            <div class="add_pd ">
                <!--三个价格-->
                <div class="money-group clearfix">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="input-group-one  lf">
                        <h6 class="input-group-title">项目标的</h6>
                        <div class="clearfix">
                            <div class="lf inp_ut">
                                <span class="money-icon">¥</span>
                                <input type="number"  name="title" lay-verify="number" autocomplete="off"
                                       placeholder="请输入金额" class="layui-input three-money three-money-one" value=""></div>
                            <!--<div class="rt clearfix">-->
                            <!--<div class="lf inp_tx"><i></i></div>-->
                            <!--<div class="lf inp_tx">必填项</div>-->
                            <!--</div>-->
                        </div>
                        <em class="ad_tx">项目标的费用</em>
                    </div>
                    <div class="input-group-one lf">
                        <h6 class="input-group-title">比稿补偿费</h6>
                        <div class="clearfix">
                            <div class="lf inp_ut">
                                <span class="money-icon">¥</span>
                                <input type="number" name="title" lay-verify="number" autocomplete="off"
                                       placeholder="" class="layui-input three-money three-money-two" value="0" readonly value=""></div>
                            <!--<div class="rt clearfix">-->
                            <!--<div class="lf inp_tx"><i></i></div>-->
                            <!--<div class="lf inp_tx">必填项</div>-->
                            <!--</div>-->
                        </div>
                        <em class="ad_tx">比稿补偿费是项目费用的10%</em>
                    </div>
                    <div class="input-group-one lf">
                        <h6 class="input-group-title">项目总金额</h6>
                        <div class="clearfix">
                            <div class="lf inp_ut">
                                <span class="money-icon">¥</span>

                                <input type="number" name="title" lay-verify="number" autocomplete="off"
                                       placeholder="" class="layui-input three-money three-money-three" value="0" readonly></div>
                            <!--<div class="rt clearfix">-->
                            <!--<div class="lf inp_tx"><i></i></div>-->
                            <!--<div class="lf inp_tx">必填项</div>-->
                            <!--</div>-->
                        </div>
                        <em class="ad_tx">精确的项目名称可以使用户快速查找</em>
                    </div>
                    <div class="rt clearfix">

                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>
                <!-- 时间选择 -->
                <div class="clearfix">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="lf inp_ut time-group">
                        <div class="layui-form-item time-warp time-color1">
                            <div class="layui-inline">
                                <label class="layui-form-label">项目报名截止时间</label>
                                <div class="layui-input-inline time-chose">
                                    <input type="text" class="layui-input bulid-date " id="buildDate01"  placeholder="">
                                    <i class="layui-icon date-icon">&#xe637;</i>
                                </div>
                            </div>

                        </div>
                        <div class="layui-form-item time-warp time-color2">
                            <div class="layui-inline">
                                <label class="layui-form-label">项目投标截止时间</label>
                                <div class="layui-input-inline time-chose">
                                    <input type="text" class="layui-input bulid-date " id="buildDate02"  placeholder="">
                                    <i class="layui-icon date-icon">&#xe637;</i>
                                </div>
                            </div>

                        </div>
                        <div class="layui-form-item time-warp time-color3">
                            <div class="layui-inline">
                                <label class="layui-form-label">深化方案截止时间</label>
                                <div class="layui-input-inline time-chose">
                                    <input type="text" class="layui-input bulid-date " id="buildDate03"  placeholder="">
                                    <i class="layui-icon date-icon">&#xe637;</i>
                                </div>
                            </div>

                        </div>
                        <div class="layui-form-item time-warp time-color4">
                            <div class="layui-inline">
                                <label class="layui-form-label">技术初扩截止时间</label>
                                <div class="layui-input-inline time-chose">
                                    <input type="text" class="layui-input bulid-date " id="buildDate04"  placeholder="">
                                    <i class="layui-icon date-icon">&#xe637;</i>
                                </div>
                            </div>

                        </div>
                        <div class="layui-form-item time-warp time-color5">
                            <div class="layui-inline">
                                <label class="layui-form-label">最终成果截止时间</label>
                                <div class="layui-input-inline time-chose">
                                    <input type="text" class="layui-input bulid-date " id="buildDate05"  placeholder="">
                                    <i class="layui-icon date-icon">&#xe637;</i>
                                </div>
                            </div>

                        </div>
                        <div class="layui-form-item time-warp time-color6">
                            <div class="layui-inline">
                                <label class="layui-form-label">项目完成截止时间</label>
                                <div class="layui-input-inline time-chose">
                                    <input type="text" class="layui-input bulid-date " id="buildDate06"  placeholder="">
                                    <i class="layui-icon date-icon">&#xe637;</i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="rt clearfix">
                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>
                <em class="ad_tx"></em>

            </div>

        </div>

        <div class="task-but main">
            <button class="task-btn-n1">发布</button>
            <button class="task-btn-n2">预览</button>
        </div>
        </form>
    </div>


</form>
<?php
require(ECMS_PATH.'e/template/public/footer.php');
?>
<script src="/js/jquery.js"></script>
<script type="text/javascript" src="/layui/layui.js"></script>
<script>
//    /一般直接写在一个js文件中
    layui.use(['layer', 'form','laydate'], function(){
        var layer = layui.layer
            ,form = layui.form
            ,laydate = layui.laydate;
//        6个时间选择器 的处理
        var currentTimeStamp = new Date();
        currentTimeStamp = currentTimeStamp.getTime();
        for (var i =1;i<=6;i++){
//            给每个时间选择器绑定事件
            laydate.render({
                elem: '#buildDate0'+i,
                type:'datetime',
                format:'yyyy-MM-dd HH:mm',
                value:new Date(currentTimeStamp+86400000*i),
                done: function(value, date, endDate){
                    console.log(value); //得到日期生成的值，如：2017-08-18
                    console.log(date); //得到日期时间对象：{year: 2017, month: 8, date: 18, hours: 0, minutes: 0, seconds: 0}
                    var self = this;
                    var dateNum = self.elem.attr('lay-key');
//                    当前时间
                    var currentDateNum =value.replace(/\-|\ |\:/g,'');
//                    上一个时间
                    if(dateNum>1){
                        var beforeDate = $('#buildDate0'+(dateNum-1)).val();
                        beforeDateNum = beforeDate.replace(/\-|\ |\:/g,'');
                        if(dateNum>1&&beforeDateNum>=currentDateNum){
                            layer.alert('当前选择时间小于上一阶段时间,请重新选择',function() {
                                layer.closeAll();
                                $(self.elem).val(beforeDate);
                            });

                        }
                    }
                        
                }
            });
        }
//        第一个数字加第二个价格 为第三个价格
        $('.three-money-one').on('blur',function () {
            var price1 = $(this).val().replace('.','')-0;
            $(this).val(price1)
            $('.three-money-three').val((price1+price1*0.1).toFixed(2))
            $('.three-money-two').val((price1*0.1).toFixed(2))
        })
        // $('.three-money-two').on('blur',function () {
        //     var price1 = $(this).val()-0;
        //     var price2 = $('.three-money-one').val()-0;
        //     $('.three-money-three').val(price1+price)
        // })
    });
</script>
</body>
</html>
