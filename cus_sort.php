<?php
include_once('_cus.function.php');
havesession();
if (isset($_GET['sort'])) {
    displaycurrent($_GET['sort'], $_GET['order'],$_SESSION['cus_row']['cus_id']);
}
if (isset($_GET['sortc'])) {
    displayclosed($_GET['sortc'], $_GET['order'],$_SESSION['cus_row']['cus_id']);
}
?>