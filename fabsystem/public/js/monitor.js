$(document).ready(function(){

  function load_data(query, date)
{
  $.ajax({
  url:"../controller/AJAXmonitorfetch.php",
  method:"POST",
  data:{
     query:query,
     date:date
       },
  success:function(data)
    {
    $('#result').html(data);
    }
  });
}


$('#search_text').keyup(function(){

  var search = $(this).val();
  if(search == ""){
    search = "";
    var date = $("#date_picker").val();
  }else {
    var date = $("#date_picker").val();
    if(search != '')
    {
      // load search result and hide table
     load_data(search, date);
    }
    else
    {
      // when no search result and show table
      $('#result').html("");
    }
  }
 });

});// end of document ready

//subtotal
var sum = 0;
$('#first .nettSum').each(function()
{
sum += parseFloat($(this).html());

});
//total delivery
var sum = 0;
$('#first .netDelivery').each(function(){
    sum += parseFloat($(this).html());

});

$('#totalDelivery').html(sum);

$('#date_picker').on("change", function(){

  var query = $("#search_text").val();
  var date = $(this).val();

    $.ajax({
      url:"../controller/AJAXmonitorfetch.php",
      method:"POST",
      data:{
        query:query,
        date:date
      },
      success:function(data)
      {
      $('#result').html(data);
      }
    });
});

$("#date_picker").each(function(){
  var query = "";
  var date = $(this).val();
  $.ajax({
    url:"../controller/AJAXmonitorfetch.php",
    method:"POST",
    data:{
      query:query,
      date:date
    },
    success:function(data)
    {
    $('#result').html(data);
    }
  });
});
