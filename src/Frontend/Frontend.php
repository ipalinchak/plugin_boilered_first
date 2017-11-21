<?php namespace Permmerce\PluginBoilerNew\Frontend;

use Permmerce\PluginBoilerNew\FileManager;

/**
 * Class Frontend
 *
 * @package Permmerce\PluginBoilerNew\Frontend
 */
class Frontend {


	/**
	 * @var FileManager
	 */
	private $fileManager;

	public function __construct( FileManager $fileManager ) {
		$this->fileManager = $fileManager;
	}

}