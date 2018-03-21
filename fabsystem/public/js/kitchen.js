

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
         console.log(data);

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

$("dt, dd").click(function() {
    setContent(this);
});

$(window).bind("beforeunload", function(){

  var count = 0;
  $(".columns").each(function(){
    count ++;
  });
  localStorage.setItem("before", count);
});

$(window).on("load", function(){
  var sound = new Audio("../../public/audio/Rider Sound Effect.mp3");
  var before = localStorage.getItem("before");
  var count = 0;
  $(".columns").each(function(){
    count ++;
  });
  var after = count;
  // calculate how many new order came in
  var different = after - before;

  if(different > 0){
    sound.play()
  }
});
