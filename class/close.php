<?php
require("class_chat.php");
session_destroy();
$chat=new Chat();
$chat->show_form();
?>