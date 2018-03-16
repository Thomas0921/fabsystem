
$("button").on('click',function(){
  var order_id = $(this).attr('data-id');
   $.ajax({
     type: 'POST',
     url: 'AJAXstatusUpdate.php', // will change to other php when done
     data: {
       order_id:order_id,
     },
     success: function (data) {
       alert(data);
     }
 });
});
