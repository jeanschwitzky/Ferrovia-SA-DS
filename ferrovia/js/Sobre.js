// ...existing code...
document.addEventListener('DOMContentLoaded', () => {
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

    // Eventos de notificação (verifica existência dos elementos)
    if (addBtn) {
        addBtn.addEventListener('click', () => {
            if (notificacaoForm) notificacaoForm.style.display = 'block';
            addBtn.style.display = 'none';

            const hoje = new Date();
            const dataInput = document.getElementsByName('data_notificacao')[0];
            if (dataInput) dataInput.value = hoje.toISOString().split('T')[0];

            const agora = new Date();
            const horas = String(agora.getHours()).padStart(2, '0');
            const minutos = String(agora.getMinutes()).padStart(2, '0');
            const horaInput = document.getElementsByName('hora_notificacao')[0];
            if (horaInput) horaInput.value = `${horas}:${minutos}`;
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (notificacaoForm) {
                notificacaoForm.reset();
                notificacaoForm.style.display = 'none';
            }
            if (addBtn) addBtn.style.display = 'flex';
        });
    }

    if (removeAllBtn) {
        removeAllBtn.addEventListener('click', () => {
            if (confirm('Tem certeza que deseja remover TODAS as notificações?')) {
                fetch("excluir_todas_notificacoes.php")
                    .then(() => { location.reload(); })
                    .catch(err => console.error(err));
            }
        });
    }

    // Busca notificações (só se existir o container)
    if (cardsContainer) {
        fetch("listar_notificacoes.php")
            .then((response) => response.json())
            .then((data) => {
                cardsContainer.innerHTML = '';

                if (!Array.isArray(data) || data.length === 0) {
                    cardsContainer.innerHTML = `
                        <div class="empty-state">
                            <i class="bi bi-bell"></i>
                            <h3>Nenhuma notificação encontrada</h3>
                            <p>Clique em "Adicionar" para criar uma nova notificação</p>
                        </div>
                    `;
                    return;
                }

                data.forEach(notificacao => {
                    const card = document.createElement('div');
                    card.className = 'card';
                    card.innerHTML = `
                        <div class="card-title">${notificacao.nome_notificacao}</div>
                        <div class="card-text"> 
                            <p><strong>Localização:</strong> ${notificacao.localizacao_notificacao}</p>
                            <p><strong>Problema:</strong> ${notificacao.problema_notificacao}</p>
                            <p><strong>Dia:</strong> ${notificacao.data_notificacao}</p>
                            <p class="horario"><strong>Horário:</strong> ${notificacao.hora_notificacao}</p>
                        </div>
                        <button class="edit-btn" >
                            <a href="alterar_notificacoes.php?codigo=${notificacao.pk_notificacao}" class="bi bi-pencil-square"></a>
                        </button>
                        <button class="delete-btn" onclick="removerNotificacao(${notificacao.pk_notificacao})">
                            <i class="bi bi-trash"></i>
                        </button>
                    `;
                    cardsContainer.appendChild(card);
                });
            })
            .catch((error) => console.error("Erro ao buscar itens:", error));
    }

    // Função global para remover (mantém compatibilidade com onclick inline do template)
    window.removerNotificacao = function (id) {
        if (confirm('Tem certeza que deseja remover esta notificação?')) {
            fetch("excluir_notificacoes.php?id=" + encodeURIComponent(id))
                .then(() => { location.reload(); })
                .catch(err => console.error(err));
        }
    };

    // Menu lateral — sempre registra apenas se elementos existirem
    if (menuToggle && sideMenu) {
        menuToggle.style.cursor = 'pointer';
        menuToggle.setAttribute('role', 'button');
        if (!menuToggle.hasAttribute('aria-expanded')) menuToggle.setAttribute('aria-expanded', 'false');

        menuToggle.addEventListener('click', () => {
            sideMenu.classList.toggle('active');
            if (mainContent) mainContent.classList.toggle('side-menu-active');
            const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', String(!expanded));
        });

        document.addEventListener('click', (e) => {
            if (!sideMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                sideMenu.classList.remove('active');
                if (mainContent) mainContent.classList.remove('side-menu-active');
                if (menuToggle) menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
});