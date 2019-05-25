<?php
define('ROOT_DIR', __DIR__.'/../');
define('CONFIG_DIR', __DIR__.'/../config/');
define('CONTROLLERS_DIR', __DIR__.'/../controllers/');
define('CORE_DIR', __DIR__.'/../core/');
define('MODELS_DIR', __DIR__.'/../models/');
define('PUBLIC_DIR', __DIR__.'/../public/');
define('VIEWS_DIR', __DIR__.'/../views/');

include_once CORE_DIR.'autoload.php';

$routing = include_once CONFIG_DIR . '/routing.php';

(new core\Application( $routing ))->run();