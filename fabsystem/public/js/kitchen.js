

$(".btn_ready").on('click',function(){
  var order_id = $(this).attr('data-id');
  var col_no = "col_" + order_id;
  if($("#"+ col_no + " dd").length == $("#"+ col_no + " dd.active").length && $("#"+ col_no + " dt").length == $("#"+ col_no + " dt.active").length)  {

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
 }else {
   alert("Please tick the food done above before sending");
 }
});


function setContent(inside) {
  if($(inside).hasClass("active")){
    $(inside).removeClass('active');
  }else{
      $(inside).addClass('active');
  }
}

$("dt, dd").click(function(e) {
    setContent(this);
    var activeIndex = $(this).index();
    localStorage.setItem("activeSelection", activeIndex);
});

var activeIndex = localStorage.getItem("activeSelection");
if (isNaN(activeIndex)) {
       console.log('nothing stored');
   } else {
       $('.columns dd:nth-child('+activeIndex+')').addClass('active');
   }
