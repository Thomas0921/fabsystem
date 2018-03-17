$(".btn_delivery").on('click',function(){

  var order_id = $(this).attr('data-id');
  var opt = $('option[value="'+$("#datalist-rider-id-input").val()+'"]');
  var rider_id = opt.attr("data-id");
  var status = "delivering";
  console.log(rider_id);
  console.log(order_id);
  if(rider_id == undefined) {
    alert("Please select a rider from the list");
  }else {
    $.ajax({
    type: 'POST',
    url: '../controller/AJAXDriverStatusUpdate.php', // will change to other php when done
    data: {
      status:status,
      rider_id: rider_id,
      order_id:order_id
    },
    success: function (data) {
      alert(data);
      location.reload();
      }
    });
  }
});

$(".columns").each(function(){
  var id_selected = $(this).attr("data-id");
  if ($("#col_" + id_selected + " p#value").text() == 3) {
    $("#col_" + id_selected + " li.header").removeClass('header').attr('id', 'button-clicked');
    $("#col_" + id_selected + " li button.btn_complete").css('display','block');
    $("#col_" + id_selected + " li button.btn_delivery").css('display','none');
    $("#col_" + id_selected + " li #datalist-rider-id").css('display','none');
    $("#col_" + id_selected + " li p#rider_name_p").css('display','block');


  }else if ($("#col_" + id_selected + " p#value").text() == 2) {
    $("#col_" + id_selected + " li button.btn_complete").css('display','none');
    $("#col_" + id_selected + " li button.btn_delivery").css('display','block');
    $("#col_" + id_selected + " li #datalist-rider-id").css('display','block');
    $("#col_" + id_selected + " li p#rider_name_p").css('display','none');
  }
});


$(".btn_complete").on('click',function(){
  var order_id = $(this).attr('data-id');
  var status = "completed";

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

//---------------------------------------------------------------
// edit box

$(".btn-edit").click(function(){
  $(".popup-bg").show();
});

$(".close-popup").click(function(){
  $(".popup-bg").hide();
});

//---------------------------------------------------------------
// pop up add category AJAX
$("#btn_add_rider").click(function(){

  var opt = $('option[value="'+ $("#datalist-rider-id").val() +'"]');
  var rider_id = opt.attr("data-id");
  var rider_name = $("#datalist-rider-id").val();
  var status = "add";

  if(rider_id == undefined && rider_name != ""){
    rider_id = 0;
    if(rider_name === ""){
      alert("Rider field is empty");
    }else {
      $.ajax({
          type: "POST",
          url: "../controller/AJAXriderSQL.php",
          data: {
            status:status,
            rider_id:rider_id,
            rider_name:rider_name
          },
          success: function (data) {
            alert(data);
            $("#datalist-rider-id").val("");
          }
      }, function(){

     });
    }
  }
});

$("#btn_update_rider").click(function(){
  var rider_name = $("#datalist-rider-id").val();
  if(rider_name == ""){
    alert("Please choose an existing rider name to edit")
  }else {
    $("#datalist-rider-id").prop("disabled", true);
    $("#editRiderInput").val(rider_name);
    $("#editRiderInput").show();
    $("#editRiderButton").show();
  }
});

$("#editRiderButton").click(function(){
  var opt = $('option[value="'+ $("#datalist-rider-id").val() +'"]');
  var rider_id = opt.attr("data-id");
  var rider_name = $("#editRiderInput").val();
  var status = "update";

  if(rider_name == ""){
    alert("Rider field is empty");
  }else {
    $.ajax({
        type: "POST",
        url: "../controller/AJAXriderSQL.php",
        data: {
          status:status,
          rider_id:rider_id,
          rider_name:rider_name
        },
        success: function (data) {
          alert(data);
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

$("#btn_delete_rider").click(function(){
  var opt = $('option[value="'+ $("#datalist-rider-id").val() +'"]');
  var rider_id = opt.attr("data-id");
  var status = "delete";

  if(rider_id == undefined){
    alert("category field is empty");
  }else {
    $.ajax({
        type: "POST",
        url: "../controller/AJAXriderSQL.php",
        data: {
          status:status,
          rider_id:rider_id,
        },
        success: function (data) {
          alert(data);
          $("#datalist-rider-id").val("");
        }
    }, function(){
      //This function is for unhover.
   });
  }
});
