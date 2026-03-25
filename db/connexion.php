<?php

require_once __DIR__.'/../vendor/autoload.php';

if (!isset($dotenv)) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
    $dotenv->load();
}

db_connection();