<?php
if (defined('_INIT_')) return;
define('_INIT_',true);

define('_VERSION_','0.6');

define('_DATA_FILE_','/tmp/students.json');

define('_PROTECTED_', (!isset($argv)) ? '../protected' : '..');

define('_CONFIGS_', _PROTECTED_ . '/config');

define('_VIEWS_', _PROTECTED_ . '/views');
define('_LAYOUTS_', _VIEWS_ . '/layouts');
define('_CONTENT_', _VIEWS_ . '/pages');
define('_PRINT_', _VIEWS_ . '/print');

define('_INCLUDE_', _PROTECTED_ . '/include');

/* Auto load */
spl_autoload_register(function($class) {
	include _PROTECTED_ . '/models/' . $class . '.php';
});
/* /Auto load */

