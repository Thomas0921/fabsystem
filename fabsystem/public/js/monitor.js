$(document).ready(function(){
  function load_data(query, date)
{
  $.ajax({
  url:"../controller/fetch.php",
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
  var date = $("#date_picker").val();
  console.log(search);
  console.log(date);
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
 });
});

$(document).ready(function(){
      //Iterate through each of the rows
       $('tr').each(function(){
         //Check the value of the last <td> element in the row (trimmed to ignore white-space)
         if($(this).find('td').text().trim() === "1"){
             //Set the row to green
             $(this).css('background','#ffe800');
         }
         if ($(this).find('td').text().trim() === "2") {
           $(this).css('background','#37d726');
         }
         if ($(this).find('td').text().trim() === "3") {
           $(this).css('background','#0775c8');
         }
         if ($(this).find('td').text().trim() === "4") {
           $(this).css('background','#a0a0a0');
         }
         if ($(this).find('td').text().trim() === "5") {
           $(this).css('background','gray');
         }
       });
   });
   //subtotal
        var sum = 0;
        $('#first .nettSum').each(function()
        {
        sum += parseFloat($(this).html());

        });
    //total delivery
      var sum = 0;
      $('#first .netDelivery').each(function()
      {
        sum += parseFloat($(this).html());

      });
      $('#totalDelivery').html(sum);

      $('#date_picker').on("change", function(){

      var query = $("#search_text").val();
      var date = $(this).val();

    $.ajax({
     url:"../controller/fetch.php",
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
