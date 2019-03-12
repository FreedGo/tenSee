<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<!DOCTYPE html>
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
<form class="layui-form">
    <div class="add_task">
        <div class="main add_title yuan">发布任务</div>

        <!-- 表单详情 -->
        <div class="main add_info yuan">
            <h3>发布任务详情</h3>
            <div class="add_type clearfix">
                <ul>
                    <li><i class="add_n1"></i>
                        <p>选择交易模式</p></li>
                    <li><i class="add_n2 current"></i>
                        <p>描述任务需求</p></li>
                    <li><i class="add_n3 current"></i>
                        <p>核对交易清单</p></li>
                    <li><i class="add_n4"></i>
                        <p>成功发布任务</p></li>
                </ul>
            </div>

            <div class="add_iden">竞标悬赏  <span class="title-info">行业：环境设计 - 室内设计</span></div>
            <!--标题提-->
            <div class="task-title task-item">
                <div class="add_iden">标题</div>
                <div class="task-title-info clearfix">
                    <div class="task-title-img lf">
                        <img src="/images/userimg.png" alt="">
                    </div>
                    <div class="title-detail-info lf">
                        <h4 class="title-text">科林环保装备股份有限公司办公室设计装修科林环保装备  </h4>
                        <div class="title-detail-other clearfix">
                            <div class="title-money lf">
                                <span class="title-money-title lf">竞标比稿</span>
                                <span class="title-money-title-num lf">¥100000</span>
                            </div>
                            <div class="title-time lf">
                                <span class="title-time-title lf">距交稿截止：</span>
                                <span class="title-time-title-num lf">12天09小时</span>
                            </div>
                            <div class="title-percent lf">
                                <span class="title-percent-title lf">赏金分配：</span>
                                <span class="title-percent-title-num lf">按竞标规则</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--项目简述-->
            <div class="task-dec task-item">
                <div class="add_iden">项目描述</div>
                <div class="task-dec-info clearfix">
                    <div>科林环保装备股份有限公司创建于1979年，公司于2010年11月9日在深圳证券交易所上市，股票代码 SZ.002499。公司致力于构建集科研、咨询、设计、建造、工程总承包、营运、投融资等为一体的环保业务生态圈。</div>
                </div>
            </div>
            <!--需求简述-->
            <div class="task-dec task-item">
                <div class="add_iden">需求描述</div>
                <div class="task-dec-info clearfix">
                    <div>科林环保装备股份有限公司创建于1979年，公司于2010年11月9日在深圳证券交易所上市，股票代码 SZ.002499。公司致力于构建集科研、咨询、设计、建造、工程总承包、营运、投融资等为一体的环保业务生态圈。</div>
                </div>
            </div>
            <!--需求简述-->
            <div class="task-dec task-item">
                <div class="add_iden">附件下载</div>
                <div class="task-dec-info clearfix">
                    <ul class="file-down">
                        <li class="file-item"><a href="">教育素材.rar (3.59M) </a></li>
                        <li class="file-item"><a href="">教育素材.rar (3.59M) </a></li>
                        <li class="file-item"><a href="">教育素材.rar (3.59M) </a></li>
                        <li class="file-item"><a href="">教育素材.rar (3.59M) </a></li>
                    </ul>
                </div>
                <div class="jineng clearfix">
                    <span class="jineng-left lf" >技能:</span>
                    <span class="jineng-right lf"> 企业形象, 平面设计, 徽标设计</span>
                </div>
            </div>
            <!--时间轴-->
            <div class="add_pd time-line">
                <div class="time-line-inner">
                    <div class="blue-line"></div>
                    <ul class="line-group">
                        <li class="line-item">
                            <div class="line-title">报名截止</div>
                            <div class="line-time">2018.1.1</div>
                        </li>
                        <li class="line-item">
                            <div class="line-title">报名截止</div>
                            <div class="line-time">2018.1.1</div>
                        </li>
                        <li class="line-item">
                            <div class="line-title">报名截止</div>
                            <div class="line-time">2018.1.1</div>
                        </li>
                        <li class="line-item">
                            <div class="line-title">报名截止</div>
                            <div class="line-time">2018.1.1</div>
                        </li>
                        <li class="line-item">
                            <div class="line-title">报名截止</div>
                            <div class="line-time">2018.1.1</div>
                        </li>
                        <li class="line-item">
                            <div class="line-title">报名截止</div>
                            <div class="line-time">2018.1.1</div>
                        </li>
                    </ul>
                </div>
            </div>
            <!--结算清单-->
            <div class="add_pd time-line-commom">
                <div class="add_pd-title">
                    项目服务
                </div>
                <div class="time-line-common-inner">
                    <div class="service1 service clearfix">
                        <div class="server-change lf">
                            <div class="layui-input-inline">
                                <input type="checkbox" name="taskheader" lay-skin="switch" lay-filter="taskheader" >
                            </div>
                        </div>
                        <div class="service-img lf">
                            <span class="ding">顶</span>
                        </div>
                        <div class="service-title lf">
                            <h4>置顶 <span style="color: red;">按天收费</span></h4>
                            <p>任务图标置顶,获得更高关注度,可能会产生意想不到的收获哦</p>
                        </div>
                        <div class="serive-num rf">
                            <div class="layui-form-item">
                                <div class="layui-input-inline">
                                    <input type="number" name="taskheadernum"  placeholder="" autocomplete="off" class="layui-input taskheadernum" value="0">
                                </div>
                                <div class="layui-form-mid layui-word-aux">天</div>
                                <!--注意   改动data-price才会自动改动后计算价格           -->
                                <span class="service-price" data-price="20">¥20元/天</span>
                            </div>
                        </div>

                    </div>
                    <!-- <div class="service2 service clearfix">
                        <div class="server-change lf">
                            <div class="layui-input-inline">
                                <input type="checkbox" name="taskfast" lay-skin="switch" lay-filter="taskfast" checked>
                            </div>
                        </div>
                        <div class="service-img lf">
                            <span class="ding">急</span>
                        </div>
                        <div class="service-title lf">
                            <h4>加急 <span style="color: red;">一个任务仅限一次</span></h4>
                            <p>任务图标加急,适合紧急任务,提供多方式推广,可能会产生意想不到的收获哦</p>
                        </div>
                        <div class="serive-num rf">
                            <div class="layui-form-item service-fast">
                                如您的项目在提前
                                <span class="" style="color: red;"> 30 </span>
                                天完成,需额外支付
                                <span class="" style="color: red;"> 1000 </span>
                                元
                            </div>
                        </div>

                    </div> -->

                </div>
            </div>
            <!--结算清单-->
            <div class="add_pd time-line-commom">
                <div class="add_pd-title">
                    结算清单
                </div>
                <div class="time-line-common-inner">
                    <ul class="money-list">
                        <li class="money-list-item clearfix">
                            <span class="lf">任务费用：</span><span class="lf" style="color: #EE2222">10000</span>元
                        </li>
                        <li class="money-list-item clearfix">
                            <span class="lf">增值费用：</span><span class="lf task-zengzhi-money" style="color: #EE2222">1000</span>元
                        </li>
                        <li class="money-list-item clearfix">
                            <span class="lf">置顶费用：</span><span class="lf task-ding-money" style="color: #EE2222">0</span>元
                        </li>
                        <li class="money-list-item clearfix " style="font-size: 16px;margin-top: 10px">
                            <span class="lf">任务费用：</span><span class="lf" style="color: #EE2222">10000</span>元
                        </li>
                    </ul>
                </div>
            </div>



        </div>

        <div class="task-but main">
            <button class="task-btn-n1">下一步</button>
            <button class="task-btn-n2">返回修改</button>
        </div>
    </div>


