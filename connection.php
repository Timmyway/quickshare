<?php
$path = 'sqlite:quickshare.sqlite3';
$db = new PDO($path);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);