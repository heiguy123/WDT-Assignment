<?php
include_once('_cus.function.php');
havesession();
if (isset($_GET['sort'])) {
    displaycurrentsearch($_GET['sort'], $_GET['order'], $_GET['search'],$_SESSION['cus_row']['cus_id']);
}
if (isset($_GET['sortc'])) {
    displayclosedsearch($_GET['sortc'], $_GET['order'], $_GET['search'],$_SESSION['cus_row']['cus_id']);
}
?>