

$("#btn_ready").on('click',function(){

  var order_id = $(this).attr('data-id');
  var col = ".col_" + order_id;
  console.log(col);
  console.log(($(col).children()).length);
  console.log(($(col).children(".active")).length);
  if( ($(col).children()).length == ($(col).children(".active")).length)  {
    alert(order_id);
     $.ajax({
       type: 'POST',
       url: '../controller/AJAXstatusUpdate.php', // will change to other php when done
       data: {
         order_id:order_id
       },
       success: function (data) {
         location.reload();
       }
   });
  }
});



$("dt").click(function(){
  if($(this).hasClass("active")){
    $(this).removeClass('active');
  }else{
      $(this).addClass('active');

  }

});

$("dd").click(function(){
  if($(this).hasClass("active")){
    $(this).removeClass('active');
  }else{
      $(this).addClass('active');
  }
});
