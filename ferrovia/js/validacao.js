function validateCPF(cpf) {
    cpf = cpf.replace(/[^\d]/g,'');
    return cpf.length === 11;
};

function validateForm(event) {
    event.preventDefault();

    const cpf = document.getElementById('cpf').value;
    const senha = document.getElementById('senha').value;
    const confirmar = document.getElementById('confirmar').value;

    let isValid = true;

    if (!validateCPF(cpf)) {
        alert('CPF inválido! Deve conter 11 dígitos.');
        isValid = false;
    } else {
        if((senha)!= (confirmar)) {
            alert('As senhas informadas são diferentes!')
            isValid = false;
        } else {
            window.location.href = "../html/login.html";
        }        
    }
};


function logar() {
    event.preventDefault();
    window.location.href = "../html/dashboard.html"; 
};

function criarConta() {
    event.preventDefault();
    window.location.href = "../html/login.html"; 
};