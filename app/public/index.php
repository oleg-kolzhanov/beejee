<?php declare(strict_types=1);

const APP_DIR = __DIR__ . '/../';

session_start();

require APP_DIR . 'vendor/autoload.php';

use App\App;
use App\AppContainer;

$appContainer = AppContainer::getInstance();
$app = App::getInstance();
$app();