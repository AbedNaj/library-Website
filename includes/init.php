<?php
// تهيئة المتغيرات البيئية
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($name, $value) = explode('=', $line, 2);
            putenv(sprintf('%s=%s', trim($name), trim($value)));
        }
    }
}

// تعيين منطقة زمنية
date_default_timezone_set('Asia/Riyadh');

// تهيئة الجلسة بشكل آمن

if (session_status() === PHP_SESSION_NONE) {


    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 1);
    session_start();
}
// تعيين إعدادات PHP
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log',  '../logs/error.log');
