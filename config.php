<?php
return [
    'name' => 'quickshare',
    'site_url' => ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" )."://$_SERVER[HTTP_HOST]/quickshare/",
    'root' => $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'quickshare'.DIRECTORY_SEPARATOR,
    'db_path' => $_SERVER["DOCUMENT_ROOT"].'/quickshare/quickshare.sqlite3'
];