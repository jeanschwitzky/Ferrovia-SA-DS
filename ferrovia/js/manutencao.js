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
    const hojeISO = hoje.toISOString().split('T')[0];

    document.getElementById('dataInicio').value = hojeISO;
    document.getElementById('dataTermino').value = hojeISO;
});

cancelBtn.addEventListener('click', () => {
    notificacaoForm.reset();
    notificacaoForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

removeAllBtn.addEventListener('click', () => {
    if (confirm('Tem certeza que deseja remover TODAS as manutencao?')) {
        notificacoes.length = 0;
        renderizarNotificacoes();
    }
});

notificacaoForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const novaNotificacao = {
        id: Date.now(),
        nomeTrem: document.getElementById('nomeTrem').value,
        problema: document.getElementById('problema').value,
        dataInicio: formatarData(document.getElementById('dataInicio').value),
        dataTermino: formatarData(document.getElementById('dataTermino').value),
        status: document.getElementById('statusTrem').value
    };

    notificacoes.unshift(novaNotificacao);
    renderizarNotificacoes();

    notificacaoForm.reset();
    notificacaoForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

function removerNotificacao(id) {
    if (confirm('Tem certeza que deseja remover esta manutenção?')) {
        const index = notificacoes.findIndex(notif => notif.id === id);
        if (index !== -1) {
            notificacoes.splice(index, 1);
            renderizarNotificacoes();
        }
    }
}

let graficoStatus;

function atualizarGrafico() {
    const contagemStatus = {
        "Concluída": 0,
        "Em Andamento": 0,
        "Não Iniciada": 0,
        "Em atraso": 0
    };

    notificacoes.forEach(n => {
        if (contagemStatus.hasOwnProperty(n.status)) {
            contagemStatus[n.status]++;
        }
    });

    const ctx = document.getElementById('graficoStatus').getContext('2d');

    if (graficoStatus) {
        graficoStatus.destroy();
    }

    graficoStatus = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: Object.keys(contagemStatus),
            datasets: [{
                label: 'Qtd. por Status',
                data: Object.values(contagemStatus),
                backgroundColor: [
                    'green',
                    'orange',
                    'gray',
                    'red'
                ]
            }]
        },
        radius: '80%',
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
}

function renderizarNotificacoes() {
    cardsContainer.innerHTML = '';

    if (notificacoes.length === 0) {
        cardsContainer.innerHTML = `
            <div class="empty-state">
                <i class="bi bi-gear"></i>
                <h3>Nenhuma manutenção encontrada</h3>
                <p>Clique em "Adicionar" para criar uma manutenção</p>
            </div>
        `;
        atualizarGrafico();
        return;
    }

    notificacoes.forEach(notificacao => {
        const card = document.createElement('div');
        card.className = 'card';

        switch (notificacao.status) {
            case "Concluída":
                card.style.borderLeft = "5px solid green";
                break;
            case "Em atraso":
                card.style.borderLeft = "5px solid red";
                break;
            case "Em Andamento":
                card.style.borderLeft = "5px solid orange";
                break;
            case "Não Iniciada":
                card.style.borderLeft = "5px solid gray";
                break;
            default:
                card.style.borderLeft = "5px solid black";
        }

        card.innerHTML = `
            <div class="card-title">${notificacao.nomeTrem}</div>
            <div class="card-text">
                <p><strong>Manutenção:</strong> ${notificacao.problema}</p>
                <p><strong>Data de Início:</strong> ${notificacao.dataInicio}</p>
                <p><strong>Data de Término:</strong> ${notificacao.dataTermino}</p>
                <p><strong>Status:</strong> ${notificacao.status}</p>
            </div>
            <button class="delete-btn" onclick="removerNotificacao(${notificacao.id})">
                <i class="bi bi-trash"></i>
            </button>
        `;
        cardsContainer.appendChild(card);
    });

    atualizarGrafico();
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

notificacoes.push(
    {
        id: 1,
        nomeTrem: "Trem 001",
        problema: "Limpeza no motor",
        dataInicio: dataFormatada,
        dataTermino: dataFormatada,
        status: "Em Andamento"
    },
    {
        id: 2,
        nomeTrem: "Trem 002",
        problema: "Troca dos Bicos do Motor",
        dataInicio: dataFormatada,
        dataTermino: dataFormatada,
        status: "Em atraso"
    },
    {
        id: 3,
        nomeTrem: "Trem 003",
        problema: "Troca de Óleo",
        dataInicio: dataFormatada,
        dataTermino: dataFormatada,
        status: "Concluída"
    }
);

document.addEventListener("DOMContentLoaded", () => {
    renderizarNotificacoes();
});