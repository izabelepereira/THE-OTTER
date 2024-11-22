<?php
$filmes = [
    [
        'id' => 0,
        'titulo' => 'gladiador II',
        'duracao' => '2h40min',
        'imagem' => '../../images/gladia.jpg',
        'classificacao' => '18',
        'genero' => 'Ação - Drama'
    ],
    [
        'id' => 1,
        'titulo' => 'Wicked - Parte 1',
        'duracao' => '1h50min',
        'imagem' => '../../images/wic.jpg',
        'classificacao' => '10',
        'genero' => 'Musical - Fantasia'
    ],
    [
        'id' => 2,
        'titulo' => 'terrifier 3',
        'duracao' => '2h40min',
        'imagem' => '../../images/terrifier.jpg',
        'classificacao' => '18',
        'genero' => 'Terror - Suspense'
    ],
    [
        'id' => 3,
        'titulo' => 'moana 2',
        'duracao' => '2h20min',
        'imagem' => '../../images/moana1.jpg',
        'classificacao' => 'L',
        'genero' => 'Animação - Aventura'
    ],
    [
        'id' => 4,
        'titulo' => 'mufasa',
        'duracao' => '2h40min',
        'imagem' => '../../images/mufasa1.jpg',
        'classificacao' => 'L',
        'genero' => 'Aventura - Drama'
    ],
    [
        'id' => 5,
        'titulo' => 'sonic 3',
        'duracao' => '1h45min',
        'imagem' => '../../images/sonic.jpg',
        'classificacao' => 'L',
        'genero' => 'Ação - Aventura'
    ],
    [
        'id' => 6,
        'titulo' => 'nosferatu',
        'duracao' => '1h49min',
        'imagem' => '../../images/nosferatu.jpg',
        'classificacao' => '16',
        'genero' => 'Horror - Clássico'
    ],
    [
        'id' => 7,
        'titulo' => 'kraven',
        'duracao' => '3h7min',
        'imagem' => '../../images/kraven.jpg',
        'classificacao' => '14',
        'genero' => 'Ação - Suspense'
    ],
    [
        'id' => 8,
        'titulo' => 'Mission: Impossible - The Final Reckoning',
        'duracao' => '2h30min',
        'imagem' => '../../images/mission_impossible.jpg',
        'classificacao' => '12',
        'genero' => 'Ação'
    ],
    [
        'id' => 9,
        'titulo' => 'Thunderbolts',
        'duracao' => '2h20min',
        'imagem' => '../../images/thunderbolts.jpg',
        'classificacao' => '14',
        'genero' => 'Ação'
    ],
    [
        'id' => 10,
        'titulo' => 'Jurassic World Rebirth',
        'duracao' => '2h25min',
        'imagem' => '../../images/jurassic_world_rebirth.jpg',
        'classificacao' => '10',
        'genero' => 'Aventura'
    ],
    [
        'id' => 11,
        'titulo' => 'The Fantastic Four: First Steps',
        'duracao' => '2h15min',
        'imagem' => '../../images/fantastic_four.jpg',
        'classificacao' => '12',
        'genero' => 'Ação - Fantasia'
    ],
    [
        'id' => 12,
        'titulo' => 'Superman',
        'duracao' => '2h35min',
        'imagem' => '../../images/superman.jpg',
        'classificacao' => '12',
        'genero' => 'Ação - Fantasia'
    ],
    [
        'id' => 13,
        'titulo' => 'Captain America: Brave New World',
        'duracao' => '2h40min',
        'imagem' => '../../images/captain_america.jpg',
        'classificacao' => '12',
        'genero' => 'Ação - Fantasia'
    ],
    [
        'id' => 14,
        'titulo' => 'Tron: Ares',
        'duracao' => '2h10min',
        'imagem' => '../../images/tron_ares.jpg',
        'classificacao' => '12',
        'genero' => 'Ficção Científica'
    ]
    
];




$carouselItems = [
    [
        'image' => '../../images/mufasa.png',
        'title' => 'Mufasa: O Rei Leão',
        'textColor' => 'color:#FFCC41;',
        'buttonClass' => 'idade-L',
        'buttonText' => 'L',
        'subtitleColor' => 'color:#fff;',
    ],
    [
        'image' => '../../images/dragao.png',
        'title' => 'A Menina e o Dragão',
        'textColor' => 'color:#B72020;',
        'buttonClass' => 'idade-L',
        'buttonText' => 'L',
        'subtitleColor' => 'color:#FFAE44;',
    ],
    [
        'image' => '../../images/coringa.png',
        'title' => 'Coringa: Delírio a Dois',
        'textColor' => 'color:#30C52B;',
        'buttonClass' => 'idade-18',
        'buttonText' => '18',
        'subtitleColor' => 'color:#B72020;',
    ],
    [
        'image' => '../../images/gladiador.png',
        'title' => 'Gladiador II',
        'textColor' => 'color:#AD0C0C;',
        'buttonClass' => 'idade-18',
        'buttonText' => '18',
        'subtitleColor' => 'color:#fff;',
    ],
    [
        'image' => '../../images/moana.png',
        'title' => 'Moana 2',
        'textColor' => 'color:#34365d;',
        'buttonClass' => 'idade-L',
        'buttonText' => 'L',
        'subtitleColor' => 'color:#fff;',
    ],
];



?>

<script>
    const filmes = <?php echo json_encode($filmes); ?>;
</script>