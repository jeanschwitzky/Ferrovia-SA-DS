window.onload = function () {
    const ctxSatisfacao = document.getElementById('graficoTarefas').getContext('2d');
    const graficoSatisfacao = new Chart(ctxSatisfacao, {
        type: 'pie',
        data: {
            labels: ['Satisfeito', 'Neutro', 'Insatisfeito'],
            datasets: [{
                data: [3, 1, 2],
                backgroundColor: [
                    'rgba(89, 192, 75, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(189, 35, 35, 0.79)'
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
                },
                title: {
                    display: true,
                    text: 'Nível de Satisfação',
                    font: {
                        size: 18
                    }
                }
            }
        }
    });

    const ctxFaturamento = document.getElementById('graficoVendas').getContext('2d');
    const graficoFaturamento = new Chart(ctxFaturamento, {
        type: 'bar',
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
            datasets: [{
                label: 'Faturamento (R$)',
                data: [25000, 32000, 18000, 40000, 35000, 28000],
                backgroundColor: 'rgba(24, 135, 179, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Valor (R$)'
                    },
                    ticks: {
                        callback: function (value, index, values) {
                            return 'R$ ' + value.toLocaleString('pt-BR');
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Mês'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Faturamento Mensal da Ferrovia',
                    font: {
                        size: 18
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += 'R$ ' + context.parsed.y.toLocaleString('pt-BR');
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
    const ctxManutencao = document.getElementById('graficoManutencao').getContext('2d');
    const graficoManutencao = new Chart(ctxManutencao, {
        type: 'line',
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
            datasets: [{
                label: 'Incidentes de Manutenção',
                data: [18, 8, 3, 9, 4, 2],
                fill: false,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderWidth: 2,
                tension: 0.3,
                pointRadius: 5,
                pointHoverRadius: 7
            },
            {
                label: 'Reparos Realizados',
                data: [4, 15, 3, 13, 4, 9],
                fill: false,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderWidth: 2,
                tension: 0.3,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    min: 0,
                    max: 20,
                    title: {
                        display: true,
                        text: 'Número de Ocorrências'
                    },
                    ticks: {
                        callback: function (value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Mês'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Relatório de Manutenção da Ferrovia',
                    font: {
                        size: 18
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y + ' ocorrências';
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
    const ctxNotificacoes = document.getElementById('graficoNotificacoes').getContext('2d');
    const graficoNotificacoes = new Chart(ctxNotificacoes, {
        type: 'bar',
        data: {
            labels: ['Novas', 'Lidas', 'Arquivadas', 'Importantes'],
            datasets: [{
                label: 'Quantidade de Notificações',
                data: [15, 45, 20, 8],
                backgroundColor: [
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Número de Notificações'
                    },
                    ticks: {
                        callback: function (value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tipo de Notificação'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Status das Notificações',
                    font: {
                        size: 18
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y;
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
};