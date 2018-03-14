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
// add food form pop up

$(function() {
  $('#datalist-cat-id').on('input',function() {
    var opt = $('option[value="'+$(this).val()+'"]');
    var id = opt.attr('data-id');
    $.ajax({
        async: true,
        type: 'POST',
        url: '../controller/AJAXformSubcategory.php',
        data: {id:id},
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
  for(var i in cartArray) {
    output +=
    "<dl>"
    + "<dt>"
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

    + "</dt>"
    +"</dl>";
  }
  $(".show-cart").html(output);
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
