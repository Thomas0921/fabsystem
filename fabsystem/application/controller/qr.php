<!DOCTYPE html>
<html>
<head>
 <title>Qr code</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<input id="input_id" type="text" name="" cols="10" rows="10">
<textarea id="textarea_id" oninput="generate_qrcode(this.value)" cols="50" rows="5"></textarea>
<div id="result"></div>
</body>
<script>

$("#input_id").keyup(function(){
  var input = $(this).val().replace(/\,/g,' ');
  var url = input.replace(/\ /g, '%20');
  var output = 'http://maps.google.com/maps?q='+ url +'"target="_blank"'
  generate_qrcode(output);


});

function generate_qrcode(sample){
    $.ajax({
    type: 'post',
    url: 'code.php',
    data : {sample:sample},
    success: function(code){
      $('#result').html(code);
      }
    });
  }
</script>
</html>
