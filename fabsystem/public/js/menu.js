//---------------------------------------------------------------
// Inhibit user from chaning total cost manually

$("#total-cart").focus(function(){
  alert("Sorry, you can't change the cost manually");
  $(this).blur();
});

//---------------------------------------------------------------
// food menu AJAX

$(".hover-detail").hover(function(){
   var id = $(this).attr("data-id");
       $.ajax({
           type: 'POST',
           url: '../controller/AJAXdetail.php',
           data: {id:id},
           success: function (id) {
               $('.show-description').html(id);
           }
       }, function(){
         //This function is for unhover.
      });
});

$(function(){
  $(".hover-addon-detail").hover(function(){
     var id = $(this).attr("addon-id");
         $.ajax({
             type: 'POST',
             url: '../controller/AJAXaddOnDetail.php',
             data: {id:id},
             success: function (id) {
                 $('.show-description').html(id);
             }
         }, function(){
           //This function is for unhover.
        });
  });
});

$(".hover-condition").hover(function(){
   var id = $(this).attr("data-id");
       $.ajax({
           type: 'POST',
           url: '../controller/AJAXconditionDetail.php',
           data: {id:id},
           success: function (id) {
               $('.show-description').html(id);
           }
       }, function(){
         //This function is for unhover.
      });
});
//---------------------------------------------------------------
// search AJAX

$(".searchOrder").keyup(function(){
   var name = $(this).val();

       $.ajax({
           type: 'POST',
           url: '../controller/AJAXmenuSearchOrder.php',
           data: {name:name},
           success: function (id) {
               $('.datalist_searchOrder').html(id);
           }
       }, function(){
         //This function is for unhover.
      });
});

$(".searchFoodId").keyup(function(){
   var name = $(this).val();
   if(name == ""){
     console.log("Need data to search");
   }else {
     $.ajax({
         type: 'POST',
         url: '../controller/AJAXmenuSearchFoodId.php',
         data: {name:name},
         success: function (id) {
             $('.datalist_searchFoodId').html(id);
         }
     }, function(){
       //This function is for unhover.
    });
   }

});

$(".searchAddonId").keyup(function(){
   var name = $(this).val();
   if(name == ""){
     console.log("Need data to search");
   }else {
     $.ajax({
         type: 'POST',
         url: '../controller/AJAXmenuSearchAddonId.php',
         data: {name:name},
         success: function (id) {
             $('.datalist_searchAddonId').html(id);
         }
     }, function(){
       //This function is for unhover.
    });
   }

});

$(".searchFood").keyup(function(){
   var name = $(this).val();

       $.ajax({
           type: 'POST',
           url: '../controller/AJAXmenuSearchFood.php',
           data: {name:name},
           success: function (id) {
               $('.datalist_searchFood').html(id);
           }
       }, function(){
         //This function is for unhover.
      });
});


$(".searchFood").change(function(){
  var opt = $('option[value="'+$(this).val()+'"]');
  var food_id = opt.attr('data-id');

  if(food_id == undefined ){
    alert("No record found");
    $('#datalist-cat-id').prop("disabled", false);
    $('#datalist-subcat-id').prop("disabled", false);
    $("#btn-add-food").show();
    $("#btn-update-food").hide();
    $("#btn-delete-food").hide();
    $("#food_code").val("");
    $("#food_name").val("");
    $("#food_description").val("");
    $("#food_price").val("");
  }else{
    $('#datalist-cat-id').prop("disabled", true);
    $('#datalist-subcat-id').prop("disabled", true);
    $("#btn-add-food").css("display", "none");
    $("#btn-update-food").css("display", "block");
    $("#btn-delete-food").css("display", "block");

         $.ajax({
             type: 'POST',
             url: '../controller/AJAXmenuFillFood.php',
             data: {food_id:food_id},
             success: function (data) {
               responseArray = data.split(",");

               $("#food_code").val(responseArray[0]);
               $("#food_name").val(responseArray[1]);
               $("#food_description").val(responseArray[2]);
               $("#food_price").val(responseArray[3]);
             }
         }, function(){
           //This function is for unhover.
        });
  }
});

$(".searchAddon").change(function(){
  var opt = $('option[value="'+$(this).val()+'"]');
  var add_on_id = opt.attr('data-id');

  if(add_on_id == undefined ){
    alert("No record found");
    $('#datalist-cat-id').prop("disabled", false);
    $("#btn-add-addon").css("display", "block");
    $("#btn-update-addon").css("display", "none");
    $("#btn-delete-addon").css("display", "none");
    $("#addon_code").val("");
    $("#addon_name").val("");
    $("#addon_description").val("");
    $("#addon_price").val("");
  }else{
    $('#datalist-addon-cat-id').prop("disabled", true);
    $("#btn-add-addon").css("display", "none");
    $("#btn-update-addon").css("display", "block");
    $("#btn-delete-addon").css("display", "block");

         $.ajax({
             type: 'POST',
             url: '../controller/AJAXmenuFillAddon.php',
             data: {add_on_id:add_on_id},
             success: function (data) {
               responseArray = data.split(",");

               $("#addon_code").val(responseArray[0]);
               $("#addon_name").val(responseArray[1]);
               $("#addon_description").val(responseArray[2]);
               $("#addon_price").val(responseArray[3]);
             }
         }, function(){
           //This function is for unhover.
        });
  }
});

$(".searchMembership").change(function(){
  var opt = $('option[value="'+$(this).val()+'"]');
  var membership_id = opt.attr('data-id');

  if(membership_id == undefined ){
    alert("No record found");
    $(".btn-add-membership").css("display", "block");
    $(".btn-update-membership").css("display", "none");
    $(".btn-delete-membership").css("display", "none");
    $("#membership_name").val("");
    $("#membership_address").val("");
    $("#membership_contact").val("");
  }else{
    $(".btn-add-membership").css("display", "none");
    $(".btn-update-membership").css("display", "block");
    $(".btn-delete-membership").css("display", "block");


         $.ajax({
             type: 'POST',
             url: '../controller/AJAXmenuFillMembership.php',
             data: {membership_id:membership_id},
             success: function (data) {
               responseArray = data.split(",");

               $("#membership_name").val(responseArray[0]);
               $("#membership_address").val(responseArray[1]);
               $("#membership_contact").val(responseArray[2]);

             }
         }, function(){
           //This function is for unhover.
        });
  }
});

$(".searchCondition").change(function(){
  var opt = $('option[value="'+$(this).val()+'"]');
  var condition_id = opt.attr('data-id');

  if(condition_id == undefined ){
    alert("No record found");
    $(".btn-add-condition").css("display", "block");
    $(".btn-update-condition").css("display", "none");
    $(".btn-delete-condition").css("display", "none");
    $("#condition_name").val("");
    $("#condition_description").val("");
    $("#condition_price").val("");
  }else{
    $(".btn-add-condition").css("display", "none");
    $(".btn-update-condition").css("display", "block");
    $(".btn-delete-condition").css("display", "block");


         $.ajax({
             type: 'POST',
             url: '../controller/AJAXmenuFillCondition.php',
             data: {condition_id:condition_id},
             success: function (data) {
               responseArray = data.split(",");

               $("#condition_name").val(responseArray[0]);
               $("#condition_description").val(responseArray[1]);
               $("#condition_price").val(responseArray[2]);
             }
         }, function(){
           //This function is for unhover.
        });
  }
});
//---------------------------------------------------------------
//Cancel order
$("#datalist-order-id").change(function(){
  var customer_name = $(this).val();
  var opt = $('option[value="'+ customer_name +'"]');
  var order_id = opt.attr("data-id");
  $("#btn-cancel-order").attr("order_id", order_id);
  var status_name = opt.attr("status_name");
  $("#btn-cancel-order").attr("status_name", status_name);
});

$("#btn-cancel-order").click(function(){

  var order_id = $(this).attr("order_id");
  var status_name = $(this).attr("status_name");

  if(order_id == undefined) {
    alert("Please select a previous order from the list");
  }else {
    $.ajax({
    type: 'POST',
    url: '../controller/AJAXorderStatusUpdate.php', // will change to other php when done
    data: {
      order_id:order_id
    },
    success: function (data) {
      alert(data);
      location.reload();
      }
    });
  }
});

//---------------------------------------------------------------
// pop up add category AJAX

$("#btn_add_subcategory").click(function(){
  var opt = $('option[value="'+ $("#datalist-cat-id").val() +'"]');
  var cat_id = opt.attr("data-id");
  var opt1 = $('option[value="'+ $("#datalist-subcat-id").val() +'"]');
  var subcat_id = opt1.attr("data-id");
  var subcat_name = $("#datalist-subcat-id").val();
  var status = "add";

  if(cat_id == undefined){
    alert("Please choose main category");
  } else{

    if(subcat_name === ""){
      alert("subcategory field is empty");
    }else {
      subcat_id = 0;
      $.ajax({
          type: "POST",
          url: "../controller/AJAXsubcategorySQL.php",
          data: {
            status,status,
            cat_id:cat_id,
            subcat_id:subcat_id,
            subcat_name:subcat_name
          },
          success: function (data) {
            alert(data);
            $(".searchAddon").val("");
            $("#datalist-cat-id").val("");
            $("#datalist-subcat-id").val("");
            $("#food_name").val("");
            $("#food_description").val("");
            $("#food_price").val("");
            location.reload();
          }
      }, function(){
        //This function is for unhover.
     });
    }
  }
});


