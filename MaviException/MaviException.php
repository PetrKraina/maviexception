<?php

/*
 * Author: Petr Kraina
 * Licence: MIT
 */

namespace Mavi\MaviException;

class MaviException extends \Exception {

	/** Path to directory with observer classes. */
	public const OBSERVERS_DIR = 'MaviException/ExceptionObservers';

	/** Namespace of observers in OBSERVERS_DIR */
	public const OBSERVERS_NAMESPACE = 'Mavi\MaviException\ExceptionObservers\\';

	public function __construct(string $message, int $code = 0, \Throwable $previous = null) {

		parent::__construct($message, $code, $previous);

		$observers = $this->getObservers();
		$url = $this->getUrl();

		foreach ($observers as $observerName) {
			$observer = new $observerName;
			$observer->notify($message, $code, $url);
		}
	}

	private function getObservers(): array {

		$subscribers = [];
		$files = scandir('MaviException/ExceptionObservers');

		foreach ($files as $file) {

			if (is_dir($file)) {
				continue;
			}
			$filename = pathinfo($file, PATHINFO_FILENAME);
			array_push($subscribers, self::OBSERVERS_NAMESPACE . $filename);
		}

		return $subscribers;
	}

	private function getUrl(): string {

		$requestType = 'http://';

		if (empty($_SERVER['HTTPS']) === false && $_SERVER['HTTPS'] === 'on') {
			$requestType = 'https://';
		}

		return $requestType . filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_URL) . filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
	}

}
