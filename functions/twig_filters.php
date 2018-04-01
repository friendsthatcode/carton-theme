<?php

/**
 * Get the file extension for a file.
 * @param $path
 * @return sring
 */
function doctype($path) {
	return pathinfo($path, PATHINFO_EXTENSION);
}

/**
 * Converts a hex colour to rgb.
 * @param $opacity
 */
function hextorgb($hex, $opacity = 1) {
	$rgb = join(',', sscanf($hex, "#%02x%02x%02x"));
	return 'rgba(' . $rgb . ',' . $opacity . ')';
}

function sortBy($array, $key) {
    $collection = collect($array);
    $sorted = $collection->sortBy($key);
    return $sorted->all();
}

function niceNumber($number) {
	if ($number < 1000000) {
	    // Anything less than a million
	    $format = number_format($number);
	} else if ($number < 1000000000) {
	    // Anything less than a billion
	    $format = number_format($number / 1000000, 2) . 'M';
	} else {
	    // At least a billion
	    $format = number_format($number / 1000000000, 2) . 'B';
	}
	return $format;
}

add_filter('get_twig', 'add_to_twig');
function add_to_twig($twig) {
	$twig->addFilter('doctype', new Twig_Filter_Function('doctype'));
	$twig->addFilter('hexrgb', new Twig_Filter_Function('hextorgb'));
    $twig->addFilter('sortBy', new Twig_Filter_Function('sortBy'));
    $twig->addFilter('niceNumber', new Twig_Filter_Function('niceNumber'));
	return $twig;
}
?>
