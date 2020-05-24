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

function randomNumber($min, $max) {
	$number = rand($min*10, $max*10) / 10;
	return $number;
}

// Just apply like so:
// {{ post.get_field('wysiwyg')|wysiwygHeaders }}
function wysiwygHeaders($wysiwyg) {
	foreach (range(1, 6) as $i) {
		$wysiwyg = str_replace('<h' . $i . '>', '<p class="h' . $i . '">', $wysiwyg);
		$wysiwyg = str_replace('</' . $i . '>', '</p>', $wysiwyg);
	}
	return $wysiwyg;
}

function focal_crop_position($image){
	if($image->_wpsmartcrop_image_focus){
		$crop = unserialize($image->_wpsmartcrop_image_focus);
		$position = $crop['left'] . '% ' . $crop['top'] . '%';
		return $position;
	} else {
		return '50%';
	}
}

add_filter('get_twig', 'add_to_twig');
function add_to_twig($twig) {
	$twig->addFilter('doctype', new Twig_Filter_Function('doctype'));
	$twig->addFilter('hexrgb', new Twig_Filter_Function('hextorgb'));
    $twig->addFilter('sortBy', new Twig_Filter_Function('sortBy'));
    $twig->addFilter('niceNumber', new Twig_Filter_Function('niceNumber'));
    $twig->addFilter('randomNumber', new Twig_Filter_Function('randomNumber'));
    $twig->addFilter('wysiwygHeaders', new Twig_Filter_Function('wysiwygHeaders'));
    $twig->addFilter('focal_crop_position', new Twig_Filter_Function('focal_crop_position'));
	return $twig;
}
?>
