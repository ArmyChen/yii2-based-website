$(function(){
   setTimeout("refreshIndex()",1000);
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

 function refreshTable(){
        $.ajax({
               url:"/frontend/web/index.php?r=user%2Fajax",
               type:"get",
               data: {},
               success:function(e){
                  var result = eval(e);
                   var tbBody = "";
                  $.each(result, function(i, n) {
                    var increase = Math.round((n.retData.stockinfo.currentPrice - n.retData.stockinfo.OpenningPrice)*100, 2) / 100 + "%";
                    var flag = "label label-default";
                    if(increase > 0){
                        flag = "label label-danger";
                    }else if(increase == 0){
                        flag = "label label-default";
                    }else{
                        flag = "label label-success";
                    }
                    tbBody += "<tr><td>" + n.retData.stockinfo.code + "</td>" + "<td>" + n.retData.stockinfo.name + "</td>" + "<td><span class=\""+ flag +"\">" + n.retData.stockinfo.currentPrice + "</span></td>" + "<td><span class=\""+flag+"\">" + increase + "</span></td></tr>";
                  });
                  $("#table").html(tbBody);
               }
           });

      setTimeout("refreshTable()", 1000);
}