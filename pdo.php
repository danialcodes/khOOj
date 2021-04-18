<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=danialco_bangladesh;charset=utf8','danialco_shohardo','shoh@rdo');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>