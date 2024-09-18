<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnFy</title>
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
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
<!-- provelmente uma tela muito desnecessaria, pode tirar!-->
<!-- provelmente uma tela muito desnecessaria, pode tirar!-->
<!-- provelmente uma tela muito desnecessaria, pode tirar!-->
<!-- provelmente uma tela muito desnecessaria, pode tirar!-->
        <main class="main-content">
            <div class="search-bar">
                <input type="text" placeholder="Search..." class="search-input">
            </div>

            <div class="cards-container" id="cards-container">
                <!-- Loop pelos cards que vieram do banco -->
                @foreach($cards as $card)
                    <div class="card">
                        <h3>{{ $card->question }}</h3>
                        <p>{{ $card->awnser }}</p>
                    </div>
                @endforeach
            </div>

            <button class="add-card-btn" onclick="addNewCard()">+</button>
        </main>
    </div>

    <script>
        function addNewCard() {
            const pergunta = prompt("Digite a pergunta:");
            if (!pergunta) return;  // Verifica se a pergunta foi preenchida

            const resposta = prompt("Digite a resposta:");
            if (!resposta) return;  // Verifica se a resposta foi preenchida

            // Enviar dados para o backend
            fetch('/cards', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    question: pergunta,
                    awnser: resposta
                })
            })
            .then(response => response.json())
            .then(data => {
                // Após a criação do card, adicioná-lo dinamicamente no frontend
                const newCard = document.createElement('div');
                newCard.classList.add('card');
                newCard.innerHTML = `<h3>${data.question}</h3><p>${data.awnser}</p>`;

                const cardsContainer = document.getElementById('cards-container');
                cardsContainer.appendChild(newCard);
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
