<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title>MQTT Dashboard PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .topic {
            margin-bottom: 20px;
        }
        .topic h2 {
            margin: 0;
        }
        .topic p {
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
    <script>
        function set_Messages() {
            fetch('get_messages.php')
                .then(response => response.json())
                .then(data => {
                    console.log("Mensagens recebidas:", data);

                    for (let topic in data) {
                        let message = data[topic];
                        let topicElement = document.getElementById(topic);
                        
                        if (topicElement) {
                            topicElement.textContent = message.trim();
                        } else {
                            let newTopicElement = document.createElement('div');
                            newTopicElement.classList.add('topic');
                            newTopicElement.id = topic;
                            newTopicElement.innerHTML = `<h2>${topic}</h2><p>${message.trim()}</p>`;
                            document.body.appendChild(newTopicElement);
                        }
                    }
                })
                .catch(err => console.error('Erro ao receber as mensagens:', err));
        }

        setInterval(set_Messages, 1000);
    </script>
</head>

<body>
    <h1>Dashboard MQTT</h1>
    <p>Abaixo estão as mensagens recebidas dos tópicos MQTT:</p>
</body>

</html>