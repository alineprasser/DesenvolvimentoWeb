<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/server/DatabaseConnection.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/server/config.php';

session_start();
session_destroy();
header('location: ' . URL_BASE);
