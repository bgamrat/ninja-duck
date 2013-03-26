<?php
require '../protected/config/defines.php';

require _PROTECTED_ . '/include/session_setup.php';
require _PROTECTED_ . '/controllers/index.php';

ob_start();
require  _CONTENT_ . '/' . $page . '.php';
$content = ob_get_contents();
ob_end_clean();
require _LAYOUTS_ . '/default.php';
