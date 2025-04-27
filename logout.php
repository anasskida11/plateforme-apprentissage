<?php
session_start();
session_destroy();
header("Location: /projet/index.php");
exit();
?> 