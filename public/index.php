<?php

declare(strict_types=1);

$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

/* YOUR CODE (Instructions in README.md) */
require(APP_PATH . 'helpers.php');
require(APP_PATH . 'App.php');

$file_paths = get_csv_filepaths();
$data_array = csv_to_array($file_paths);

$httable = array_to_html($data_array);
$totals = calculate_totals($data_array);

require(VIEWS_PATH . 'transactions.php');
