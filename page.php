<?php
$data = Timber::get_context();
$post = new TimberPost();
$data['post'] = $post;

Timber::render(array($post->post_name . '.twig', 'page.twig'), $data);
