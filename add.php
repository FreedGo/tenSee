<?php
if(!defined('InEmpireCMS'))
{
	exit();
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>雇主发布任务</title>
    <link href="/css/style.css" type="text/css" rel="stylesheet">
    <link href="/css/task.css" type="text/css" rel="stylesheet">
    <link href="/css/uploader.css" type="text/css" rel="stylesheet">
    <!--<link rel="stylesheet" href="./libs/webuploader/webuploader.css">-->
    <script src="/js/jquery.js"></script>
</head>

<body>
<?php
require(ECMS_PATH.'e/template/public/headeri.php');
?>
<form class="layui-form" action="/e/member/task/add_1.php" method="post">
    <div class="add_task">
        <div class="main add_title yuan">发布任务</div>

        <!-- 表单详情 -->
        <div class="main add_info yuan">
            <h3>发布任务详情</h3>
            <div class="add_type clearfix">
                <ul>
                    <li><i class="add_n1"></i>
                        <p>选择交易模式</p></li>
                    <li><i class="add_n2"></i>
                        <p>描述任务需求</p></li>
                    <li><i class="add_n3"></i>
                        <p>核对交易清单</p></li>
                    <li><i class="add_n4"></i>
                        <p>成功发布任务</p></li>
                </ul>
            </div>

            <div class="add_iden">竞标悬赏</div>

            <div class="add_pd">

                <div class="clearfix">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="lf inp_ut"><input type="text" name="title" lay-verify="title" autocomplete="off"
                                                  placeholder="请输入标题" class="layui-input"><em>30</em></div>
                    <div class="rt clearfix">
                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>
                <em class="ad_tx">精确的项目名称可以使用户快速查找</em>

                <!-- 分类 -->
                <div class="clearfix">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="lf inp_ut ">
                        <div class="layui-form-item">
                            <div class="layui-input-inline">
                                <select name="quiz1">
                                    <option value="">请选择项目分类</option>
                                    <option value="浙江">浙江省</option>
                                    <option value="你的工号">江西省</option>
                                    <option value="你最喜欢的老师">福建省</option>
                                </select>
                            </div>
                            <div class="layui-input-inline">
                                <select name="quiz2">
                                    <option value="">请选择项目二级分类</option>
                                    <option value="杭州">杭州</option>
                                    <option value="宁波">宁波</option>
                                    <option value="温州">温州</option>
                                    <option value="温州">台州</option>
                                    <option value="温州">绍兴</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="rt clearfix">
                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>
                <em class="ad_tx"></em>

                <!-- 城市 -->
                <div class="clearfix">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="lf inp_ut">
                        <!--<div class="layui-form-item">-->
                            <!--<div class="layui-input-inline">-->
                                <!--<select name="quiz1">-->
                                    <!--<option value="">请选择省</option>-->
                                    <!--<option value="浙江">浙江省</option>-->
                                    <!--<option value="你的工号">江西省</option>-->
                                    <!--<option value="你最喜欢的老师">福建省</option>-->
                                <!--</select>-->
                            <!--</div>-->
                            <!--<div class="layui-input-inline">-->
                                <!--<select name="quiz2">-->
                                    <!--<option value="">请选择市</option>-->
                                    <!--<option value="杭州">杭州</option>-->
                                    <!--<option value="宁波">宁波</option>-->
                                    <!--<option value="温州">温州</option>-->
                                    <!--<option value="温州">台州</option>-->
                                    <!--<option value="温州">绍兴</option>-->
                                <!--</select>-->
                            <!--</div>-->
                            <!--<div class="layui-input-inline">-->
                                <!--<select name="quiz3">-->
                                    <!--<option value="">请选择县/区</option>-->
                                    <!--<option value="西湖区">西湖区</option>-->
                                    <!--<option value="余杭区">余杭区</option>-->
                                    <!--<option value="拱墅区">临安市</option>-->
                                <!--</select>-->
                            <!--</div>-->
                        <!--</div>-->
                        <!--省市区三级联动-->
                        <div id="p1"></div>

                    </div>
                    <div class="rt clearfix">
                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>
                <em class="ad_tx"></em>

                <div class="clearfix">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="lf inp_text"><textarea placeholder="请输入内容"
                                                       class="layui-textarea"></textarea><em>120</em></div>
                    <div class="rt clearfix">
                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>
                <em class="ad_tx"></em>
                <div class="clearfix">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="lf inp_phone"><input type="text" name="title" lay-verify="title" autocomplete="off"
                                                     placeholder="项目联系人电话" class="layui-input"></div>
                    <div class="rt clearfix">
                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- 表单详情 -->
        <div class="main add_info yuan">
            <h3>发布任务详情<em class="">好的需求描述，能够让设计师更容易理解您，尽快的帮您完成需求</em></h3>

            <div class="add_pd">

                <div class="clearfix add_news">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="lf inp_newstext">
                      <!--百度编辑器-->
                        <!-- 加载编辑器的容器 -->
                        <script id="container" name="content" type="text/plain">
好的需求描述，能够让设计师更容易理解您，尽快的帮您完成需求；<br>

                            您可要参考下列描述，根据自己的需求选择填写：<br>

                            (1).LOGO名称（需要设计的内容）：如：中国设计网 以这五个字为LOGO，需要图片加文字的LOGO<br>

                            (2).设计对象介绍：如中国设计网是一个综合类型的设计UGC平台，主要为设计师提供有效传播和服务......<br>

                            (3).设计风格：如简洁大气、科技感强、小清新、要有亲和力......<br>

                            (4).设计色调：如蓝色、红色、黄色......<br>

                            (5).设计尺寸：如210*285<br>

                            (6).设计页数：如12页<br>

                            (7).设计用途：如用于公司十周年对外宣传用......<br>

                            (8).设计具体要求：如LOGO名称需中文、英文、拼音、图形......<br>
                        </script>
                    </div>
                    <div class="rt clearfix">
                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>


            </div>

        </div>


        <!-- 上传封面 -->
        <div class="main add_info yuan">
            <h3>上传封面<em class="">支持286像素*160像素，好的图片有助于项目的曝光度</em></h3>

            <div class="add_pd">

                <div class="clearfix add_news">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="lf add_pic">
                        <div id="uploader-title-pic">
                            <!--用来存放item-->
                            <div class="upload-title-pic-back">
                                <img src="/images/title_pic_03.jpg" alt="">
                            </div>
                            <div id="titlePic" class="title-wap"></div>
                            <div id="uploadTitlePic">选择图片</div>
                        </div>
                        <div id="ossfile"></div>
                        <div id="container">
                            <a id="selectfiles" href="javascript:void(0);" class='btn'>选择文件</a>
                                <a id="postfiles" href="javascript:void(0);" class='btn'>开始上传</a>

                            <!-- <a id="postfiles" href="javascript:void(0);" class='btn'>开始上传</a> -->
                        </div>
                    </div>
                    <div class="rt clearfix">
                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>


            </div>

        </div>

        <!-- 添加标签 -->
        <div class="main add_info yuan">
            <h3>添加标签<em class="">自选技能标签最多3个，添加标签可以把作品自动推荐给可能感兴趣的人</em></h3>

            <div class="add_pd">

                <div class="clearfix add_news">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="lf add_pic">
                        <div class="jinsom-single-tag-form">
                            <textarea id="add_tag_single_page" style="display: none;"></textarea>
                            <div class="jinsom-tag-had-select clear"></div>
                            <div class="jinsom-tag-no-select clear" style="margin-bottom: 50px;">
                                <li>规划设计</li>
                                <li>景观设计</li>
                                <li>室内设计</li>
                                <li>建筑设计</li>
                                <li>软装设计</li>
                                <li>服装设计</li>
                                <li>家具设计</li>
                                <li>广告设计</li>
                                <li>包装设计</li>
                                <li>图书设计</li>
                                <li>展陈设计</li>
                                <li>交通工具设计</li>
                                <li>轻工产品设计</li>
                                <li>机械设备设计</li>
                                <li>品牌标志设计</li>
                            </div>
                        </div>
                    </div>
                    <div class="rt clearfix">
                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>


            </div>

        </div>

        <!-- 上传附件 -->
        <div class="main add_info yuan">
            <h3>上传附件<em class="">仅支持格式
                ai/psd/pdf/doc/docx/xls/ppt/wps/zip/rar/txt/jpg/jpeg/gif/bmp/swf/png/lsp/mp3/stl/pptx</em></h3>

            <div class="add_pd">

                <div class="clearfix add_news">
                    <div class="lf inp_bt"><i></i></div>
                    <div class="lf ">
                        <button type="button" class="layui-btn layui-btn-normal" id="testList">选择多文件</button>
                        <button type="button" class="layui-btn" id="testListAction">开始上传</button>
                        <div class="layui-upload-list">
                            <table class="layui-table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="demoList"></tbody>
                            </table>
                        </div>

                    </div>
                    <div class="rt clearfix">
                        <div class="lf inp_tx"><i></i></div>
                        <div class="lf inp_tx">必填项</div>
                    </div>
                </div>


            </div>

        </div>

        <div class="task-but main">
            <button class="task-btn-n1">下一步</button>
            <!--<button class="task-btn-n2">预览</button>-->
        </div>
    </div>


</form>
<!-- 尾部 -->
<?php
require(ECMS_PATH.'e/template/public/footer.php');
?>
<script type="text/javascript" src="/layui/layui.all.js"></script>
<!-- 百度编辑器配置文件 -->
<script type="text/javascript" src="/e/extend/ueditor/ueditor.config.js"></script>
<!-- 百度编辑器源码文件 -->
<script type="text/javascript" src="/e/extend/ueditor/ueditor.all.min.js"></script>
<script src="/js/area_data.js"></script>
<script type="text/javascript">
//    实例化百度编辑器
    var ue = UE.getEditor('container');
 


</script>
<script type="text/javascript" src="/e/extend/oss-h5-upload-js-direct/lib/crypto1/crypto/crypto.js"></script>
<script type="text/javascript" src="/e/extend/oss-h5-upload-js-direct/lib/crypto1/hmac/hmac.js"></script>
<script type="text/javascript" src="/e/extend/oss-h5-upload-js-direct/lib/crypto1/sha1/sha1.js"></script>
<script type="text/javascript" src="/e/extend/oss-h5-upload-js-direct/lib/base64.js"></script>
<script type="text/javascript" src="/e/extend/oss-h5-upload-js-direct/lib/plupload-2.1.2/js/plupload.full.min.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
<script>
    // 三级联动
    layui.use(['picker'], function () {
        var picker = layui.picker;
        //demo1
        var p1 = new picker();
        p1.set({
            elem: '#p1',
            data: Areas,
            codeConfig: {
                code: 440104,
                type: 3
            }
        }).render();

    });


    //添加标签（普通用户）
    $(document).on('click', '.jinsom-tag-no-select li', function () {
        if ($('.jinsom-tag-had-select li').length <= 2) {
            $('.jinsom-tag-had-select').prepend($(this));
            tags_html = $(this).html();
            tags = $('#add_tag_single_page').val();
            if (tags == '') {
                $('#add_tag_single_page').val(tags_html);
            } else {
                $('#add_tag_single_page').val(tags + ',' + tags_html);
            }


            $(this).off("click");
        } else {
            layer.msg('最多只能添加3个标签！');
            return false;
        }
    });
    //点击取消标签
    $(document).on('click', '.jinsom-tag-had-select li', function () {
        $('.jinsom-tag-no-select').prepend($(this));
        num = $('.jinsom-tag-had-select li').length;
        if (num == 0) {
            $('#add_tag_single_page').val('');
        } else {
            var tag_arr = [];
            $('.jinsom-tag-had-select').find('li').each(function () {
                tag_text = $(this).html();
                tag_arr.push(tag_text);
            });

            tag_data = tag_arr.join(",");
            $('#add_tag_single_page').val(tag_data);
        }

        $(this).off("click");
    });

</script>


<!--协议开始-->
<script>
    $.ajax({
        type: "POST",
        url: "xieyi.html",
        data: {pop_login_style: 1},
        success: function (msg) {
            setTimeout(function () {
                layer.closeAll('loading');
            });
            layer.open({
                title: '支持以下方式登录',
                btn: false,
                area: ['900px', '480px'],
                skin: 'pop_login_style',
                content: msg
            })
        }
    });

</script>
<!--协议结束-->


</body>
</html>