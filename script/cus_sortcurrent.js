// this is to get the parameter using javascript

$(document).ready(function () {
  var input = document.getElementById("searchitem");

  input.addEventListener("keyup", function (event) {
    showsearch();
  });

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
        xmlhttp.open("GET", "cus_sort.php?sort=0&order=0", true);
        xmlhttp.send();
      } else if (document.getElementById("sdesc").checked) {
        xmlhttp.open("GET", "cus_sort.php?sort=0&order=1", true);
        xmlhttp.send();
      }
    } else if (document.getElementById("stotal").checked) {
      if (document.getElementById("sasc").checked) {
        xmlhttp.open("GET", "cus_sort.php?sort=1&order=0", true);
        xmlhttp.send();
      } else if (document.getElementById("sdesc").checked) {
        xmlhttp.open("GET", "cus_sort.php?sort=1&order=1", true);
        xmlhttp.send();
      }
    }
  });
});

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
        "cus_search.php?sort=0&order=0&search=" + searchitem,
        true
      );
      xmlhttp.send();
    } else if (document.getElementById("sdesc").checked) {
      xmlhttp.open(
        "GET",
        "cus_search.php?sort=0&order=1&search=" + searchitem,
        true
      );
      xmlhttp.send();
    }
  } else if (document.getElementById("stotal").checked) {
    if (document.getElementById("sasc").checked) {
      xmlhttp.open(
        "GET",
        "cus_search.php?sort=1&order=0&search=" + searchitem,
        true
      );
      xmlhttp.send();
    } else if (document.getElementById("sdesc").checked) {
      xmlhttp.open(
        "GET",
        "cus_search.php?sort=1&order=1&search=" + searchitem,
        true
      );
      xmlhttp.send();
    }
  }
}
