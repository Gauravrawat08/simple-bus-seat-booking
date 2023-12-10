$(function(){
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;  
    $('#inputdate').attr('min', maxDate);
});


//popup box for add route
 
function show(){
  document.getElementById("popup").style.display = "block";
}
function hide() {
  document.getElementById("popup").style.display = "none";
  
 
}
 

 