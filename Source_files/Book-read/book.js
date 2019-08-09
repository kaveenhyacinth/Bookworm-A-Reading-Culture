window.onscroll = function() {scroll()};

var size = 18;

function scroll() {
  if (document.documentElement.scrollTop > 10) {
    document.getElementById("btnTop").style.display = "block";
  } else {
    document.getElementById("btnTop").style.display = "none";
  }
}


// When the user clicks on the button, scroll to the top of the document
function navTop() {
  document.documentElement.scrollTop = 0;
} 

function sizeInc(){
    size += 1;
    var inc = size.toString();
    document.getElementById('para').style.fontSize = "" + inc + "pt";

}


function sizeDec(){
    size -= 1;
    var inc = size.toString();
    document.getElementById('para').style.fontSize = "" + inc + "pt";

}


function darkMode(){

    var html = document.getElementsByTagName("html");
    var body = document.getElementsByTagName("body");
    var main = document.getElementsByTagName("main");
    var btnDark = document.getElementById('btnDark').innerHTML;
  
    if(btnDark == "Go Dark"){
      var i;
      for (i = 0; i < html.length; i++) {
        html[i].style.backgroundColor = "#1B1B1B";
      } 
      for (i = 0; i < body.length; i++) {
        body[i].style.backgroundColor = "#1B1B1B";
      } 
      for (i = 0; i < html.length; i++) {
        main[i].style.color = "White";
      } 
  
      document.getElementById('btnDark').innerHTML = "Go Light";
    }
    else if(btnDark == "Go Light"){
      var i;
      for (i = 0; i < html.length; i++) {
        html[i].style.backgroundColor = "white";
      } 
      for (i = 0; i < body.length; i++) {
        body[i].style.backgroundColor = "white";
      } 
      for (i = 0; i < html.length; i++) {
        main[i].style.color = "black";
      } 
  
      document.getElementById('btnDark').innerHTML = "Go Dark";
    }
    
  }