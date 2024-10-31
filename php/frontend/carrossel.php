<?php
function gerarCarrossel($filmesCarrossel) {
    echo '<div class="film-slider">';
    echo '<button class="nav-button prev">&#10094;</button>';
    echo '<div class="film-items">';
    
    foreach ($filmesCarrossel as $filme) {
        $classificacao = $filme['classificacao'];
        $classificacaoClasse = 'age-rating' . $classificacao;
        $genero = $filme['genero']; // Supondo que cada filme tenha um campo 'genero'
  
        echo '<div class="film-card" data-id="' . $filme['id'] . '">';
        echo '<div class="img-container">';
        echo '<img src="' . $filme['imagem'] . '" alt="' . $filme['titulo'] . '">';
        echo '</div>';
        echo '<div class="card-content">';
        echo '<h3>' . $filme['titulo'] . '</h3>';
        echo '<p>' . $filme['duracao'] . '</p>';
        echo '<button class="age-rating ' . $classificacaoClasse . '">' . $classificacao . '</button>';
        
        // Exibindo o gênero do filme com a classe film-card h4
        echo '<h4 class="film-card">' . $genero . '</h4>';
  
        echo '</div>'; // .card-content
        echo '</div>'; // .film-card
    }
  
    echo '</div>'; // .film-items
    echo '<button class="nav-button next">&#10095;</button>';
    echo '</div>'; // .film-slider
  }


 
  ?>