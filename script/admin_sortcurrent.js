// this is to get the parameter using javascript
const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const welcome = urlParams.get("welcome");

$(document).ready(function () {
  //only alert when the user is logged in through login page
  if (welcome === "welcome") {
    showAlert();
  }

  var x = document.getElementById("notification-number");
  if (x.innerText != "") {
    x.style.display = "inline";
  }

  //if the radio button is changed, use ajax
  $("#sortbox").change(function () {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("viewbody").innerHTML = this.responseText;
      }
    };
    if (document.getElementById("sdate").checked) {
      if (document.getElementById("sasc").checked) {
        xmlhttp.open("GET", "admin_sort.php?sort=0&order=0", true);
        xmlhttp.send();
      } else if (document.getElementById("sdesc").checked) {
        xmlhttp.open("GET", "admin_sort.php?sort=0&order=1", true);
        xmlhttp.send();
      }
    } else if (document.getElementById("stotal").checked) {
      if (document.getElementById("sasc").checked) {
        xmlhttp.open("GET", "admin_sort.php?sort=1&order=0", true);
        xmlhttp.send();
      } else if (document.getElementById("sdesc").checked) {
        xmlhttp.open("GET", "admin_sort.php?sort=1&order=1", true);
        xmlhttp.send();
      }
    }
  });
});

function showAlert() {
  $("#alert-box")
    .fadeTo(2000, 500)
    .slideUp(500, function () {
      $("#alert-box").slideUp(500);
    });
}
