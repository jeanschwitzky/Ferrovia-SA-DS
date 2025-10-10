const trens = [];

const cardsContainer = document.getElementById('cardsContainer');
const tremForm = document.getElementById('tremForm');
const addBtn = document.getElementById('addBtn');
const cancelBtn = document.getElementById('cancelBtn');
const removeAllBtn = document.getElementById('removeAllBtn');
const menuToggle = document.getElementById('menuToggle');
const sideMenu = document.getElementById('side-menu');
const mainContent = document.querySelector('main');

function formatarData(dataString) {
    const data = new Date(dataString);
    const dia = String(data.getDate()).padStart(2, '0');
    const mes = String(data.getMonth() + 1).padStart(2, '0');
    const ano = data.getFullYear();
    return `${dia}/${mes}/${ano}`;
}

addBtn.addEventListener('click', () => {
    tremForm.style.display = 'flex';
    addBtn.style.display = 'none';
    const hoje = new Date();
    document.getElementsByName('data_operacao').value = hoje.toISOString().split('T')[0];
});

cancelBtn.addEventListener('click', () => {
    tremForm.reset();
    tremForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

removeAllBtn.addEventListener('click', () => {
    if (confirm('Tem certeza que deseja remover TODOS os trens?')) {
        fetch("excluir_todos_trens.php")
            .then(() => {
                location.reload();
            });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    fetch("listar_trens.php")
        .then((response) => response.json())
        .then((data) => {
            cardsContainer.innerHTML = '';

            if (data.length === 0) {
                cardsContainer.innerHTML = `
            <div class="empty-state">
                <i class="bi bi-train-front"></i>
                <h3>Nenhum trem cadastrado</h3>
                <p>Clique em "Adicionar Trem" para cadastrar um novo trem</p>
            </div>`;
                return;
            }
            data.forEach(trem => {
                const card = document.createElement('div');
                card.className = 'card';
                card.innerHTML = `
            <div class="card-title">${trem.nome_trem}</div>
            <div class="card-text">
                <p><strong>Data de Operação:</strong> ${trem.data_operacao}</p>
                <p><strong>Capacidade de Passageiros:</strong> ${trem.capacidade_trem}</p>
                <p><strong>Velocidade Máxima:</strong> ${trem.velocidade_trem} km/h</p>
                <p><strong>Fabricante:</strong> ${trem.fabricante_trem}</p>
                <p><strong>Observações:</strong> ${trem.observacoes_trem}</p>
            </div>
            <button class="delete-btn" onclick="removerTrem(${trem.pk_trem})">
                <i class="bi bi-trash"></i>
            </button>`;
                cardsContainer.appendChild(card);
            });
        })
        .catch((error) => console.error("Erro ao buscar itens:", error));
});

function removerTrem(id) {
    if (confirm('Tem certeza que deseja remover este trem?')) {
        fetch("excluir_trem.php?id=" + encodeURIComponent(id))
            .then(() => {
                location.reload();
            });
    }
}

window.removerTrem = removerTrem;


menuToggle.addEventListener('click', () => {
    sideMenu.classList.toggle('active');
    mainContent.classList.toggle('side-menu-active');
});
document.addEventListener('click', (e) => {
    if (!sideMenu.contains(e.target) && !menuToggle.contains(e.target)) {
        sideMenu.classList.remove('active');
        mainContent.classList.remove('side-menu-active');
    }
});


const hoje = new Date();
const dataFormatada = formatarData(hoje.toISOString());
