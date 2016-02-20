/**
 * Created by hany on 2/18/16.
 */
function changeProudctStatusUnAvail(PID){

    $.post("ajax/available.php",
        {
            product_id: PID,
            product_avail: "product_unavail"
        },
        function(data,status){

            if(status == "success"){
                //console.log(status);
                $('#status'+PID).removeClass("text-success");
                $('#status'+PID).addClass("text-danger");
              // $('#statusspan'+PID).html("UnAvialble");
                $('#status'+PID).attr("onclick","changeProudctStatusAvail("+PID+")");
                $('#status'+PID).html('<i class="fa fa-toggle-off fa-3x"></i>');
            }
        });
}
function changeProudctStatusAvail(PID){
    $.post("ajax/available.php",
        {
            product_id: PID,
            product_avail: "product_avail"
        },
        function(data, status){
            if(  status == "success"){
                $('#status'+PID).addClass("text-success");
                $('#status'+PID).removeClass("text-danger");
                //x$('#statusspan'+PID).html("Avialble");
                $('#status'+PID).attr("onclick","changeProudctStatusUnAvail("+PID+")");
                $('#status'+PID).html('<i class="fa fa-toggle-on fa-3x"></i>');


            }
        });
}
function deleteProudct(PID){
    $.post("ajax/do-product.php",
        {
            product_id: PID,
            delete_p: "delete_p"
        },
        function(data, status){
            //alert(data+"status"+status);
            if(status == "success"){
                //alert(PID);
                $('#row'+PID).remove();
            }
        });
}
function editProudct(PID){
    window.location.href = "add-product.php?PID="+PID;
}
$(function(){
    updateDate_removed();
    updateDate_added();
});

function updateDate_added(){

    $.ajax({
        url:"ajax/do-update-product-add.php",
        method:'get',
        success:function(response){

            for(var i=0;i<response.length;i++){

                if($("#prod_"+response[i].prod_id).length==0){
                    var prod="<div class='col-md-3 col-xs-6 prod' data='"+response[i].prod_name+"' id='prod_"+response[i].prod_id+"'";
                    prod+="onclick='addproduct("+response[i].prod_id+")'>";
                    prod+=" <span class='badge' id='price_"+response[i].prod_id+"'";
                    prod+=" data='"+response[i].price+"'>"+response[i].price +"L.E </span>";
                    prod+="<img src='"+response[i].pic_link+"' />";
                    prod+="<h3>"+response[i].prod_name+"</h3></div>";
                    $('.right_order').append(prod);
                }
            }
            updateDate_added();
        },
        complete:function(){
        }, cache: false,
        async:true,
        dataType:'json'
    });
}
function updateDate_removed(){
    $.ajax({
        url:"ajax/do-update-product.php",
        method:'get',
        data:{},
        success:function(response){
            for(var i=0;i<response.length;i++){
                if($("#prod_"+response[i].prod_id).length){
                    $("#prod_"+response[i].prod_id).remove();
                }
                if($("#prod_last_"+response[i].prod_id).length){
                    $("#prod_last_"+response[i].prod_id).remove();
                }
            }
            updateDate_removed();
        },
        complete:function(){
        }, cache: false,
        async:true,
        dataType:'json'
    });
}
function calculateall(){
    var priceall=0;
    $("#orders li").each(function(){
        var id=$(this).attr('data');
        var p=$("#price_"+id).attr('data');
        var c=$("#count_"+id).text();
        var to=parseInt(p)*parseInt(c);
        priceall +=to;
        $("#total").html(priceall+" EGP");
    });
}
function addproduct (id) {
    if($("#orders #order_pro_" + id).length == 0) {
        var pro_name=$("#prod_"+id).attr("data");
        var price=$("#price_"+id).attr("data");
        $("#orders").append("<li id='order_pro_"+id+"' data='"+id+"' ><span id='pro_name_"+id+"' class='col-md-4'>"+pro_name+"</span><span id='count_"+id+"' class='col-md-1 no_order'>1</span><span class='col-md-2'><span class='glyphicon glyphicon-plus col-md-12' onclick='incremaent("+id+")'></span><span class='glyphicon glyphicon-minus col-md-12'  onclick='decremaent("+id+")'></span></span><span class='col-md-4 price_order' id='price_pro_"+id+"' data='"+price+"'>"+price+" EGP</span><span class='glyphicon glyphicon-trash col-md-1'  onclick='deleteli("+id+")'></span><p class='clearfix'></p></li>");
        calculateall();

    }else{
        incremaent(id);
    }
}
function decremaent(id){
    var count=$("#count_"+id).text();
    var price=$("#price_"+id).attr("data");
    if(count!='1'){
        count=parseInt(count)-1;
        var total_pro=parseInt(price)*count;
        $("#count_"+id).text(count);
        $("#price_pro_"+id).text(total_pro+" EGP");
        $("#price_pro_"+id).attr('data',total_pro);
        calculateall();
    }
}
function incremaent(id){
    var price=$("#price_"+id).attr("data");
    var count=$("#count_"+id).text();
    count =parseInt(count)+1;
    var total_pro=parseInt(price)*count;
    $("#count_"+id).text(count);
    $("#price_pro_"+id).text(total_pro+" EGP");
    $("#price_pro_"+id).attr('data',total_pro);
    calculateall();
}
function deleteli(id){
    $('#order_pro_'+id).remove();
    calculateall();
}

function sendOrder(){
    $(".result").show();
    if($("#send_user_order #room_number").val()==''||$("#orders li").length==0){
        $(".result").html("<p class='error'>Please enter data<p>");
    }else{
        var data=[];
        $("#orders li").each(function(){
            var id=$(this).attr('data');
            var c=$("#count_"+id).text();
            c=parseInt(c);
            var pro=$("#price_"+id).attr('data');
            var obj={'count':c,'id_prod':id,'price':pro};
            data.push(obj);
        });
        var data2 = $('#send_user_order').serializeArray();
        data2['orders']=data;
        //  console.log(data2);
        $.ajax({
            url: "ajax/do-add-order.php",
            type: "POST",
            data:  $('#send_user_order').serialize()+"&orders="+JSON.stringify(data),
            success: function(e){
                $(".result").html(e);
                $("#total").html("");
                $("#orders").html("");
                $(".nodes").text("");
            },
            error: function(e){          }
        });
    }
}