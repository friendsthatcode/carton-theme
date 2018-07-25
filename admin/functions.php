<?php

// Change login logo
function my_login_logo() { ?>
    <style type="text/css">
    	/*change the below URL*/
        .login h1 a {
            background-image: url('https://placebear.com/g/200/150.jpg');
            width: 220px;
            background-size: 100%;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );
