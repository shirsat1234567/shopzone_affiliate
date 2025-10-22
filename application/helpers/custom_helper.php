<?php

if (!function_exists('get_subcategory_icon')) {
    function get_subcategory_icon($subcategory) {
        $icons = array(
            'shoes' => '👞',
            'shirts' => '👔', 
            'pants' => '👖',
            'watches' => '⌚',
            'tops' => '👗',
            'jeans' => '👖',
            'necklaces' => '💍',
            'makeup' => '💄',
            'toys' => '🧸',
            'clothes' => '👕',
            'police' => '👮',
            'mpsc' => '📘',
            'upsc' => '📚',
            'novels' => '📖',
            'chairs' => '🪑',
            'tables' => '🪑',
            'beds' => '🛏️',
            'mobiles' => '📱',
            'laptops' => '💻',
            'earphones' => '🎧'
        );
        
        return isset($icons[$subcategory]) ? $icons[$subcategory] : '📦';
    }
}

?>