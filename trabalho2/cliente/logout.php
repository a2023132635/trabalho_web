<?php
session_start();
session_destroy();
header("Location: /trabalho2/index.php");
exit();
?>