<?php
session_start();
session_unset();
session_destroy();
//header("Location: login.php");
echo "<script>window.location = 'login.php?page=login'</script>";