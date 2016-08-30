$(function(){
   setTimeout("refreshIndex()",500);
});


/**
 * 刷新首页的上证深成数据
 * 更新当前时间
 */
function refreshIndex() {
    $(".img_sh").removeAttr("src");
    $(".img_sz").removeAttr("src");
    $(".img_sh").attr("src", "http://image.sinajs.cn/newchart/min/n/sh000001.gif");
    $(".img_sz").attr("src", "http://image.sinajs.cn/newchart/min/n/sz399001.gif");
    $("#currenttime").html("当前时间："+ new Date().Format("yyyy-MM-dd hh:mm:ss"));
    setTimeout("refreshIndex()", 1000);
}