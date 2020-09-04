// this is to get the parameter using javascript
const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const welcome = urlParams.get("welcome");

$(document).ready(function () {
  var input = document.getElementById("searchitem");

  input.addEventListener("keyup", function (event) {
    showsearch();
  });

  //only alert when the user is logged in through login page
  if (welcome === "welcome") {
    showAlert();
  }
  //to show the number
  var x = document.getElementById("notification-number");
  if (x.innerText != "") {
    x.style.display = "inline";
  }

  //to reset on close
  $(".modal").on("hidden.bs.modal", function () {
    var id = $(this).attr("id");
    id = id.replace("exampleModal", "");
    id = "form" + id;
    document.getElementById(id).reset();
  });

  //if the radio button is changed, use ajax
  $("#sortbox").change(function () {
    var xmlhttp = new XMLHttpRequest();
    var searchitem = document.getElementById("searchitem").value;
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("viewbody").innerHTML = this.responseText;
      }
    };
    if (document.getElementById("sdate").checked) {
      if (document.getElementById("sasc").checked) {
        xmlhttp.open(
          "GET",
          "admin_sort.php?sort=0&order=0&search=" + searchitem,
          true
        );
        xmlhttp.send();
      } else if (document.getElementById("sdesc").checked) {
        xmlhttp.open(
          "GET",
          "admin_sort.php?sort=0&order=1&search=" + searchitem,
          true
        );
        xmlhttp.send();
      }
    } else if (document.getElementById("stotal").checked) {
      if (document.getElementById("sasc").checked) {
        xmlhttp.open(
          "GET",
          "admin_sort.php?sort=1&order=0&search=" + searchitem,
          true
        );
        xmlhttp.send();
      } else if (document.getElementById("sdesc").checked) {
        xmlhttp.open(
          "GET",
          "admin_sort.php?sort=1&order=1&search=" + searchitem,
          true
        );
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

function showsearch() {
  var xmlhttp = new XMLHttpRequest();
  var searchitem = document.getElementById("searchitem").value;

  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("viewbody").innerHTML = this.responseText;
    }
  };
  if (document.getElementById("sdate").checked) {
    if (document.getElementById("sasc").checked) {
      xmlhttp.open(
        "GET",
        "admin_search.php?sort=0&order=0&search=" + searchitem,
        true
      );
      xmlhttp.send();
    } else if (document.getElementById("sdesc").checked) {
      xmlhttp.open(
        "GET",
        "admin_search.php?sort=0&order=1&search=" + searchitem,
        true
      );
      xmlhttp.send();
    }
  } else if (document.getElementById("stotal").checked) {
    if (document.getElementById("sasc").checked) {
      xmlhttp.open(
        "GET",
        "admin_search.php?sort=1&order=0&search=" + searchitem,
        true
      );
      xmlhttp.send();
    } else if (document.getElementById("sdesc").checked) {
      xmlhttp.open(
        "GET",
        "admin_search.php?sort=1&order=1&search=" + searchitem,
        true
      );
      xmlhttp.send();
    }
  }
}

function validateupdate(ele) {
  var id = ele.id;
  id = id.replace("submit", "");
  id = "order_status" + id;
  var x = document.getElementById(id).value;
  var msg =
    "Are you sure you want to update the status?\n(this cannot be undone)";
  if (x == "Delivered") {
    msg =
      "The order will be closed, are you sure to continue?\n(this cannot be undone)";
  }
  return confirm(msg);
}
