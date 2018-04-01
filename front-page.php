<?php
$data = Timber::get_context();
$post = new TimberPost();
$data['post'] = $post;

Timber::render('home.twig', $data);
