window.onload = function () {
    const ctx = document.getElementById('graficoTarefas').getContext('2d');
    const graficoTarefas = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Concluídas', 'Em Andamento', 'Não Iniciadas'],
            datasets: [{
                data: [3, 1, 2],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
};
