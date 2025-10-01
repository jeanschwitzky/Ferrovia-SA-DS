const sensores = [];

const cardsContainer = document.getElementById('cardsContainer');
const sensorForm = document.getElementById('sensorForm');
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
    sensorForm.style.display = 'block';
    addBtn.style.display = 'none';

    const hoje = new Date();
    document.getElementById('dataInstalacao').value = hoje.toISOString().split('T')[0];
});

cancelBtn.addEventListener('click', () => {
    sensorForm.reset();
    sensorForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

removeAllBtn.addEventListener('click', () => {
    if (confirm('Tem certeza que deseja remover TODOS os sensores?')) {
        sensores.length = 0;
        renderizarSensores();
    }
});

sensorForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const novoSensor = {
        id: Date.now(),
        tipo: document.getElementById('tipoSensor').value,
        localizacao: document.getElementById('localizacaoSensor').value,
        status: document.getElementById('statusSensor').value,
        data: formatarData(document.getElementById('dataInstalacao').value)
    };

    sensores.unshift(novoSensor);
    renderizarSensores();

    sensorForm.reset();
    sensorForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

function removerSensor(id) {
    if (confirm('Tem certeza que deseja remover este sensor?')) {
        const index = sensores.findIndex(sensor => sensor.id === id);
        if (index !== -1) {
            sensores.splice(index, 1);
            renderizarSensores();
        }
    }
}

function renderizarSensores() {
    cardsContainer.innerHTML = '';

    if (sensores.length === 0) {
        cardsContainer.innerHTML = `
            <div class="empty-state">
                <i class="bi bi-cpu"></i>
                <h3>Nenhum sensor cadastrado</h3>
                <p>Clique em "Adicionar Sensor" para cadastrar um novo sensor</p>
            </div>
        `;
        return;
    }

    sensores.forEach(sensor => {
        const card = document.createElement('div');
        card.className = 'card';
        card.innerHTML = `
            <div class="card-title">${sensor.tipo}</div>
            <div class="card-text">
                <p><strong>Localização:</strong> ${sensor.localizacao}</p>
                <p><strong>Status:</strong> ${sensor.status}</p>
                <p><strong>Data de Instalação:</strong> ${sensor.data}</p>
            </div>
            <button class="delete-btn" onclick="removerSensor(${sensor.id})">
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

// Exemplo de sensores iniciais
const hoje = new Date();
const dataFormatada = formatarData(hoje.toISOString());

sensores.push(
    {
        id: 1,
        tipo: "Temperatura",
        localizacao: "Estação Central",
        status: "Ativo",
        data: dataFormatada
    },
    {
        id: 2,
        tipo: "Pressão",
        localizacao: "Linha Norte",
        status: "Manutenção",
        data: dataFormatada
    },
    {
        id: 3,
        tipo: "Vibração",
        localizacao: "Ponte Leste",
        status: "Inativo",
        data: dataFormatada
    }
);

renderizarSensores();