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
        1: { id: 1, title: "Wicked - Parte 1", description: "Duração: 1h50min", poster: "../../images/wic.jpg", room: "Sala 2" },
        2: { id: 2, title: "Terrifier 3", description: "Duração: 2h40min", poster: "../../images/terrifier.jpg", room: "Sala 1" },
        3: { id: 3, title: "Moana 2", description: "Duração: 2h20min", poster: "../../images/moana1.jpg", room: "Sala 1" },
        4: { id: 4, title: "Mufasa", description: "Duração: 2h40min", poster: "../../images/mufasa1.jpg", room: "Sala 1" },
        5: { id: 5, title: "Sonic 3", description: "Duração: 1h45min", poster: "../../images/sonic.jpg", room: "Sala 1" },
        6: { id: 6, title: "Nosferatu", description: "Duração: 1h49min", poster: "../../images/nosferatu.jpg", room: "Sala 2" },
        7: { id: 7, title: "Kraven", description: "Duração: 3h07min", poster: "../../images/kraven.jpg", room: "Sala 2" },
        8: { id: 8, title: "Mission: Impossible - The Final Reckoning", description: "Duração: 2h30min", poster: "../../images/mission_impossible.jpg", room: "Sala 1" },
        9: { id: 9, title: "Thunderbolts", description: "Duração: 2h20min", poster: "../../images/thunderbolts.jpg", room: "Sala 2" },
        10: { id: 10, title: "Jurassic World Rebirth", description: "Duração: 2h25min", poster: "../../images/jurassic_world_rebirth.jpg", room: "Sala 1" },
        11: { id: 11, title: "The Fantastic Four: First Steps",  description: "Duração: 2h15min", poster: "../../images/fantastic_four.jpg", room: "Sala 2" },
        12: { id: 12, title: "Superman", description: "Duração: 2h35min", poster: "../../images/superman.jpg", room: "Sala 2"  },
        13: { id: 13, title: "Captain America: Brave New World", description: "Duração: 2h40min", poster: "../../images/captain_america.jpg", room: "Sala 1" },
        14: { id: 14, title: "Tron: Ares", description: "Duração: 2h10min", poster: "../../images/tron_ares.jpg", room: "Sala 2" }
    };

    const movie = movies[id];
    document.getElementById('film-title').innerText = movie.title;
    document.getElementById('film-description').innerText = movie.description;
    document.getElementById('film-poster').src = movie.poster;
    document.getElementById('film-room').innerText = `Sala: ${movie.room}`;

    generateDateOptions();

    document.getElementById('film-modal').style.display = 'flex';

    document.querySelectorAll('input[name="ticketType"]').forEach(input => {
        input.addEventListener('change', () => {
            if (input.value === 'meia') {
                document.getElementById('document-upload').style.display = 'block';
            } else {
                document.getElementById('document-upload').style.display = 'none';
                document.getElementById('student-document').value = '';
                document.getElementById('document-status').innerText = '';
            }
        });
    });

    document.getElementById('confirm-session').addEventListener('click', (e) => {
        e.preventDefault();

        // Verificar se o usuário está autenticado
        const token = getCookie('token_autenticacao'); // A função `getCookie` pode ser implementada para pegar o cookie de autenticação
        if (!token) {
            alert('Você precisa estar logado para continuar.');
            window.location.href = 'login_page.php'; // Redireciona para a página de login
            return;
        }

        const ticketType = document.querySelector('input[name="ticketType"]:checked');
        const sessionTime = document.querySelector('input[name="sessionTime"]:checked');
        const sessionDate = document.querySelector('input[name="sessionDate"]:checked');
        const documentUpload = document.getElementById('student-document').files.length;

        if (!ticketType || !sessionTime || !sessionDate) {
            alert('Por favor, preencha todos os campos.');
            return;
        }

        if (ticketType.value === 'meia' && documentUpload === 0) {
            document.getElementById('document-status').innerText = 'Por favor, envie um comprovante de estudante.';
            return;
        } else {
            document.getElementById('document-status').innerText = '';
        }

        const movieTitle = encodeURIComponent(movie.title);
        const ticketPrice = ticketType.value === 'meia' ? 15 : 30;
        const poster = encodeURIComponent(movie.poster); // Codifica o caminho da imagem para URL
        const ticketDetails = `?movieId=${movie.id}&movieTitle=${movieTitle}&ticketType=${ticketType.value}&sessionTime=${sessionTime.value}&sessionDate=${sessionDate.value}&ticketPrice=${ticketPrice}&room=${movie.room}&poster=${poster}`;

        window.location.href = `assentos.php${ticketDetails}`;
    });
}

// Função para pegar o cookie
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

function generateDateOptions() {
    const dateOptions = document.getElementById('date-options');
    dateOptions.innerHTML = '';
    const today = new Date();
    for (let i = 0; i < 3; i++) {
        const date = new Date(today);
        date.setDate(today.getDate() + i);
        const option = document.createElement('label');
        option.innerHTML = `<input type="radio" name="sessionDate" value="${date.toISOString().split('T')[0]}"> ${date.toLocaleDateString()}`;
        dateOptions.appendChild(option);
    }
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
window.onclick = (event) => {
    if (event.target === modal) {
        closeModal();
    }
};
