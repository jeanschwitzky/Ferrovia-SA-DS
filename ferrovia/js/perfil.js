const notificacoes = [];

const cardsContainer = document.getElementById('cardsContainer');
const notificacaoForm = document.getElementById('notificacaoForm');
const menuToggle = document.getElementById('menuToggle');
const sideMenu = document.getElementById('side-menu');
const mainContent = document.querySelector('main');

function renderizarNotificacoes() {
    cardsContainer.innerHTML = '';

   
    notificacoes.forEach(notificacao => {
        const card = document.createElement('div');
        card.className = 'card';
        card.innerHTML = `
                    <div class="card-title">${notificacao.tipo}</div>
                     <div class="grafico">
                        <canvas id="${notificacao.problema}"></canvas>
                     </div>
                    </div>                    
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


notificacoes.push(
    {
        id: 1,
        tipo: 'Nível de Satisfação',
        problema: id="graficoTarefas"
        
    },
    {
        id: 2,
        tipo: 'Faturamento',
        problema: id="graficoVendas"
        
    },
    {
        id: 3,
        tipo: 'Manutenção',
        problema: id="graficoManutencao"
        
    },
    {
        id: 4,
        tipo: 'Notificações',
        problema: id="graficoNotificacoes"
        
    },
);

renderizarNotificacoes();