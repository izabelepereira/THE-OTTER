const itemsContainer = document.getElementById('items-container');

// Função para exibir produtos
function displayProducts(products) {
    const candiesContainer = document.querySelector('.candies-container');
    const chocolatesContainer = document.querySelector('.chocolates-container');

    // Limpar as seções antes de adicionar novos produtos
    candiesContainer.innerHTML = '';
    chocolatesContainer.innerHTML = '';

    products.forEach(product => {
        const productHtml = `
            <div class="col mb-4">
                <div class="card">
                    <img src="${product.image}" alt="${product.name}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">${product.name}</h5>
                        <p class="card-text">R$ ${product.price.toFixed(2)}</p>
                        <button class="btn btn-primary" onclick="addToCart(${product.id})">Adicionar ao Carrinho</button>
                    </div>
                </div>
            </div>
        `;

        if (product.category === 'candies') {
            candiesContainer.innerHTML += productHtml;
        } else if (product.category === 'chocolate') {
            chocolatesContainer.innerHTML += productHtml;
        }
    });

    itemsContainer.style.display = 'block'; // Exibe os itens
}

// Função para adicionar produto ao carrinho
function addToCart(productId) {
    alert(`Produto ${productId} adicionado ao carrinho!`);
}

// Chamada inicial para exibir todos os produtos
displayProducts(products);
