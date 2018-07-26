<?php
/**
 * FTC functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 *
 * @package WordPress
 * @subpackage FTC Theme
 * @since FTC 1.0
 */

/**
 * Loops through functions folder and requires files
 * Requires PHP 5.3 or above.
 *
 * @since FTC 1.0
 * @return void
 */
$files = new \FilesystemIterator( __DIR__.'/functions', \FilesystemIterator::SKIP_DOTS );
foreach ( $files as $file ) {
	/** @noinspection PhpIncludeInspection */
	! $files->isDir() and include $files->getRealPath();
}



/**
 * Admin Functions
 */
include 'admin/functions.php';
