<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnFy</title>
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
    <style>
        /* Estilos básicos para o layout */
        .container {
            display: flex;
        }

        .sidebar {
            background-color: #2c2f33;
            color: #fff;
            padding: 20px;
            width: 250px;
            height: 100vh;
        }

        .sidebar .logo {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 10px;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background-color: #3b5998;
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 200px;
            text-align: center;
        }

        .add-card-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 2rem;
            cursor: pointer;
        }

        /* Modal estilos */
        .modal {
            display: none; /* Escondido por padrão */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 400px;
            border-radius: 10px;
        }

        .modal-header {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-save {
            background-color: #4CAF50;
            color: white;
        }

        .btn-cancel {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2 class="logo">LearnFy</h2>
            <nav>
                <ul>
                    <li><a href="#">New cards</a></li>
                    <li><a href="#">Study</a></li>
                    <li><a href="#">Estatísticas</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="search-bar">
                <input type="text" placeholder="Search..." class="search-input">
            </div>

            <div class="cards-container" id="cards-container">
                <!-- Verifica se há cards disponíveis -->
                @if($cards->isEmpty())
                    <p class="no-cards-message">Nenhum card disponível no momento. Adicione um novo card usando o botão abaixo.</p>
                @else
                    <!-- Loop pelos cards que vieram do banco -->
                    @foreach($cards as $card)
                        <div class="card">
                            <h3>{{ $card->question }}</h3>
                            <p>{{ $card->awnser }}</p>
                        </div>
                    @endforeach
                @endif
            </div>

            <button class="add-card-btn" onclick="openModal()">+</button>
        </main>
    </div>

    <!-- Modal para adicionar novo card -->
    <div id="addCardModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="modal-header">
                Adicionar Novo Card
            </div>
            <input type="text" id="question" placeholder="Digite a pergunta" required>
            <textarea id="awnser" placeholder="Digite a resposta" rows="4" required></textarea>
            <div class="modal-footer">
                <button class="btn-save" onclick="saveCard()">Salvar</button>
                <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
            </div>
        </div>
    </div>

    <script>
        // Função para abrir o modal
        function openModal() {
            document.getElementById('addCardModal').style.display = 'block';
        }

        // Função para fechar o modal
        function closeModal() {
            document.getElementById('addCardModal').style.display = 'none';
        }

        // Função para salvar o novo card
        function saveCard() {
            const question = document.getElementById('question').value;
            const awnser = document.getElementById('awnser').value;

            if (!question || !awnser) {
                alert('Por favor, preencha ambos os campos.');
                return;
            }

            // Enviar dados para o backend
            fetch('/cards', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    question: question,
                    awnser: awnser
                })
            })
            .then(response => response.json())
            .then(data => {
                // Após a criação do card, adicioná-lo dinamicamente no frontend
                const newCard = document.createElement('div');
                newCard.classList.add('card');
                newCard.innerHTML = `<h3>${data.question}</h3><p>${data.awnser}</p>`;

                const cardsContainer = document.getElementById('cards-container');

                // Remover mensagem "Nenhum card disponível" se houver
                const noCardsMessage = document.querySelector('.no-cards-message');
                if (noCardsMessage) {
                    noCardsMessage.remove();
                }

                // Adicionar o novo card ao container
                cardsContainer.appendChild(newCard);

                // Limpar os valores dos campos do modal
                document.getElementById('question').value = '';
                document.getElementById('awnser').value = '';

                // Fechar o modal após adicionar
                closeModal();
            })
            .catch(error => console.error('Error:', error));

            // Fechar o modal após adicionar
            document.getElementById('addCardModal').style.display = 'none';
        }
    </script>
</body>
</html>
