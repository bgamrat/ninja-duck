#!/usr/bin/php
<?php
include '../config/defines.php';
require _PROTECTED_.'/controllers/students.php';
$coreonly = (in_array('-coreonly',$argv));
include _CONTENT_.'/plaintext.php';
