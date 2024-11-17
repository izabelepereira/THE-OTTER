document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("signupForm");
    const errorMessage = document.getElementById("error-message");

    // Função para exibir mensagens de erro
    const displayError = (message) => {
        errorMessage.innerText = message;
        errorMessage.style.display = "block";
        setTimeout(() => {
            errorMessage.style.display = "none";
        }, 5000); // Esconde a mensagem após 5 segundos
    };

    // Máscara para CPF
    window.mascaraCpf = (input) => {
        let value = input.value.replace(/\D/g, ""); // Remove caracteres não numéricos
        if (value.length > 11) value = value.slice(0, 11);
        input.value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
    };

    // Máscara para telefone
    window.mascaraTelefone = (input) => {
        let value = input.value.replace(/\D/g, ""); // Remove caracteres não numéricos
        if (value.length > 11) value = value.slice(0, 11);
        input.value = value.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");
    };

    // Validação do formulário e envio via AJAX
    form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const formData = new FormData(form);
        try {
            const response = await fetch("../backend/cadastro.php", {
                method: "POST",
                body: formData,
            });

            const result = await response.json();

            if (result.success) {
                alert(result.message);
                window.location.href = "../frontend/login.php";
            } else if (result.errors) {
                displayError(result.errors.join("\n"));
            } else {
                displayError("Ocorreu um erro inesperado. Tente novamente.");
            }
        } catch (error) {
            console.error("Erro ao enviar formulário:", error);
            displayError("Erro ao conectar ao servidor. Verifique sua conexão.");
        }
    });
});