</form>
<!-- 尾部 -->
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

        for (var i =1;i<=6;i++){
            if(i=1){
                laydate.render({
                    elem: '#buildDate0'+i,
                    min: -1, //7天前
                    type:'datetime',
                    format:'yyyy-MM-dd HH:mm',
                    value:new Date()+86400000*i
                });
            }else{
                laydate.render({
                    elem: '#buildDate0'+i,
                    type:'datetime',
                    format:'yyyy-MM-dd HH:mm',
                    value:new Date()+86400000*i
                }); 
            }
            
        }
//        置顶价格动态计算
        form.on('switch(taskheader)', function(data){
            console.log(data.elem.checked); //开关是否开启，true或者false
            var target = $('.task-ding-money');
            var needmoney = 0;
            if (data.elem.checked){
                var num = $('.taskheadernum').val();
                price = $('.service-price').attr('data-price');
                needmoney = num*price;
                $('.taskheadernum').attr('disabled',false)

            }else{
                $('.taskheadernum').attr('disabled','disabled')

            }
            target.text(needmoney)
        });
        $('.taskheadernum').on('blur',function () {
            var num = $('.taskheadernum').val();
            if (num<0){
                $(this).val(0);
                layer.alert('天数不能小于0');
                return false
            }
            price = $('.service-price').attr('data-price');
            needmoney = num*price;
            $('.task-ding-money').text(needmoney);
        })
//        增值费用
        form.on('switch(taskfast)', function(data){
            console.log(data.elem.checked); //开关是否开启，true或者false
            var target = $('.task-zengzhi-money');
            var needmoney = 0;
            if (data.elem.checked){
                needmoney = 1000
            }
            target.text(needmoney)
        });

    });
</script>
</body>
</html>