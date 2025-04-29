<?php
session_start();
session_destroy();
header("Location: /Horizon/pages/user/login.php");
exit;