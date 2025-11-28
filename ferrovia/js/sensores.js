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
    document.getElementsByName('data_instalacao').value = hoje.toISOString().split('T')[0];
});

cancelBtn.addEventListener('click', () => {
    sensorForm.reset();
    sensorForm.style.display = 'none';
    addBtn.style.display = 'flex';
});

removeAllBtn.addEventListener('click', () => {
    if (confirm('Tem certeza que deseja remover TODOS os sensores?')) {
        fetch("excluir_todos_sensores.php")
            .then(() => {
                location.reload();
            });
    }
});


document.addEventListener("DOMContentLoaded", function () {
    fetch("listar_sensores.php")
        .then((response) => response.json())
        .then((data) => {
            cardsContainer.innerHTML = '';

            if (data.length === 0) {
                cardsContainer.innerHTML = `
            <div class="empty-state">
                <i class="bi bi-cpu"></i>
                <h3>Nenhum sensor cadastrado</h3>
                <p>Clique em "Adicionar Sensor" para cadastrar um novo sensor</p>
            </div>
        `;
                return;
            }

            data.forEach(sensor => {
                const card = document.createElement('div');
                card.className = 'card';
                card.innerHTML = `
            <div class="card-title">${sensor.tipo_sensor}</div>
            <div class="card-text">
                <p><strong>Localização:</strong> ${sensor.localizacao_sensor}</p>
                <p><strong>Status:</strong> ${sensor.status_sensor}</p>
                <p><strong>Data de Instalação:</strong> ${sensor.data_instalacao}</p>
            </div>
            <button class="edit-btn" >
                        <a href="alterar_sensor.php?codigo=${sensor.pk_sensor}" class="bi bi-pencil-square"></a>
                    </button>
            <button class="delete-btn" onclick="removerSensor(${sensor.pk_sensor})">
                <i class="bi bi-trash"></i>
            </button>
        `;
                cardsContainer.appendChild(card);
            });
        })
        .catch((error) => console.error("Erro ao buscar itens:", error));
});

function removerSensor(id) {
    if (confirm('Tem certeza que deseja remover este sensor?')) {
        fetch("excluir_sensor.php?id=" + encodeURIComponent(id))
            .then(() => {
                location.reload();
            });
    }
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