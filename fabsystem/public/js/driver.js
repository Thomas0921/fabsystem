$(".btn_delivery").on('click',function(){
  var order_id = $(this).attr('data-id');
  var status = "ready";

     $.ajax({
     type: 'POST',
     url: '../controller/AJAXDriverStatusUpdate.php', // will change to other php when done
     data: {
       status:status,
       order_id:order_id
     },
     success: function (data) {
       alert(data);
       location.reload();
       }
 });
});

$(".columns").each(function(){
  var id_selected = $(this).attr("data-id");
  if ($("#col_" + id_selected + " p#value").text() == 3) {
    $("#col_" + id_selected + " li.header").removeClass('header').attr('id', 'button-clicked');
    $("#col_" + id_selected + " li button.btn_complete").css('display','block');
    $("#col_" + id_selected + " li button.btn_delivery").css('display','none');

  }else if ($("#col_" + id_selected + " p#value").text() == 2) {
    $("#col_" + id_selected + " li button.btn_complete").css('display','none');
    $("#col_" + id_selected + " li button.btn_delivery").css('display','block');
  }
});


$(".btn_complete").on('click',function(){
  var order_id = $(this).attr('data-id');
  var status = "delivering";

   $.ajax({
     type: 'POST',
     url: '../controller/AJAXDriverStatusUpdate.php', // will change to other php when done
     data: {
       status:status,
       order_id:order_id
     },
     success: function (data) {
       alert(data);
       location.reload();
     }
 });
});


$(".qr").each(function() {
  var id = $(this).attr("data-id");
  generate_qrcode($(this).text(), $(this));
});

function generate_qrcode(sample, identifier){
  var input = sample.replace(/\,/g,' ');
  var url = input.replace(/\ /g, '%20');
  var sample = 'http://maps.google.com/maps?q='+ url +'"target="_blank"';
    $.ajax({
    type: 'POST',
    url: '../controller/code.php',
    data : {sample:sample},
    success: function(code){
      $(identifier).html(code);
      }
    });
  }