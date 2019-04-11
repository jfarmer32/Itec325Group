/*
Group: require_once(teamname.php);
Last edited: 04/11/2019 (V1.0)
Last edited by: Joe Sullivan
Purpose: This is a file containing javascript functions for our project.
*/
function startTime(){
  var currentdate = new Date();
  var day = currentdate.getDate();
  var month = (currentdate.getMonth()+1);
  var year = currentdate.getFullYear();
  var hours = currentdate.getHours();
  var minutes = currentdate.getMinutes();

  minutes = checkTime(minutes);
  hours = checkTime(hours);

  document.getElementById('time').innerHTML =
  month + "/" + day + "/" + year + " | " + hours + ":" + minutes;

  var timer = setTimeout(startTime, 500);
}

function checkTime(i) {
  if (i < 10)
  i = "0" + i;  // add zero in front of numbers < 10

  return i;
}

function usernameValidate(input) {
	var regex = /[^a-z0-9]/gi;
	input.value = input.value.replace(regex,"");
}

function passwordValidate(input) {
	
}
