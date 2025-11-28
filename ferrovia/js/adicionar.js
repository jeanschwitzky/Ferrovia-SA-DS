const addBtn = document.getElementById('addBtn');
const cancelBtn = document.getElementById('cancelBtn');
const personForm = document.getElementById('personForm');
const cardsContainer = document.getElementById('cardsContainer');
const counter = document.getElementById('counter');

let people = [];

addBtn.addEventListener('click', () => {
    formModal.style.display = 'flex';
    personForm.reset();
});

cancelBtn.addEventListener('click', () => {
    formModal.style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target === formModal) {
        formModal.style.display = 'none';
    }
});

personForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const nomeNotificacao = document.getElementById('nomeNotificacao').value.trim();
    const tremNotificacao = document.getElementById('tremNotificacao').value.trim();
    const ocorridoNotificacao = document.getElementById('ocorridoNotificacao').value;
    const ondeNotificacao = document.getElementById('ondeNotificacao').value;
    const quandoNotificao = document.getElementById('quandoNotificao').value;

    const person = {
        id: Date.now(),
        nomeNotificacao,
        tremNotificacao,
        ocorridoNotificacao,
        ondeNotificacao,
        quandoNotificao
    };

    people.push(person);
    updateUI();
    formModal.style.display = 'none';
});

function updateUI() {
    cardsContainer.innerHTML = '';

    if (people.length === 0) {
        cardsContainer.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-user-friends"></i>
                <h3>Nenhuma pessoa cadastrada</h3>
                <p>Clique em "Adicionar Pessoa" para criar seu primeiro registro</p>
            </div>
        `;
    } else {
        people.forEach(person => {
            const card = document.createElement('div');
            card.classList.add('card');
            card.innerHTML = `
                <div class="card-header">
                    <div class="name">${person.firstName} ${person.lastName}</div>
                    <button class="delete-btn" onclick="deletePerson(${person.id})">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                <div class="card-content">
                    <p><strong>Data de Nascimento:</strong> ${person.birthDate}</p>
                    <p><strong>Cargo:</strong> ${person.position}</p>
                </div>
            `;
            cardsContainer.appendChild(card);
        });
    }

    counter.textContent = people.length;
}

function deletePerson(id) {
    people = people.filter(person => person.id !== id);
    updateUI();
}