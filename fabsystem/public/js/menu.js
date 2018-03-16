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
    $('.notice').html("* No record found");
    $('#datalist-cat-id').prop("disabled", false);
    $('#datalist-subcat-id').prop("disabled", false);
  }else{
    $('.notice').html("");
    console.log(food_id);
    $('#datalist-cat-id').prop("disabled", true);
    $('#datalist-subcat-id').prop("disabled", true);

         $.ajax({
             type: 'POST',
             url: '../controller/AJAXmenuFillFood.php',
             data: {food_id:food_id},
             success: function (data) {
               responseArray = data.split(",");

               $("#food_name").val(responseArray[0]);
               $("#food_description").val(responseArray[1]);
               $("#food_price").val(responseArray[2]);
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
    $('.notice').html("* No record found");
    $('#datalist-cat-id').prop("disabled", false);
  }else{
    $('.notice').html("");
    $('#datalist-addon-cat-id').prop("disabled", true);

         $.ajax({
             type: 'POST',
             url: '../controller/AJAXmenuFillAddon.php',
             data: {add_on_id:add_on_id},
             success: function (data) {
               responseArray = data.split(",");

               $("#addon_name").val(responseArray[0]);
               $("#addon_description").val(responseArray[1]);
               $("#addon_price").val(responseArray[2]);
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
    $('.notice').html("* No record found");
  }else{
    $('.notice').html("");

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
// pop up add category AJAX

$("#btn_add_category").click(function(){

  var cat_name = $("#datalist-cat-id").val();

  if(cat_name === ""){
    $(".form-notice-food").html("category field is empty");
  }else {
    $(".form-notice-food").html("");
    $.ajax({
        type: "POST",
        url: "../controller/AJAXcategorySQL.php",
        data: {
          cat_name:cat_name
        },
        success: function (data) {
          alert("Record added");
          $(".searchAddon").val("");
          $("#datalist-cat-id").val("");
          $("#datalist-subcat-id").val("");
          $("#food_name").val("");
          $("#food_description").val("");
          $("#food_price").val("");
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

$("#btn_edit_category").click(function(){
  var opt = $('option[value="'+ $("#datalist-cat-id").val() +'"]');
  var cat_id = opt.attr("data-id");
  var cat_name = $("#datalist-cat-id").val();
  var edit = "";

  if(cat_id === "" && cat_name === ""){
    $(".form-notice-food").html("category field is empty");
  }else {
    $(".form-notice-food").html("");
    $.ajax({
        type: "POST",
        url: "../controller/AJAXcategorySQL.php",
        data: {
          edit:edit,
          cat_id:cat_id,
          cat_name:cat_name
        },
        success: function (data) {
          alert("Record edited");
          $(".searchAddon").val("");
          $("#datalist-cat-id").val("");
          $("#datalist-subcat-id").val("");
          $("#food_name").val("");
          $("#food_description").val("");
          $("#food_price").val("");
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

$("#btn_delete_category").click(function(){
  var opt = $('option[value="'+ $("#datalist-cat-id").val() +'"]');
  var cat_id = opt.attr("data-id");

  if(cat_id === ""){
    $(".form-notice-food").html("category field is empty");
  }else {
    $(".form-notice-food").html("");
    $.ajax({
        type: "POST",
        url: "../controller/AJAXcategorySQL.php",
        data: {
          cat_id:cat_id,
        },
        success: function (data) {
          alert("Record deleted");
          $(".searchAddon").val("");
          $("#datalist-cat-id").val("");
          $("#datalist-subcat-id").val("");
          $("#food_name").val("");
          $("#food_description").val("");
          $("#food_price").val("");
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
  var opt2 = $('option[value="'+$("#datalist-subcat-id").val()+'"]');
  var subcat_id = opt2.attr('data-id');
  var name = $("#food_name").val();
  var description = $("#food_description").val();
  var price = $("#food_price").val();
  if(cat_id === "" && subcat_id === "" || name === "" || description === "" || price === ""){
    $('.form-notice-food').html("Please fill in all the field");
  }else {
    $('.form-notice-food').html("");
    $.ajax({
        type: 'POST',
        url: '../controller/AJAXfoodSQL.php',
        data: {
          cat_id:cat_id,
          subcat_id:subcat_id,
          name:name,
          description:description,
          price:price
        },
        success: function (data) {
          alert("Record added");
          $(".searchAddon").val("");
          $("#datalist-cat-id").val("");
          $("#datalist-subcat-id").val("");
          $("#food_name").val("");
          $("#food_description").val("");
          $("#food_price").val("");
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

$("#btn-update-food").click(function(){
  var opt = $('option[value="'+$(".searchFood").val()+'"]');
  var update_food_id = opt.attr('data-id');
  var name = $("#food_name").val();
  var description = $("#food_description").val();
  var price = $("#food_price").val();

  $.ajax({
      type: 'POST',
      url: '../controller/AJAXfoodSQL.php',
      data: {
        update_food_id:update_food_id,
        name:name,
        description:description,
        price:price
      },
      success: function (data) {
        alert("Record updated");
        $(".searchFood").val("");
        $("#datalist-cat-id").val("");
        $("#datalist-subcat-id").val("");
        $("#food_name").val("");
        $("#food_description").val("");
        $("#food_price").val("");
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
        $("#food_name").val("");
        $("#food_description").val("");
        $("#food_price").val("");
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
          name:name,
          description:description,
          price:price
        },
        success: function (data) {
          alert("Record added");
          $(".searchAddon").val("")
          $("#datalist-addon-cat-id").val("")
          $("#addon_name").val("");
          $("#addon_description").val("");
          $("#addon_price").val("");
        }
    }, function(){
      //This function is for unhover.
   });
  }
});

$("#btn-update-addon").click(function(){
  var opt = $('option[value="'+$(".searchAddon").val()+'"]');
  var update_addon_id = opt.attr('data-id');
  var name = $("#addon_name").val();
  var description = $("#addon_description").val();
  var price = $("#addon_price").val();

  $.ajax({
      type: 'POST',
      url: '../controller/AJAXaddonSQL.php',
      data: {
        update_addon_id:update_addon_id,
        name:name,
        description:description,
        price:price
      },
      success: function (data) {
        alert("Record updated");
        $(".searchAddon").val("")
        $("#datalist-addon-cat-id").val("")
        $("#addon_name").val("");
        $("#addon_description").val("");
        $("#addon_price").val("");
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
        alert("Record deleted");
        $(".searchAddon").val("")
        $("#datalist-addon-cat-id").val("")
        $("#addon_name").val("");
        $("#addon_description").val("");
        $("#addon_price").val("");
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
          alert("Record added");
          $(".searchCondition").val("")
          $("#condition_name").val("");
          $("#condition_description").val("");
          $("#condition_price").val("");
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
        alert("Record updated");
        $(".searchCondition").val("")
        $("#condition_name").val("");
        $("#condition_description").val("");
        $("#condition_price").val("");
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
        alert("Record deleted");
        $(".searchCondition").val("")
        $("#condition_name").val("");
        $("#condition_description").val("");
        $("#condition_price").val("");
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
  $('.add_food_div').show();
  $('.add_addon_div').hide();

  $('.searchAddon').val("");
  $('#datalist-addon-cat-id').prop("disabled", false);
  $("#addon_name").val("");
  $("#addon_description").val("");
  $("#addon_price").val("");
});

$('.btn-new-addon').on("click", function(){
  $('.add_food_div').hide();
  $('.add_addon_div').show();

  $('.searchFood').val("");
  $('#datalist-cat-id').prop("disabled", false);
  $('#datalist-subcat-id').prop("disabled", false);
  $("#food_name").val("");
  $("#food_description").val("");
  $("#food_price").val("");
});

//---------------------------------------------------------------
// add food form pop up

$(function() {
  $('#datalist-cat-id').on('input',function() {
    var opt = $('option[value="'+$(this).val()+'"]');
    var id = opt.attr('data-id');
    $("#datalist-subcat-id").val("");
    var url_string = window.location.href;
    url_string += "&cat-form-id=" + id;
    console.log(url_string);
    window.history.pushState("", "", url_string);
  });
});
//---------------------------------------------------------------
// Customer form Javascript

$(window).bind('beforeunload', function(){
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
    $("#input_name").val("");
    $("#input_contact").val("");
    $("#input_address").val("");
    $("#discount").val("");
    $("#delivery_cost").val("");
    $("#bill_no").val("");
  }else {
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
     "<dt>"
    + cartArray[i].count
    + " " + cartArray[i].name
    + "<button class='delete-item' data-id='"+cartArray[i].id+"'>X</button>"

    if(cartArray[i].array != null){
      for(var p in cartArray[i].array){
        output += "<dd>"
        + (cartArray[i].array)[p].count
        + " " + (cartArray[i].array)[p].name
        + "<button class='delete-addon' cat-id='"+cartArray[i].id+"' addon-id='"+ (cartArray[i].array)[p].id +"'>X</button>"
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
