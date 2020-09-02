<?php
include_once("_admin.function.php");
if (isset($_GET['history'])) {
    if ($_GET['history'] == 0) {
        searchrequest(0, 0, "history");
    } elseif ($_GET['history'] == 1) {
        displayrequest();
    }
}
