<?php
include_once("_admin.function.php");
if (isset($_GET['sort'])) {
    displaycurrentsearch($_GET['sort'], $_GET['order'], $_GET['search']);
}

if (isset($_GET['sortc'])) {
    displayclosedsearch($_GET['sortc'], $_GET['order'], $_GET['search']);
}
