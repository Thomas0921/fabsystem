

$(".btn_ready").on('click',function(){
  var order_id = $(this).attr('data-id');
  var col_no = "col_" + order_id;

  if($("#"+ col_no + " dd").length == $("#"+ col_no + " dd.active").length && $("#"+ col_no + " dt").length == $("#"+ col_no + " dt.active").length)  {
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



$("dt, dd").click(function(){
setContent(this);
localStorage.setItem('active-container', $(this).data('rel'));
});

// set content on load
localStorage.getItem('active-container');

function setContent(inside) {
  if($(inside).hasClass("active")){
    $(inside).removeClass('active');
  }else{
      $(inside).addClass('active');
  }
}
