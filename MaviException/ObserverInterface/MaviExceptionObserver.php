<?php

/*
 * Author: Petr Kraina
 * Licence: MIT
 */

namespace Mavi\MaviException\ObserverInterface;

interface MaviExceptionObserver{

	/**
	 * Function to notify or log, etc... depending on specific observer.
	 * @param string $message Exception message.
	 * @param string $url URL on which exception emerged.
	 * @return void
	 */
	public function notify(string $message, int $code, string $url): void;
}
