<?php

require_once 'MaviException/MaviException.php';
require_once 'MaviException/ObserverInterface/MaviExceptionObserver.php';
require_once 'MaviException/ExceptionObservers/LogToFile.php';

use Mavi\MaviException\MaviException;

$exception = new MaviException('Message text');
