<?php
function createCarousel($items) {
    $carouselHtml = '<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">';

    foreach ($items as $index => $item) {
        $activeClass = $index === 0 ? 'active' : '';
        $carouselHtml .= '<div class="carousel-item ' . $activeClass . '">
            <div class="container img-container">
                <img src="' . $item['image'] . '" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-caption d-none d-md-block">
                <h5 class="carousel-caption-text" style="' . $item['textColor'] . '">' . $item['title'] . '</h5>
                <h1 class="assista-text" style="' . ($item['subtitleColor'] ?? '') . '">Assista agora!</h1>';
        if (!empty($item['buttonText'])) {
            $carouselHtml .= '<button class="idade ' . $item['buttonClass'] . '">' . $item['buttonText'] . '</button>';
        }
        $carouselHtml .= '</div>
        </div>';
    }

    $carouselHtml .= '</div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>';

    return $carouselHtml;
}

echo createCarousel($carouselItems);
?>