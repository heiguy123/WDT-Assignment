$(document).ready(function () {
  //to implement order cancel request number
  var x = document.getElementById("notification-number");
  if (x.innerText != "") {
    x.style.display = "inline";
  }

  //reset the form on close
  $(".modal").on("hidden.bs.modal", function () {
    var id = $(this).attr("id");
    id = id.replace("exampleModal", "");
    resetc(id);
  });
});

//to preview the selected image
function readURL(input, imgid) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    var id = "#" + imgid;
    reader.onload = function (e) {
      $(id).attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// reset the img when the reset button is clicked
function resetimg(food_id) {
  var id = "#img" + food_id;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      $(id).attr("src", this.responseText);
    }
  };
  xmlhttp.open("GET", "admin_reset.php?food=" + food_id, true);
  xmlhttp.send();
}

function deleteitem(food_id) {
  if (confirm("Are you sure you want to delete this food?")) {
    var url = "admin_viewmenu.php?del=" + food_id;
    window.location.href = url;
  }
}

function resetc(food_id) {
  resetimg(food_id);
  var id = "resetbutton" + food_id;
  document.getElementById(id).click();
}

//to display all menu all over again
function resetall() {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("viewcontent").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "admin_reset.php", true);
  xmlhttp.send();
}

//to get the file extension
function getExtension(filename) {
  var parts = filename.split(".");
  return parts[parts.length - 1];
}

//to check if the file is img
function isImage(filename) {
  var ext = getExtension(filename);
  switch (ext.toLowerCase()) {
    case "jpg":
    case "gif":
    case "bmp":
    case "png":
      //etc
      return true;
  }
  return false;
}

//to validate the form
function validateform(ele) {
  var id = ele.id;
  id = "uploadimg" + id;

  if (document.getElementById(id).files.length == 0) {
    return confirm("Are you sure you want to update the food details?");
  } else {
    function failValidation(msg) {
      alert(msg); // just an alert for now but you can spice this up later
      return false;
    }

    id = "#" + id;
    var file = $(id);
    if (!isImage(file.val())) {
      return failValidation("Please select a valid image!");
    }

    // success at this point
    // indicate success with alert for now
    return confirm("Are you sure you want to update the food details?"); // prevent form submitting anyway - remove this in your environment
  }
}
