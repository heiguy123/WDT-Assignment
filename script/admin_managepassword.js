// this is to get the parameter using javascript
const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const welcome = urlParams.get("welcome");

$(document).ready(function () {
  //only alert when the user is logged in through login page
  if (welcome === "welcome") {
    showAlert();
  }
  //to show the number
  var x = document.getElementById("notification-number");
  if (x.innerText != "") {
    x.style.display = "inline";
  }
});

function showAlert() {
  $("#alert-box")
    .fadeTo(2000, 500)
    .slideUp(500, function () {
      $("#alert-box").slideUp(500);
    });
}

function showpass() {
  var x = document.getElementById("pass");
  var y = document.getElementById("re_pass");
  var z = document.getElementById("cur_pass");
  if (x.type === "password") {
    x.type = "text";
    y.type = "text";
    z.type = "text";
  } else {
    x.type = "password";
    y.type = "password";
    z.type = "password";
  }
}
function validatePass() {
  var y = document.getElementById("re_pass").value;
  var z = document.getElementById("cur_pass").value;

  if (y != z) {
    alert("Please reenter the correct password!");
    return false;
  }
  return confirm("Process to update password?");
}
