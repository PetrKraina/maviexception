<?php

/*
 * Author: Petr Kraina
 * Licence: MIT
 */

namespace Mavi\MaviException\ExceptionObservers;

use \Mavi\MaviException\ObserverInterface\MaviExceptionObserver;

class LogToFile implements MaviExceptionObserver{

	public const LOG_FILE = 'MaviException/log/exceptions.log';

	public function notify(string $message, int $code, string $url): void {

		$exception = 'CODE: ' . $code . ' MESSAGE: ' . $message . '; URL: ' . $url . PHP_EOL;
		print_r(file_put_contents(self::LOG_FILE, $exception, FILE_APPEND));
	}
}
