<?php
header('Content-Type: application/json');

$data = [
    // Balas
    [
        'id' => 1,
        'name' => 'Fini Beijos 90g',
        'category' => 'candies',
        'price' => 2.99,
        'image' => 'images/fini1.png'
    ],
    [
        'id' => 2,
        'name' => 'Fini Dentaduras 90g',
        'category' => 'candies',
        'price' => 3.99,
        'image' => 'images/fini2.png'
    ],
    [
        'id' => 3,
        'name' => 'Fini Bananas 90g',
        'category' => 'candies',
        'price' => 2.49,
        'image' => 'images/fini3.png'
    ],
    [
        'id' => 4,
        'name' => 'Finibughers 90g',
        'category' => 'candies',
        'price' => 3.49,
        'image' => 'images/fini5.png'
    ],
    [
        'id' => 5,
        'name' => 'Fini Minhocas 90g',
        'category' => 'candies',
        'price' => 4.49,
        'image' => 'images/fini4.png'
    ],
    [
        'id' => 6,
        'name' => 'Fini Minhocas Ácidas 90g',
        'category' => 'candies',
        'price' => 3.29,
        'image' => 'images/fini6.png'
    ],
    [
        'id' => 7,
        'name' => 'Fini Beijos 90g',
        'category' => 'candies',
        'price' => 2.79,
        'image' => 'images/fini9.png'
    ],
    [
        'id' => 8,
        'name' => 'Fini Tubes Morango 90g',
        'category' => 'candies',
        'price' => 5.99,
        'image' => 'images/fini11.png'
    ],
    [
        'id' => 9,
        'name' => 'Balas de Mentha',
        'category' => 'candies',
        'price' => 2.99,
        'image' => 'images/fini12.png'
    ],
    [
        'id' => 10,
        'name' => 'Balas Azedinhas',
        'category' => 'candies',
        'price' => 4.99,
        'image' => 'images/fini7.png'
    ],
    [
        'id' => 11,
        'name' => 'Fini Frutas Tropicais 90g',
        'category' => 'candies',
        'price' => 3.29,
        'image' => 'images/fini8.png'
    ],
    [
        'id' => 12,
        'name' => 'Fini Ursinhos 90g',
        'category' => 'candies',
        'price' => 4.29,
        'image' => 'images/fini10.png'
    ],
]

echo json_encode($data);
?>
