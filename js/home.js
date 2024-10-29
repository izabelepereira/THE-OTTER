document.querySelectorAll('.film-card').forEach(item => {
    item.addEventListener('click', event => {
        const movieId = item.getAttribute('data-id');
        fetchMovieDetails(movieId);
    });
});

document.getElementById('film-close').addEventListener('click', () => {
    document.getElementById('film-modal').style.display = 'none';
});

function fetchMovieDetails(id) {
    const movies = {
        1: { title: "moana", description: "Descrição do Filme 1." },
        2: { title: "Filme 2", description: "Descrição do Filme 2." },
        3: { title: "moana", description: "Descrição do Filme 1." },
        4: { title: "Filme 2", description: "Descrição do Filme 2." },
    };
    
    const movie = movies[id];
    document.getElementById('film-title').innerText = movie.title;
    document.getElementById('film-description').innerText = movie.description;
    document.getElementById('film-modal').style.display = 'flex';
}

const slider = document.querySelector('.film-items');
const nextButton = document.querySelector('.next');
const prevButton = document.querySelector('.prev');

let scrollPosition = 0;
const cardWidth = document.querySelector('.film-card').offsetWidth;
const visibleCards = 4; // Número de cards visíveis por vez
const totalCards = slider.children.length; // Número total de cards
const maxScroll = (totalCards - visibleCards) * cardWidth; // Limite de scroll

nextButton.addEventListener('click', () => {
    if (Math.abs(scrollPosition) < maxScroll) {
        scrollPosition -= cardWidth * visibleCards;
        slider.style.transform = `translateX(${scrollPosition}px)`;
    }
});

prevButton.addEventListener('click', () => {
    if (scrollPosition < 0) {
        scrollPosition += cardWidth * visibleCards;
        slider.style.transform = `translateX(${scrollPosition}px)`;
    }
});

// Seleciona o modal e os botões
const modal = document.getElementById('film-modal');
const closeButton = document.getElementById('film-close');
const openButton = document.getElementById('open-modal-button');

// Função para fechar o modal
function closeModal() {
    modal.style.display = 'none';
}

// Função para abrir o modal
function openModal() {
    modal.style.display = 'flex'; // Ou 'block', dependendo do seu CSS
}

// Quando o botão de fechar for clicado, fecha o modal
closeButton.onclick = closeModal;

// Quando o usuário clicar fora do modal, fecha o modal
window.onclick = function(event) {
    if (event.target === modal) {
        closeModal();
    }
}

// Quando o botão de abrir for clicado, abre o modal
openButton.onclick = openModal;


