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

function viewhistory(num) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("viewbody").innerHTML = this.responseText;
    }
  };
  if (num == 0) {
    changebtnvisibility(0);
    xmlhttp.open("GET", "admin_requesthistory.php?history=0", true);
    xmlhttp.send();
  } else if (num == 1) {
    changebtnvisibility(1);
    xmlhttp.open("GET", "admin_requesthistory.php?history=1", true);
    xmlhttp.send();
  }
}

function changebtnvisibility(num) {
  var x = document.getElementById("backbtn");
  if (num == 0) {
    x.style.display = "inline";
  } else if (num == 1) {
    x.style.display = "none";
  }
}
