<?php
include_once("_admin.function.php");
if (isset($_GET['sort'])) {
    displaycurrentsearch($_GET['sort'], $_GET['order'], $_GET['search']);
} elseif (isset($_GET['sortc'])) {
    displayclosedsearch($_GET['sortc'], $_GET['order'], $_GET['search']);
} elseif (isset($_GET['msearch'])) {
    searchmenu($_GET['msearch']);
}
