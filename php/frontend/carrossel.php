<?php
function gerarCarrossel($filmesCarrossel) {
    echo '<div class="film-slider">';
    echo '<button class="nav-button prev">&#10094;</button>';
    echo '<div class="film-items">';

    foreach ($filmesCarrossel as $filmes) {
        // Obtém a classificação e gera a classe CSS dinamicamente
        $classificacao = $filmes['classificacao'];
        $classificacaoClasse = "age-rating" . $classificacao; // Ex: age-rating18, age-ratingL, etc.

        $genero = $filmes['genero'];

        echo '<div class="film-card" data-id="' . $filmes['id'] . '">';
        echo '<div class="img-container">';
        echo '<img src="' . $filmes['imagem'] . '" alt="' . $filmes['titulo'] . '">';
        echo '</div>';
        echo '<div class="card-content">';
        echo '<h3>' . $filmes['titulo'] . '</h3>';
        echo '<p>' . $filmes['duracao'] . '</p>';
        // Exibe o botão com a classificação dinâmica
        echo '<button class="' . $classificacaoClasse . '">' . $classificacao . '</button>';
        echo '<h4 class="film-card">' . $genero . '</h4>';
        echo '</div>';
        echo '</div>';
    }

    echo '</div>';
    echo '<button class="nav-button next">&#10095;</button>';
    echo '</div>';
}
?>
