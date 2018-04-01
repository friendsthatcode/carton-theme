<?php

$data = Timber::get_context();
$image = get_field('404_image', 'option');
$data['error_image'] = $image['url'];
Timber::render('404.twig', $data);
