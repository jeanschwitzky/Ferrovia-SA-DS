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
    document.getElementById('dataOperacao').value = hoje.toISOString().split('T')[0];
});

cancelBtn.addEventListener('click', () => {
    tremForm.reset();
    tremForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

removeAllBtn.addEventListener('click', () => {
    if (confirm('Tem certeza que deseja remover TODOS os trens?')) {
        trens.length = 0;
        renderizarTrens();
    }
});

tremForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const novoTrem = {
        id: Date.now(),
        nome: document.getElementById('nomeTrem').value,
        rota: document.getElementById('rotaTrem').value,
        status: document.getElementById('statusTrem').value,
        data: formatarData(document.getElementById('dataOperacao').value)
    };
    trens.unshift(novoTrem);
    renderizarTrens();
    tremForm.reset();
    tremForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

function removerTrem(id) {
    if (confirm('Tem certeza que deseja remover este trem?')) {
        const idx = trens.findIndex(t => t.id === id);
        if (idx > -1) trens.splice(idx, 1);
        renderizarTrens();
    }
}

function renderizarTrens() {
    cardsContainer.innerHTML = '';
    if (trens.length === 0) {
        cardsContainer.innerHTML = `
            <div class="empty-state">
                <i class="bi bi-train-front"></i>
                <h3>Nenhum trem cadastrado</h3>
                <p>Clique em "Adicionar Trem" para cadastrar um novo trem</p>
            </div>
        `;
        return;
    }
    trens.forEach(trem => {
        const card = document.createElement('div');
        card.className = 'card';
        card.innerHTML = `
            <div class="card-title">${trem.nome}</div>
            <div class="card-text">
                <p><strong>Rota:</strong> ${trem.rota}</p>
                <p><strong>Status:</strong> ${trem.status}</p>
                <p><strong>Data de Operação:</strong> ${trem.data}</p>
            </div>
            <button class="delete-btn" onclick="removerTrem(${trem.id})">
                <i class="bi bi-trash"></i>
            </button>
        `;
        cardsContainer.appendChild(card);
    });
}

// Expor função para botão
window.removerTrem = removerTrem;

// Menu lateral
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

// Trens iniciais
const hoje = new Date();
const dataFormatada = formatarData(hoje.toISOString());
trens.push(
    {
        id: 1,
        nome: "Trem Expresso",
        rota: "Linha Norte",
        status: "Em operação",
        data: dataFormatada
    },
    {
        id: 2,
        nome: "Trem Regional",
        rota: "Linha Sul",
        status: "Manutenção",
        data: dataFormatada
    }
);
renderizarTrens();