<?php
session_start();
unset($_SESSION['mv_firstname']);
unset($_SESSION['mv_lastname']);
unset($_SESSION['mv_state_of_residence']);

header("Location: ../sign-in.php");
