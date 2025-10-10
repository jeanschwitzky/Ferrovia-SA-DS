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

    document.getElementsByName('data_inicio_manutencao').value = hojeISO;
    document.getElementsByName('data_termino_manutencao').value = hojeISO;
});

cancelBtn.addEventListener('click', () => {
    notificacaoForm.reset();
    notificacaoForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

removeAllBtn.addEventListener('click', () => {
    if (confirm('Tem certeza que deseja remover TODAS as manutencoes?')) {
        fetch("excluir_todas_manutencoes.php")
            .then(() => {
                location.reload();
            });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    fetch("listar_manutencao.php")
        .then((response) => response.json())
        .then((data) => {
            cardsContainer.innerHTML = '';

            if (data.length === 0) {
                cardsContainer.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-gear"></i>
                        <h3>Nenhuma manutenção encontrada</h3>
                        <p>Clique em "Adicionar" para criar uma manutenção</p>
                    </div>
                `;
                atualizarGrafico([]);
                return;
            }

            data.forEach(manutencao => {
                const card = document.createElement('div');
                card.className = 'card';
                switch (manutencao.status_manutencao) {
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
                    <div class="card-title">${manutencao.nome_trem}</div>
                    <div class="card-text">
                        <p><strong>Manutenção:</strong> ${manutencao.problema_manutencao}</p>
                        <p><strong>Data de Início:</strong> ${manutencao.data_inicio_manutencao}</p>
                        <p><strong>Data de Término:</strong> ${manutencao.data_termino_manutencao}</p>
                        <p><strong>Status:</strong> ${manutencao.status_manutencao}</p>
                    </div>
                    <button class="delete-btn" onclick="removerManutencao(${manutencao.pk_manutencao})">
                        <i class="bi bi-trash"></i>
                    </button>`;
                cardsContainer.appendChild(card);
            });
            atualizarGrafico(data);
        })
        .catch((error) => console.error("JSON:", error));
});

function removerManutencao(id) {
    if (confirm('Tem certeza que deseja remover esta manutencao?')) {
        fetch("excluir_manutencoes.php?id=" + encodeURIComponent(id))
            .then(() => {
                location.reload();
            });
    }
}

let graficoStatus;

function atualizarGrafico(manutencoes) {
    const contagemStatus = {
        "Concluída": 0,
        "Em Andamento": 0,
        "Não Iniciada": 0,
        "Em atraso": 0
    };

    (manutencoes || []).forEach(m => {
        if (contagemStatus.hasOwnProperty(m.status_manutencao)) {
            contagemStatus[m.status_manutencao]++;
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

