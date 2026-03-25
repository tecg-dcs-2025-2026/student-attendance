<?php

use Illuminate\Database\Capsule\Manager as Capsule;

include __DIR__ . '/../connexion.php';

Capsule::schema()->dropAllTables();
