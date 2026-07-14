<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once dirname(__DIR__) . '/app/core/sessionManager.php';
require_once dirname(__DIR__).'/app/core/router.php';

startSession();

dispatch();