<?php
session_start(); 

function get_cart_count() {
    if (empty($_SESSION['cart'])) {
        return 0;
    }
    
    return array_reduce($_SESSION['cart'], function($count, $item) {
        return $count + $item['quantity'];
    }, 0);
}
?>
