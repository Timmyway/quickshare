<?php
define('APP_NAME', 'quickshare');
define('SEP', DIRECTORY_SEPARATOR);
define('SITE_URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")."://$_SERVER[HTTP_HOST]/".APP_NAME.'/');
define('ROOT', $_SERVER["DOCUMENT_ROOT"].SEP.APP_NAME.SEP);
define('DB_PATH', ROOT.'quickshare.sqlite3');