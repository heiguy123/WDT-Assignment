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
    if (id == "-1") {
      return;
    } else {
      resetc(id);
    }
  });

  //search function
  var input = document.getElementById("searchitem");
  input.addEventListener("keyup", function (event) {
    showsearch();
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
  if (id == "#img-1") {
    //if the reset is for new food modal
    $(id).attr("src", "img/default.jpg");
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        $(id).attr("src", this.responseText);
      }
    };
    xmlhttp.open("GET", "admin_reset.php?food=" + food_id, true);
    xmlhttp.send();
  }
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
  var filecheckresult = validatefile(id); //to validate file

  //validate file
  if (filecheckresult == -1) {
    return failValidation("Please insert a valid image!");
  }

  //validate food name
  if (!validfoodname(id)) {
    return failValidation(
      "Please insert a valid FOOD NAME \n (only alphabets and digits are allowed!)"
    );
  }
  //validate category
  if (!validcate(id)) {
    return failValidation(
      "Please insert a valid CATEGORY NAME \n (only alphabets and digits are allowed!)"
    );
  }

  //validate price
  if (!validprice(id)) {
    return failValidation(
      "Please insert a valid PRICE \n (only positive number under 150.00 is allowed!)"
    );
  }

  //validate price
  if (!validdescription(id)) {
    return failValidation(
      "Please insert a valid DESCRIPTION: \nLength must not exceed 500 characters \nThese special characters are not allowed \n / \\ : * ? < > | "
    );
  }

  //to check if the category exist
  var currentcate = document.getElementById("cateinput" + id).value;
  if (categoryexist(id, currentcate) == false) {
    //if it is a new cateogory
    if (
      !confirm(
        currentcate +
          " is a new category, do you wish to create a new category?"
      )
    ) {
      //if the user dont want to create new category, then return false, else proceed
      return false;
    }
  }

  if (filecheckresult == 1) {
    return confirm("Are you sure u want to proceed without a picture?");
  } else if (id == -1) {
    return confirm("Are you sure you want to add new food?");
  } else {
    return confirm("Are you sure you want to update the food details?");
  }
}

function validatefile(id) {
  imgid = "uploadimg" + id;
  if (imgid != "uploadimg-1") {
    //if for update
    if (document.getElementById(imgid).files.length == 0) {
      //if there is no image, direct proceed
      return 3;
    } else {
      //if there is image, check image
      imgid = "#" + imgid;
      var file = $(imgid);
      if (!isImage(file.val())) {
        return -1;
      }
      return 4;
    }
  } else {
    //if the form is for new food
    if (document.getElementById(imgid).files.length == 0) {
      //no file
      return 1;
    } else {
      imgid = "#" + imgid;
      var file = $(imgid);
      if (!isImage(file.val())) {
        return -1;
      }
      return 2;
    }
  }
}

function failValidation(msg) {
  alert(msg); // just an alert for now but you can spice this up later
  return false;
}

function showsearch() {
  var xmlhttp = new XMLHttpRequest();
  var searchitem = document.getElementById("searchitem").value;
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("viewbody").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "admin_search.php?msearch=" + searchitem, true);
  xmlhttp.send();
}

function alphanumeric(inputtxt) {
  var letterNumber = /^[0-9a-zA-Z]+$/;
  if (inputtxt.value.match(letterNumber)) {
    return true;
  } else {
    return false;
  }
}

function categoryexist(id, currentcate) {
  var x = document.getElementById("cate" + id);
  var i;
  var ifexist = false;
  for (i = 0; i < x.options.length; i++) {
    if (currentcate == x.options[i].text) {
      //turn the flag true when the cate matches
      ifexist = true;
    }
  }
  return ifexist;
}

function validfoodname(id) {
  var x = document.getElementById("foodname" + id);
  if (jQuery.isEmptyObject(x.value)) {
    return false;
  }
  return isAlNum(x.value);
}

function isAlNum(inputtext) {
  var letterNumber = /^[0-9a-zA-Z ]+$/;
  if (inputtext.match(letterNumber)) {
    return true;
  } else {
    return false;
  }
}

function validcate(id) {
  var x = document.getElementById("cateinput" + id);
  if (jQuery.isEmptyObject(x.value)) {
    return false;
  }
  return isAlNum(x.value);
}

function validprice(id) {
  var x = document.getElementById("price" + id);
  if (jQuery.isEmptyObject(x.value)) {
    return false;
  }
  if (x.value.includes("e")) {
    return false;
  }
  if (Math.sign(x.value) != 1) {
    return false;
  } else if (x.value > 150) {
    return false;
  }
  return true;
}

function validdescription(id) {
  var x = document.getElementById("description" + id);
  if (jQuery.isEmptyObject(x.value)) {
    return false;
  }
  var regex1 = /^[^/\\:*?<>|]+$/;
  if (x.value.match(regex1)) {
    return true;
  } else {
    return false;
  }
}
