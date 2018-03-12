// JQuery function start here

$(".add-to-cart").click(function(event){
  event.preventDefault(); //Prevent the link doing the original behaviour
  var id = $(this).attr("data-id");
  var name = $(this).attr("data-name");
  var price = Number($(this).attr("data-price"));

  addItemToCart(id, name, price, 1);
  displayCart();
});

$("#clear_cart").click(function(event){
  clearCart();
  displayCart();
});

function displayCart() {
  var cartArray = listCart();
  var output = "";
  for(var i in cartArray) {
    output += "<li>"
    +cartArray[i].count
    +" "+cartArray[i].name
    +" "
    +"<button class='delete-item' data-id='"+cartArray[i].id+"'>X</button>"
    +"</li>"
  }
  $(".show-cart").html(output);
  $("#total-cart").html(totalCart());
}

// on() will listen to click when the identifier is not visible
$(".show-cart").on("click",".delete-item",function(event){
  var id = $(this).attr("data-id");
  removeItemFromCartAll(id);
  displayCart();
});

//---------------------------------------------------------------
// pop up form jquery

$(".click-cat").click(function(){
   var id = $(this).attr("category_id");
   $('.content').html("");
        $.ajax({
            type: 'POST',
            url: '../controller/AJAXcategory.php',
            data: {id:id},
            success: function (id) {
                $('.sub-tabs').html(id);
            }
        }, function(){
          //This function is for unhover.
       });
});

$(".click-subcat").click(function(){
   var id = $(this).attr("subcategory_id");
        $.ajax({
            type: 'POST',
            url: '../controller/AJAXsubcategory.php',
            data: {id:id},
            success: function (id) {
                $('.content').html(id);
            }
        }, function(){
          //This function is for unhover.
       });
});

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
//---------------------------------------------------------------
// edit box
$(".btn-edit").click(function(){
  $(".popup-bg").show();
});

$(".close-popup").click(function(){
  $(".popup-bg").hide();
});

//---------------------------------------------------------------
// add food form

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
  $("#total-cart").html(data);
}

function recalculateCheckbox(inside){
      var latest = Number($("#total-cart").text());
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
      console.log("helow");
      latest = Number($("#total-cart").text());
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

      latest = Number($("#total-cart").text());
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
       recalculateInput($("#others_cost"));
    } else {
      $('#others_cost').val("0");
      recalculateInput("#others_cost");
      $("#others_cost").prop("disabled", (_, val) => !val);

    }
    updateTotal($("#total-cart").text());
});

//---------------------------------------------------------------
// Add to Cart Javascript starts here
var cart = []; // id, name, price, count

var Item = function(id, name, price, count){
  this.id = id;
  this.name = name;
  this.price = price;
  this.count = count;
};

function addItemToCart(id, name, price, count){
  for (var i in cart){
    if (cart[i].id === id){
      cart[i].count ++;
      saveCart();
      return;
    }
  }
  var item = new Item(id, name, price, count);
  cart.push(item);
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
  for (var i in cart) {
    totalCost += cart[i].price * cart[i].count;
  }
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

loadCart();
displayCart();