$("#btn_delete_subcategory").click(function(){
  var opt = $('option[value="'+ $("#datalist-subcat-id").val() +'"]');
  var subcat_id = opt.attr("data-id");
  var status = "delete";

  if(subcat_id == undefined){
    alert("subcategory field is empty");
  }else {
    $.ajax({
        type: "POST",
        url: "../controller/AJAXsubcategorySQL.php",
        data: {
          status:status,
          subcat_id:subcat_id
        },
        success: function (data) {
          alert(data);
          $(".searchAddon").val("");
          $("#datalist-cat-id").val("");
          $("#datalist-subcat-id").val("");
          $("#food_name").val("");
          $("#food_description").val("");
          $("#food_price").val("");
          location.reload();
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

//---------------------------------------------------------------
// pop up add category AJAX

$("#btn_add_category").click(function(){

  var opt = $('option[value="'+ $("#datalist-cat-id").val() +'"]');
  var cat_id = opt.attr("data-id");
  var cat_name = $("#datalist-cat-id").val();
  var status = "add";

  if(cat_id == undefined && cat_name != ""){
    cat_id = 0;
    if(cat_name === ""){
      alert("Category field is empty");
    }else {
      $.ajax({
          type: "POST",
          url: "../controller/AJAXcategorySQL.php",
          data: {
            status:status,
            cat_id:cat_id,
            cat_name:cat_name
          },
          success: function (data) {
            alert(data);
            $(".searchAddon").val("");
            $("#datalist-cat-id").val("");
            $("#datalist-subcat-id").val("");
            $("#food_name").val("");
            $("#food_description").val("");
            $("#food_price").val("");
            location.reload();
          }
      }, function(){

     });
    }
  }
});


$("#btn_delete_category").click(function(){
  var opt = $('option[value="'+ $("#datalist-cat-id").val() +'"]');
  var cat_id = opt.attr("data-id");
  var status = "delete";

  if(cat_id == undefined){
    alert("category field is empty");
  }else {
    $.ajax({
        type: "POST",
        url: "../controller/AJAXcategorySQL.php",
        data: {
          status:status,
          cat_id:cat_id,
        },
        success: function (data) {
          alert(data);
          $(".searchAddon").val("");
          $("#datalist-cat-id").val("");
          $("#datalist-subcat-id").val("");
          $("#food_name").val("");
          $("#food_description").val("");
          $("#food_price").val("");
          location.reload();
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

//---------------------------------------------------------------
// food SQL AJAX

$("#btn-add-food").click(function(){
  var opt = $('option[value="'+$("#datalist-cat-id").val()+'"]');
  var cat_id = opt.attr('data-id');
  var opt2 = $('option[identifier="subcat"][value="'+$("#datalist-subcat-id").val()+'"]');
  var subcat_id = opt2.attr('data-id');
  var code = $("#food_code").val();
  var name = $("#food_name").val();
  var description = $("#food_description").val();
  var price = $("#food_price").val();
  if(cat_id === "" && subcat_id === "" || code === "" || name === "" || description === "" || price === ""){
    alert("Please fill in all the field");
  }else {
    $.ajax({
        type: 'POST',
        url: '../controller/AJAXfoodSQL.php',
        data: {
          cat_id:cat_id,
          subcat_id:subcat_id,
          code:code,
          name:name,
          description:description,
          price:price
        },
        success: function (data) {
          alert(data);
          $(".searchAddon").val("");
          $("#datalist-cat-id").val("");
          $("#datalist-subcat-id").val("");
          $("#food_code").val("");
          $("#food_name").val("");
          $("#food_description").val("");
          $("#food_price").val("");
          location.reload();
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

$("#btn-update-food").click(function(){
  var opt = $('option[value="'+$(".searchFood").val()+'"]');
  var update_food_id = opt.attr('data-id');
  var code = $("#food_code").val();
  var name = $("#food_name").val();
  var description = $("#food_description").val();
  var price = $("#food_price").val();

  $.ajax({
      type: 'POST',
      url: '../controller/AJAXfoodSQL.php',
      data: {
        update_food_id:update_food_id,
        code:code,
        name:name,
        description:description,
        price:price
      },
      success: function (data) {
        alert(data);
        $(".searchFood").val("");
        $("#datalist-cat-id").val("");
        $("#datalist-subcat-id").val("");
        $("#food_code").val("");
        $("#food_name").val("");
        $("#food_description").val("");
        $("#food_price").val("");
        location.reload();
      }
  }, function(){
    //This function is for unhover.
 });

});

$("#btn-delete-food").click(function(){
  var opt = $('option[value="'+$(".searchAddon").val()+'"]');
  var delete_food_id = opt.attr('data-id');

  $.ajax({
      type: 'POST',
      url: '../controller/AJAXfoodSQL.php',
      data: {
        delete_food_id:delete_food_id,
      },
      success: function (data) {
        alert("Record deleted");
        $(".searchFood").val("");
        $("#datalist-cat-id").val("");
        $("#datalist-subcat-id").val("");
        $("#food_code").val("");
        $("#food_name").val("");
        $("#food_description").val("");
        $("#food_price").val("");
        location.reload();
      }
  }, function(){
    //This function is for unhover.
 });

});

//---------------------------------------------------------------
// addon SQL AJAX

$("#btn-add-addon").click(function(){
  var opt = $('option[value="'+$("#datalist-addon-cat-id").val()+'"]');
  var add_addon_id = opt.attr('data-id');
  var code = $("#addon_code").val();
  var name = $("#addon_name").val();
  var description = $("#addon_description").val();
  var price = $("#addon_price").val();

  if(add_addon_id === "" && name === "" || description === "" || price === ""){
    $('.form-notice-addon').html("Please fill in all the field");
  }else{
    $('.form-notice-addon').html("");
    $.ajax({
        type: 'POST',
        url: '../controller/AJAXaddonSQL.php',
        data: {
          add_addon_id:add_addon_id,
          code:code,
          name:name,
          description:description,
          price:price
        },
        success: function (data) {
          alert("Record added");
          $(".searchAddon").val("")
          $("#datalist-addon-cat-id").val("")
          $("#addon_code").val("");
          $("#addon_name").val("");
          $("#addon_description").val("");
          $("#addon_price").val("");
          location.reload();
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

$("#btn-update-addon").click(function(){
  var opt = $('option[value="'+$(".searchAddon").val()+'"]');
  var update_addon_id = opt.attr('data-id');
  var code = $("#addon_code").val();
  var name = $("#addon_name").val();
  var description = $("#addon_description").val();
  var price = $("#addon_price").val();

  $.ajax({
      type: 'POST',
      url: '../controller/AJAXaddonSQL.php',
      data: {
        update_addon_id:update_addon_id,
        code:code,
        name:name,
        description:description,
        price:price
      },
      success: function (data) {
        alert(data);
        $(".searchAddon").val("")
        $("#datalist-addon-cat-id").val("")
        $("#addon_code").val("");
        $("#addon_name").val("");
        $("#addon_description").val("");
        $("#addon_price").val("");
        location.reload();
      }
  }, function(){
    //This function is for unhover.
 });

});

$("#btn-delete-addon").click(function(){
  var opt = $('option[value="'+$(".searchAddon").val()+'"]');
  var delete_addon_id = opt.attr('data-id');

  $.ajax({
      type: 'POST',
      url: '../controller/AJAXaddonSQL.php',
      data: {
        delete_addon_id:delete_addon_id,
      },
      success: function (data) {
        alert(data);
        $(".searchAddon").val("")
        $("#datalist-addon-cat-id").val("")
        $("#addon_name").val("");
        $("#addon_description").val("");
        $("#addon_price").val("");
        location.reload();
      }
  }, function(){
    //This function is for unhover.
 });

});
//---------------------------------------------------------------
// membership SQL AJAX

$(".btn-add-membership").click(function(){
  var name = $("#membership_name").val();
  var address = $("#membership_address").val();
  var contact = $("#membership_contact").val();

  if(name === "" && address === "" || contact === ""){
    alert("Please fill in all the field");
  }else{
    $.ajax({
        type: 'POST',
        url: '../controller/AJAXmembershipSQL.php',
        data: {
          name:name,
          address:address,
          contact:contact
        },
        success: function (data) {
          alert(data);
          $(".searchMembership").val("")
          $("#membership_name").val("");
          $("#membership_address").val("");
          $("#membership_contact").val("");
          location.reload();
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

$(".btn-update-membership").click(function(){
  var opt = $('option[value="'+$(".searchMembership").val()+'"]');
  var update_membership_id = opt.attr('data-id');
  var name = $("#membership_name").val();
  var address = $("#membership_address").val();
  var contact = $("#membership_contact").val();

  $.ajax({
      type: 'POST',
      url: '../controller/AJAXmembershipSQL.php',
      data: {
        update_membership_id:update_membership_id,
        name:name,
        address:address,
        contact:contact
      },
      success: function (data) {
        alert(data);
        $(".searchMembership").val("")
        $("#membership_name").val("");
        $("#membership_address").val("");
        $("#membership_contact").val("");
        location.reload();
      }
  }, function(){
    //This function is for unhover.
 });

});

$(".btn-delete-membership").click(function(){
  var opt = $('option[value="'+$(".searchMembership").val()+'"]');
  var delete_membership_id = opt.attr('data-id');

  $.ajax({
      type: 'POST',
      url: '../controller/AJAXmembershipSQL.php',
      data: {
        delete_membership_id:delete_membership_id,
      },
      success: function (data) {
        alert(data);
        $(".searchMembership").val("")
        $("#membership_name").val("");
        $("#membership_address").val("");
        $("#membership_contact").val("");
        location.reload();
      }
  }, function(){
    //This function is for unhover.
 });

});
//---------------------------------------------------------------
// condition SQL AJAX

$(".btn-add-condition").click(function(){
  var name = $("#condition_name").val();
  var description = $("#condition_description").val();
  var price = $("#condition_price").val();

  if(name === "" && description === "" || price === ""){
    $('.form-notice-condition').html("Please fill in all the field");
  }else{
    $('.form-notice-condition').html("");
    $.ajax({
        type: 'POST',
        url: '../controller/AJAXconditionSQL.php',
        data: {
          name:name,
          description:description,
          price:price
        },
        success: function (data) {
          alert(data);
          $(".searchCondition").val("")
          $("#condition_name").val("");
          $("#condition_description").val("");
          $("#condition_price").val("");
          location.reload();
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

$(".btn-update-condition").click(function(){
  var opt = $('option[value="'+$(".searchCondition").val()+'"]');
  var update_condition_id = opt.attr('data-id');
  var name = $("#condition_name").val();
  var description = $("#condition_description").val();
  var price = $("#condition_price").val();

  $.ajax({
      type: 'POST',
      url: '../controller/AJAXconditionSQL.php',
      data: {
        update_condition_id:update_condition_id,
        name:name,
        description:description,
        price:price
      },
      success: function (data) {
        alert(data);
        $(".searchCondition").val("")
        $("#condition_name").val("");
        $("#condition_description").val("");
        $("#condition_price").val("");
        location.reload();
      }
  }, function(){
    //This function is for unhover.
 });

});

$(".btn-delete-condition").click(function(){
  var opt = $('option[value="'+$(".searchCondition").val()+'"]');
  var delete_condition_id = opt.attr('data-id');

  $.ajax({
      type: 'POST',
      url: '../controller/AJAXconditionSQL.php',
      data: {
        delete_condition_id:delete_condition_id,
      },
      success: function (data) {
        alert(data);
        $(".searchCondition").val("")
        $("#condition_name").val("");
        $("#condition_description").val("");
        $("#condition_price").val("");
        location.reload();
      }
  }, function(){
    //This function is for unhover.
 });

});

//---------------------------------------------------------------
// edit box
$(".btn-edit").click(function(){
  $(".popup-bg").show();
});

$(".close-popup").click(function(){
  $(".popup-bg").hide();
});

$(".btn-edit-cus").click(function(){
  $(".popup-bg-cus").show();
});

$(".close-popup-cus").click(function(){
  $(".popup-bg-cus").hide();
});

//---------------------------------------------------------------
// pop up form change tab
$('.btn-new-food').on("click", function(){
  $(this).addClass("active");
  $(".btn-new-addon").removeClass("active");
  $('.add_food_div').show();
  $('.add_addon_div').hide();

  $('.searchAddon').val("");
  $('#datalist-addon-cat-id').prop("disabled", false);
  $("#addon_name").val("");
  $("#addon_description").val("");
  $("#addon_price").val("");
});

$('.btn-new-addon').on("click", function(){
  $(this).addClass("active");
  $(".btn-new-food").removeClass("active");
  $('.add_food_div').hide();
  $('.add_addon_div').show();

  $('.searchFood').val("");
  $('#datalist-cat-id').prop("disabled", false);
  $('#datalist-subcat-id').prop("disabled", false);
  $("#food_name").val("");
  $("#food_description").val("");
  $("#food_price").val("");
});

$('.btn-new-membership').on("click", function(){
  $(this).addClass("active");
  $(".btn-new-condition").removeClass("active");
  $('.add_membership_div').show();
  $('.add_condition_div').hide();

  $('.searchCondition').val("");
  $("#condition_name").val("");
  $("#condition_description").val("");
  $("#condition_price").val("");
});

$('.btn-new-condition').on("click", function(){
  $(this).addClass("active");
  $(".btn-new-membership").removeClass("active");
  $('.add_membership_div').hide();
  $('.add_condition_div').show();

  $('.searchMembership').val("");
  $("#membership_name").val("");
  $("#membership_description").val("");
  $("#membership_contact").val("");
});

//---------------------------------------------------------------
// add food form pop up

$(function() {
  $('#datalist-cat-id').on('change',function() {
    var opt = $('option[value="'+$(this).val()+'"]');
    var cat_id = opt.attr('data-id');
    $("#datalist-subcat-id").val("");

    $.ajax({
        type: 'POST',
        url: '../controller/AJAXfillSubcategory.php',
        data: {
          cat_id:cat_id
        },
        success: function (id) {
            $('.ajax-subcat').html(id);
        }
    }, function(){
      //This function is for unhover.
   });
  });
});
//---------------------------------------------------------------
// Customer form Javascript

$(window).bind('beforeunload', function(){
  localStorage.setItem("membership_id", $("#membership_id").val());
  localStorage.setItem("name", $("#input_name").val());
  localStorage.setItem("contact", $("#input_contact").val());
  localStorage.setItem("address", $("#input_address").val());
  localStorage.setItem("discount", $("#discount").val());
  localStorage.setItem("delivery_cost", $("#delivery_cost").val());
  localStorage.setItem("bill_no", $("#bill_no").val());
});


$(window).on('load', function(){
  var url_string = window.location.href;

  if(window.location.href.indexOf("insert=success") > -1){
    clearCart();
    displayCart();
    $("#membership_id").val("");
    $("#input_name").val("");
    $("#input_contact").val("");
    $("#input_address").val("");
    $("#discount").val("");
    $("#delivery_cost").val("");
    $("#bill_no").val("");
  }else {
    var membership_id = localStorage.getItem("membership_id");
    if (membership_id !== null) {
      $("#membership_id").val(membership_id);
    }
    var name = localStorage.getItem("name");
    if (name !== null) {
      $("#input_name").val(name);
    }
    var contact = localStorage.getItem("contact");
    if (contact !== null){
      $("#input_contact").val(contact);
    }
    var address = localStorage.getItem("address");
    if (address !== null){
      $("#input_address").val(address);
    }
    var discount = localStorage.getItem("discount");
    if (discount !== null) {
      $("#discount").val(discount);
    }
    var delivery_cost = localStorage.getItem("delivery_cost");
    if (delivery_cost !== null) {
      $("#delivery_cost").val(delivery_cost);
    }
    var bill_no = localStorage.getItem("bill_no");
    if (bill_no !== null) {
      $("#bill_no").val(bill_no);
    }
  }
});
//---------------------------------------------------------------
// Search food by ID and add to cart

$("#btn-add-food-id").click(function(){

    var first = $("#datalist-food-id-id").val();
    responseArray = first.split("-");
    var input = responseArray[0].trim();
    console.log(input);
    $.ajax({
        type: 'POST',
        url: '../controller/AJAXmenuSearchFoodIdInsert.php',
        data: {input:input},
        success: function (id) {
          responseArray = id.split(",");
          console.log(responseArray[0]);
          console.log(responseArray[1]);
          addItemToCart(responseArray[0], responseArray[1], responseArray[2], 1, null, responseArray[3]);
          displayCart();
          saveCart();
        }
    }, function(){
      //This function is for unhover.
   });
});

$("#datalist-food-id-id").on('keypress', function(e){
  var key = e.which || e.keyCode;
    if (key === 13) { // 13 is enter
      var first = $("#datalist-food-id-id").val();
      responseArray = first.split("-");
      var input = responseArray[0].trim();
      console.log(input);
      $.ajax({
          type: 'POST',
          url: '../controller/AJAXmenuSearchFoodIdInsert.php',
          data: {input:input},
          success: function (id) {
            responseArray = id.split(",");
            console.log(responseArray[0]);
            console.log(responseArray[1]);
            addItemToCart(responseArray[0], responseArray[1], responseArray[2], 1, null, responseArray[3]);
            displayCart();
          }
      }, function(){
        //This function is for unhover.
     });
    }
});

//---------------------------------------------------------------
// Search addon by ID and add to cart

$("#btn-add-addon-id").click(function(){

    var first = $("#datalist-addon-id-id").val();
    array = first.split("-");
    var lastItemIndex = cart.length - 1;
    input = array[0];

    $.ajax({
        type: 'POST',
        url: '../controller/AJAXmenuSearchAddonIdInsert.php',
        data: {input:input},
        success: function (id) {
          if (cart.length == 0 ) {
            addon = [];
            saveAddonCart();
            saveCart();
            // doesnt allow add on from other food category
          }else if (cart[lastItemIndex].catID != array[1]){
            addon = [];
            saveAddonCart();
            saveCart();
          }else {
            responseArray = id.split(",");
            addAddonToCart(responseArray[0], responseArray[1], responseArray[2], 1);
            displayCart();
            saveCart();
          }
        }
    }, function(){
      //This function is for unhover.
   });

});

$("#datalist-addon-id-id").on('keypress', function(e){
  var key = e.which || e.keyCode;
    if (key === 13) { // 13 is enter
      var first = $("#datalist-addon-id-id").val();
      array = first.split("-");
      var lastItemIndex = cart.length - 1;
      input = array[1];

      $.ajax({
          type: 'POST',
          url: '../controller/AJAXmenuSearchAddonIdInsert.php',
          data: {input:input},
          success: function (id) {
            if (cart.length == 0 ) {
              addon = [];
              saveAddonCart();
              saveCart();
              // doesnt allow add on from other food category
            }else if (cart[lastItemIndex].catID != array[2]){
              addon = [];
              saveAddonCart();
              saveCart();
            }else {
              responseArray = id.split(",");
              addAddonToCart(responseArray[0], responseArray[1], responseArray[2], 1);
              displayCart();
              saveCart();
            }
          }
      }, function(){
        //This function is for unhover.
      });
    }
});
//---------------------------------------------------------------
// Customer form auto fillin Javascript
$("#input_contact").keyup(function(){
  var input = $(this).val();

  if(input == ""){
    $("#input_name").val("");
    $("#input_address").val("");
  }else{
    $.ajax({
        type: 'POST',
        url: '../controller/AJAXmenuSearchContact.php',
        data: {
          input:input
        },
        success: function (id) {
          $(".ajax-contact").html(id);
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

$("#input_contact").change(function(){
  var input = $(this).val();

  if(input == ""){
    $("#input_name").val("");
    $("#input_address").val("");
  }else {
    $.ajax({
        type: 'POST',
        url: '../controller/AJAXmenuFillCustomer.php',
        data: {
          input:input
        },
        success: function (id) {
          responseArray = id.split(",");
          $("#input_name").val(responseArray[0]);
          $("#input_address").val(responseArray[1]);
          $("#membership_id").val(responseArray[2]);
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

//---------------------------------------------------------------
// Customer form price add on Javascript

function updateTotal(data){
  $("#total-cart").val(data);
}

function recalculateCheckbox(inside){
      var latest = Number($("#total-cart").val());
      var sum = Number(latest);
      var value = Number($(inside).attr("condition-price"));

      if($(inside).prop('checked') == true){
        sum += value;
      }else if($(inside).prop('unchecked', false)){
        sum -= value;
      }
      updateTotal(sum.toFixed(2));
}

// Minusing the oldValue before the oldValue is replace by newValue
function recalculateInput(inside){
  $(".total-add input[type=number]").change(function(event) {
      latest = Number($("#total-cart").val());
      // take the old value from html tag
      oldValue = Number($(inside).attr('old-value'));
      // minus the oldvalue from total first
      sum = latest - oldValue;
      // add the new value to total
      newVal = Number($(inside).val());
      sum += newVal;
      // store the new value into the html tag as old value
      $(inside).attr('old-value',$(inside).val()) // update old value to new value
      updateTotal(sum.toFixed(2));
  });
}

// Minusing the oldValue before the oldValue is replace by newValue
function recalculateInputMinus(inside){
  $(".total-minus input[type=number]").change(function(event) {

      latest = Number($("#total-cart").val());
      // take the old value from html tag
      oldValue = Number($(inside).attr('old-value'));
      // minus the oldvalue from total first
      sum = latest + oldValue;
      // add the new value to total
      newVal = Number($(inside).val());
      sum -= newVal;
      // store the new value into the html tag as old value
      $(inside).attr('old-value',$(inside).val()) // update old value to new value
      updateTotal(sum.toFixed(2));
  });
}

// recalculate whenever any checkbox is checked
$(".checkbox-condition input[type=checkbox]").change(function(){
  recalculateCheckbox($(this));
});

// recalculateInput whenever there is activity on input
$('#discount').keypress(function(){
  recalculateInputMinus($(this));
});

$('#delivery_cost').keypress(function(){
  recalculateInput($(this));
});

$('#others_cost').keypress(function(){
  recalculateInput($(this));
});

// toggle enablility of others cost input
$("#checkbox_others_cost").change(function(){
    if ($("#others_cost").attr("disabled")) {
      $("#others_cost").removeAttr("disabled");
    } else {
      $("#others_cost").prop("disabled", (_, val) => !val);
    }
    updateTotal($("#total-cart").val());
});

//---------------------------------------------------------------
$(".add-to-cart").click(function(event){
  event.preventDefault(); //Prevent the link doing the original behaviour
  var id = $(this).attr("data-id");
  var name = $(this).attr("data-name");
  var price = Number($(this).attr("data-price"));
  var url_string = window.location.href;
  var url = new URL(url_string);
  var catID = url.searchParams.get("category_id");

  addItemToCart(id, name, price, 1, null, catID);
  displayCart();
});

$("#clear_cart").click(function(event){
  clearCart();
  clearAddonCart();
  displayCart();
});

function displayCart() {
  var cartArray = listCart();
  var output = "";

  output += "<dl>";
  for(var i in cartArray) {
    output +=
     "<dt total_each_food="+ cartArray[i].count * cartArray[i].price +">"
    + cartArray[i].count
    + "     "
    + cartArray[i].name
    + "<button class='delete-item' data-id='"+cartArray[i].id+"'>X</button>"
    + "<label id='display_total_food'>"

    if(cartArray[i].array != null){
      for(var p in cartArray[i].array){
        output += "<dd total_each_addon="+ (cartArray[i].array)[p].count * (cartArray[i].array)[p].price +">"
        + (cartArray[i].array)[p].count
        + " " + (cartArray[i].array)[p].name
        + "<button class='delete-addon' cat-id='"+cartArray[i].id+"' addon-id='"+ (cartArray[i].array)[p].id +"'>X</button>"
        + "<label id='display_total_addon'>"
        + "</dd>";
      }
    }

    + "</dt>";
  }
  output += "</dl>";
  $(".show-cart").html(output);
  $("#hidden_order").val(output);
  $("#total-cart").val(totalCart());
}

// on() will listen to click when the identifier is not visible
$(".show-cart").on("click",".delete-item",function(event){
  var id = $(this).attr("data-id");
  removeItemFromCartAll(id);
  displayCart();
});

// Add to Cart Javascript starts here
var cart = []; // id, name, price, count

var Item = function(id, name, price, count, array, catID){
  this.id = id;
  this.name = name;
  this.price = price;
  this.count = count;
  this.array = array;
  this.catID = catID;
};

function addItemToCart(id, name, price, count, array, catID){
  for (var i in cart){
    if (cart[i].id === id){
      cart[i].count ++;
      saveCart();
      return;
    }
  }
  var item = new Item(id, name, price, count, array, catID);
  cart.push(item);
  addon = [];
  saveCart();
}

// Remove one item
function removeItemFromCart(id) {
  for (var i in cart){
    if (cart[i].id === id){
      cart[i].count --;
      if (cart[i].count ===0){
        cart.splice(i, 1); // if 2, will remove first 2 item from cart
      }
      break;
    }
  }
  saveCart();
}

 // removes all item name
function removeItemFromCartAll(id){
  for (var i in cart) {
    if(cart[i].id === id){
      cart.splice(i, 1);
      break;
    }
  }
  addon = [];
  saveCart();
}

function clearCart(){
  cart = [];
  saveCart();
}

// return total count
function countCart() {
  var totalCount = 0;
  for (var i in cart) {
    totalCount += cart[i].count;
  }
  return totalCount;
}

 // return total cost
function totalCart() {
  var totalCost = 0;
  var totalAddonCost = 0;
  for (var i in cart) {
    totalCost += cart[i].price * cart[i].count;
    for (var p in cart[i].array)
    totalAddonCost += (cart[i].array)[p].price * (cart[i].array)[p].count;
  }
  totalCost += totalAddonCost;
  return totalCost.toFixed(2);
}

// return array of Item
function listCart() {
  var cartCopy = [];
  for (var i in cart){
    var item = cart[i];
    var itemCopy = {};
    for (var p in item){
      itemCopy[p] = item[p];
    }
    cartCopy.push(itemCopy);
  }
  return cartCopy;
}

function saveCart(){
  // Javascript Object Notation, write object/array into string
  localStorage.setItem("orderCart", JSON.stringify(cart));
}

function loadCart() {
  cart = JSON.parse(localStorage.getItem("orderCart"));
}



//---------------------------------------------------------------
$(".addon-to-cart").unbind().click(function(event){
  event.preventDefault(); //Prevent the link doing the original behaviour
  var id = $(this).attr("addon-id");
  var name = $(this).attr("addon-name");
  var price = Number($(this).attr("addon-price"));
  var cat_id = $(this).attr("category-id");
  var lastItemIndex = cart.length - 1;

  if (cart.length == 0 ) {
    addon = [];
    saveAddonCart();
    saveCart();
    // doesnt allow add on from other food category
  }else if (cart[lastItemIndex].catID != cat_id){
    addon = [];
    saveAddonCart();
    saveCart();
  }else {
    addAddonToCart(id, name, price, 1);
    displayCart();
    saveCart();
  }
});

$("#clear_addon_cart").click(function(event){
  clearAddonCartAll();
  displayCart();
});

// on() will listen to click when the identifier is not visible
$(".show-cart").on("click",".delete-addon",function(event){
  var catID = $(this).attr("cat-id");
  var addonID = $(this).attr("addon-id");
  for (var i in cart){
    if(cart[i].id == catID){
      for (var p in cart[i].array){
        if((cart[i].array)[p].id == addonID){
          (cart[i].array).splice(p,1);
        }
      }
    }
  }
  displayCart();
  saveCart();
});

// Add addon to Cart Javascript starts here
var addon = []; // id, name, price, count

var Addon = function(id, name, price, count){
  this.id = id;
  this.name = name;
  this.price = price;
  this.count = count;
};

function addAddonToCart(id, name, price, count){
  var lastItemIndex = cart.length;
  for (var i in addon){
    if (addon[i].id === id){
      addon[i].count ++;
      saveAddonCart();
      cart[lastItemIndex-1].array = addon;
      return;
    }
  }
  var item = new Addon(id, name, price, count);
  addon.push(item);
  cart[lastItemIndex-1].array = addon;
  displayCart();
  saveAddonCart();
}

// Remove one item
function removeAddonFromCart(id) {
  for (var i in addon){
    if (addon[i].id === id){
      addon[i].count --;
      if (cart[i].count ===0){
        addon.splice(i, 1); // if 2, will remove first 2 item from cart
      }
      break;
    }
  }
  displayCart();
  saveAddonCart();
}

function clearAddonCart(){
  addon = [];
  saveCart();
  saveAddonCart();
}

function clearAddonCartAll(){
  for(var i in cart){
    cart[i].array = null;
  }
  saveAddonCart();
}

// return total count
function countAddonCart() {
  var totalCount = 0;
  for (var i in addon) {
    totalCount += cart[i].count;
  }
  return totalCount;
}

// return array of Item
function listAddonCart() {
  var addonCopy = [];
  for (var i in addon){
    var item = addon[i];
    var itemCopy = {};
    for (var p in item){
      itemCopy[p] = item[p];
    }
    addonCopy.push(itemCopy);
  }
  return addonCopy;
}

function saveAddonCart(){
  // Javascript Object Notation, write object/array into string
  localStorage.setItem("addonCart", JSON.stringify(addon));
}

function loadAddonCart() {
  addon = JSON.parse(localStorage.getItem("addonCart"));
}

loadCart();
loadAddonCart();
displayCart();
