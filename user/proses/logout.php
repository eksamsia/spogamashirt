<?php

session_start();
unset($_SESSION['user']);
unset($_SESSION['nama_user']);

header("Location: ../index.php");
