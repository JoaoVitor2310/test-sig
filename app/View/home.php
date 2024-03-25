<?php
include 'app\utils\protect.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./app/View/styles/home-style.css">

</head>

<body>
    <div id="nav-bar">
        <a href="?page=home">
            Home
        </a>
        <a href="app\utils\logout.php">
            Logout
        </a>
        <h5>Existem mais personagens a serem mostrados de outras páginas, a páginação será desenvolvida</h5>
    </div>

    <div id="searchBar">
        <!-- <input type="text" placeholder="Pesquisar"> -->
        <form id="searchForm">
            <label><input type="radio" name="searchType" value="name"> Nome</label>
            <label><input type="radio" name="searchType" value="status"> Status</label>
            <label><input type="radio" name="searchType" value="species"> Espécie</label>
            <label><input type="radio" name="searchType" value="type"> Tipo</label>
            <label><input type="radio" name="searchType" value="gender"> Gênero</label>
            <input hidden type="text" id="searchInput" placeholder="Pesquisar...">
            <button  type="button" onclick="search()">Pesquisar</button>
        </form>
    </div>

    <div id="content">
        <!-- Exemplo -->
        <!-- <article>
            <a href="">
                <header>
                    <h2 id="characterTitle">Character Title</h2>
                </header>
                <p>Character details</p>
            </a>
        </article> -->

    </div>
</body>

<script>

    const getCharacters = async () => {
        const response = await fetch('https://rickandmortyapi.com/api/character', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const data = await response.json();
        console.log(data);
        const { results, info } = data;

        const contentDiv = document.getElementById('content');

        results.forEach((character, index) => {
            const article = document.createElement('article');
            const link = document.createElement('a');
            const header = document.createElement('header');
            const h2 = document.createElement('h2');
            const p = document.createElement('p');

            h2.textContent = character.name;
            header.appendChild(h2);
            article.appendChild(header);
            article.appendChild(p);
            link.appendChild(article); // Colocar o article dentro do link
            contentDiv.appendChild(link);

            link.setAttribute('href', '?page=card&character=' + character.id);
            p.innerHTML = `<img src="${character.image}" alt="${character.name} image"><br>Gender: ${character.gender}<br>Origin: ${character.origin.name}<br>Status: ${character.status}`;
        });
    }
    getCharacters();

    function search() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const searchTypeInputs = document.querySelectorAll('input[name="searchType"]:checked');
        const searchTypes = Array.from(searchTypeInputs).map(input => input.value);

        const articles = document.querySelectorAll('#content article');

        articles.forEach(article => {
            const characterName = article.querySelector('h2').textContent.toLowerCase();
            const characterDetails = article.querySelector('p').textContent.toLowerCase();

            const matchesSearchType = searchTypes.some(type => {
                if (type === 'name' && characterName.includes(searchTerm)) {
                    return true;
                }
                if (type === 'status' && characterDetails.includes('status: ' + searchTerm)) {
                    return true;
                }
                if (type === 'species' && characterDetails.includes('espécie: ' + searchTerm)) {
                    return true;
                }
                if (type === 'type' && characterDetails.includes('tipo: ' + searchTerm)) {
                    return true;
                }
                if (type === 'gender' && characterDetails.includes('gênero: ' + searchTerm)) {
                    return true;
                }
                return false;
            });

            if (matchesSearchType) {
                article.style.display = 'block';
            } else {
                article.style.display = 'none';
            }
        });
    }

</script>


</html>