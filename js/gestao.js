const notificacoes = [];

const cardsContainer = document.getElementById('cardsContainer');
const notificacaoForm = document.getElementById('notificacaoForm');
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
    notificacaoForm.style.display = 'block';
    addBtn.style.display = 'none';

    const hoje = new Date();
    document.getElementById('dataNotificacao').value = hoje.toISOString().split('T')[0];

    const agora = new Date();
    const horas = String(agora.getHours()).padStart(2, '0');
    const minutos = String(agora.getMinutes()).padStart(2, '0');
    document.getElementById('horaNotificacao').value = `${horas}:${minutos}`;
});

cancelBtn.addEventListener('click', () => {
    notificacaoForm.reset();
    notificacaoForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

removeAllBtn.addEventListener('click', () => {
    if (confirm('Tem certeza que deseja remover TODAS as rotas?')) {
        notificacoes.length = 0;
        renderizarNotificacoes();
    }
});

notificacaoForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const novaNotificacao = {
        id: Date.now(),
        tipo: document.getElementById('tipoNotificacao').value,
        trem: document.getElementById('tremNotificacao').value,
        localizacao: document.getElementById('localizacaoNotificacao').value,
        problema: document.getElementById('problemaNotificacao').value,
        data: formatarData(document.getElementById('dataNotificacao').value),
        hora: document.getElementById('horaNotificacao').value
    };

    notificacoes.unshift(novaNotificacao);
    renderizarNotificacoes();

    notificacaoForm.reset();
    notificacaoForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

function removerNotificacao(id) {
    if (confirm('Tem certeza que deseja remover esta rota?')) {
        const index = notificacoes.findIndex(notif => notif.id === id);
        if (index !== -1) {
            notificacoes.splice(index, 1);
            renderizarNotificacoes();
        }
    }
}

function renderizarNotificacoes() {
    cardsContainer.innerHTML = '';

    if (notificacoes.length === 0) {
        cardsContainer.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-sign-turn-slight-right"></i>
                        <h3>Nenhuma rota encontrada</h3>
                        <p>Clique em "Adicionar" para criar uma nova rota</p>
                    </div>
                `;
        return;
    }

    notificacoes.forEach(notificacao => {
        const card = document.createElement('div');
        card.className = 'card';
        card.innerHTML = `
                    <div class="card-title">${notificacao.tipo}</div>
                    <div class="card-text">
                        <p><strong>Status</strong> ${notificacao.trem}</p>
                        <p><strong>Local de Partida:</strong> ${notificacao.localizacao}</p>
                        <p><strong>Local de Chegada:</strong> ${notificacao.problema}</p>
                        <p><strong>Dia:</strong> ${notificacao.data}</p>
                        <p class="horario"><strong>Horário:</strong> ${notificacao.hora}</p>
                    </div>
                    <button class="delete-btn" onclick="removerNotificacao(${notificacao.id})">
                        <i class="bi bi-trash"></i>
                    </button>
                `;
        cardsContainer.appendChild(card);
    });
}

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
const horas = String(hoje.getHours()).padStart(2, '0');
const minutos = String(hoje.getMinutes()).padStart(2, '0');

notificacoes.push(
    {
        id: 1,
        tipo: "Linha Sul - Rota A1",
        trem: "Em andamento",
        localizacao: "Joinville",
        problema: "Curitiba",
        data: dataFormatada,
        hora: "08:20"
    },
    {
        id: 2,
        tipo: "Linha Sul - Rota B2",
        trem: "Atrasada",
        localizacao: "Itajai",
        problema: "Joinville",
        data: dataFormatada,
        hora: `${horas}:${minutos}`
    },
    {
        id: 3,
        tipo: "Lista Leste - Rota C3",
        trem: "Atrasada",
        localizacao: "Blumenau",
        problema: "Florianópolis",
        data: dataFormatada,
        hora: "12:00"
    }
);

renderizarNotificacoes();