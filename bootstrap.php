<?php

use Chetkov\Money\LibConfig;

require_once __DIR__ . '/vendor/autoload.php';

$moneyConfig = require __DIR__ . '/money-config.php';
LibConfig::getInstance($moneyConfig);