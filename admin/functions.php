<?php

// Change login logo
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            /*background-image: url(/wp-content/themes/amin/assets/img/amin-logo.svg);*/
            width: 220px;
            background-size: 100%;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );
