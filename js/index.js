// JavaScript Document

function header_so(){
	layer.msg('搜索处理');
}


//轮播
layui.use(['carousel', 'form'], function(){
  var carousel = layui.carousel
  ,form = layui.form;
  carousel.render({
    elem: '#index_lb'
    ,width: '100%'
    ,height: '700px'
    ,interval: 3000
	,indicator:'none'
  });

});
//项目列表轮播
layui.use(['carousel', 'form'], function(){
  var carousel = layui.carousel
  ,form = layui.form;
  carousel.render({
    elem: '#task_lb'
    ,width: '100%'
    ,height: '350px'
    ,interval: 3000
	,indicator:'none'
  });

});


//教育轮播
layui.use(['carousel', 'form'], function(){
  var carousel = layui.carousel
  ,form = layui.form;
  carousel.render({
    elem: '#stu_lb'
    ,width: '100%'
    ,height: '520px'
    ,interval: 3000
	,indicator:'none'
  });

});