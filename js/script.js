const filterButtons = document.querySelectorAll('.filter-button');
    const guloseimasHeader = document.getElementById('guloseimas-header');
    const chocolatesHeader = document.getElementById('chocolates-header');
    const snacksHeader = document.getElementById('snacks-header');
    const bebidasHeader = document.getElementById('bebidas-header');
    const combosHeader = document.getElementById('combos-header');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const category = button.getAttribute('data-category');

            // Ocultar todos os cabeçalhos
            guloseimasHeader.style.display = 'none';
            chocolatesHeader.style.display = 'none';
            snacksHeader.style.display = 'none';
            bebidasHeader.style.display = 'none';
            combosHeader.style.display = 'none';

            // Ocultar todos os produtos
            const allProducts = document.querySelectorAll('.col-md-3');
            allProducts.forEach(product => product.style.display = 'none');

            // Exibir cabeçalho e produtos correspondentes
            if (category === 'guloseimas') {
                guloseimasHeader.style.display = 'block'; // Exibe cabeçalho de guloseimas
                const guloseimasProducts = document.querySelectorAll('[data-category="guloseimas"], [data-category="chocolates"]');
                guloseimasProducts.forEach(product => product.style.display = 'block'); // Exibe produtos de guloseimas e chocolates
                guloseimasHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave
            } else if (category === 'snacks') {
                snacksHeader.style.display = 'block'; // Exibe cabeçalho de snacks
                const snacksProducts = document.querySelectorAll('[data-category="snacks"]');
                snacksProducts.forEach(product => product.style.display = 'block'); // Exibe produtos de snacks
                snacksHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave
            } else if (category === 'bebidas') {
                bebidasHeader.style.display = 'block'; // Exibe cabeçalho de bebidas
                const bebidasProducts = document.querySelectorAll('[data-category="bebidas"]');
                bebidasProducts.forEach(product => product.style.display = 'block'); // Exibe produtos de bebidas
                bebidasHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave
            } else if (category === 'combos') {
                combosHeader.style.display = 'block'; // Exibe cabeçalho de combos
                const combosProducts = document.querySelectorAll('[data-category="combos"]');
                combosProducts.forEach(product => product.style.display = 'block'); // Exibe produtos de combos
                combosHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave
            }
        });
    });

    // Edição: Evento de clique para a imagem comer5.png
    const multiCategoryButton = document.getElementById('multi-category-button');
    
    multiCategoryButton.addEventListener('click', () => {
        // Remover a linha que oculta a imagem comer5.png
        // multiCategoryButton.style.display = 'none'; // Esta linha foi removida

        // Ocultar todos os cabeçalhos
        guloseimasHeader.style.display = 'none';
        chocolatesHeader.style.display = 'none';
        snacksHeader.style.display = 'none';
        bebidasHeader.style.display = 'none';
        combosHeader.style.display = 'none';

        // Ocultar todos os produtos
        const allProducts = document.querySelectorAll('.col-md-3');
        allProducts.forEach(product => product.style.display = 'none');

        // Exibir os cabeçalhos e produtos das categorias "guloseimas", "chocolates", "combos", "snacks"
        guloseimasHeader.style.display = 'block'; // Exibe o cabeçalho de guloseimas
    
        // Exibir os produtos das categorias relevantes
        const selectedProducts = document.querySelectorAll('[data-category="guloseimas"], [data-category="chocolates"], [data-category="combos"], [data-category="snacks"]');
        selectedProducts.forEach(product => product.style.display = 'block'); // Exibe produtos das categorias selecionadas

        guloseimasHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave para a seção de guloseimas
    });

    // Edição: Evento de clique para a imagem beber5.png
    const beveragesButton = document.getElementById('beverages-button');

    if (beveragesButton) { // Verifica se o elemento existe
        beveragesButton.addEventListener('click', () => {
            // Ocultar a imagem beber5.png
            beveragesButton.style.display = 'none'; // Esconde a imagem

            // Ocultar todos os cabeçalhos
            guloseimasHeader.style.display = 'none';
            chocolatesHeader.style.display = 'none';
            snacksHeader.style.display = 'none';
            bebidasHeader.style.display = 'none';
            combosHeader.style.display = 'none';

            // Ocultar todos os produtos
            const allProducts = document.querySelectorAll('.col-md-3');
            allProducts.forEach(product => product.style.display = 'none');

            // Exibir o cabeçalho e produtos da categoria "bebidas"
            bebidasHeader.style.display = 'block'; // Exibe o cabeçalho de bebidas

            // Exibir os produtos da categoria "bebidas"
            const selectedBeverageProducts = document.querySelectorAll('[data-category="bebidas"]');
            selectedBeverageProducts.forEach(product => product.style.display = 'block'); // Exibe produtos da categoria "bebidas"

            bebidasHeader.scrollIntoView({ behavior: 'smooth' }); // Rolagem suave para a seção de bebidas
        });
    } else {
        console.error("Elemento com ID 'beverages-button' não encontrado.");
    }

    function filtrarCombos() {
        const comboButton = document.querySelector('.filter-button[data-category="combos"]');
        if (comboButton) {
            comboButton.click(); // Simula um clique no botão de filtro de combos
        }
    }

    function adicionarCarrinho(produtoId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../carrinho.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        if (xhr.status === 200) {
            // Verifica a resposta JSON
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Mostrar o modal
                var modal = new bootstrap.Modal(document.getElementById('modalCarrinho'));
                modal.show();
            } else {
                alert(response.message); // Mostra mensagem de erro
            }
        }
    };

    // Enviar o ID do produto
    xhr.send("produto_id=" + produtoId);
}
