function openMe(inside){
  var i, content;
  content = document.getElementsByClassName("sub-tabs");
  for(i = 0; i < content.length; i++){
    content[i].style.display =  "none";
  }
  document.getElementById(inside).style.display = "block";
}

function openMe2(inside){
  var i, content;
  content = document.getElementsByClassName("content");
  for(i = 0; i < content.length; i++){
    content[i].style.display =  "none";
  }
  document.getElementById(inside).style.display = "block";
}
