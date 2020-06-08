<?php
$data = Timber::get_context();
$post = new TimberPost();
$data['post'] = $post;
$data['password_form'] = get_the_password_form();

Timber::render('password-protected.twig', $data);
