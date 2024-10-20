<?php

//https://woocommerce.com/document/disable-the-default-stylesheet/
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );