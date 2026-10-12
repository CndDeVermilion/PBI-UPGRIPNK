<?php
$filePath = __DIR__ . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

if (file_exists($filePath) && !is_dir($filePath)) {
    return false;
}

require __DIR__ . '/404.php';
