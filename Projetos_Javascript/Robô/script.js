// Seleciona o elemento do tabuleiro
const grid = document.getElementById("grid");

// Função para criar o tabuleiro
function criarTabuleiro() {
    // Limpa o tabuleiro existente
    grid.innerHTML = "";

    // Cria as células e adiciona ao tabuleiro
    let cont = 0;
    for (let i = 0; i < 8; i++) {
        for (let j = 0; j < 8; j++) {
            cont++;
            const cell = document.createElement("div");
            cell.classList.add("cell");
            cell.id = cont;
            // Adiciona a célula ao tabuleiro
            grid.appendChild(cell);
        }
    }
}

// Chama a função para criar o tabuleiro ao carregar a página
window.onload = criarTabuleiro;
