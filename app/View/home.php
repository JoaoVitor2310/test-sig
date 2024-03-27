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
        <span>

            <a href="?page=home">
                Home
            </a>
        </span>
        <span>

            <a href="app\utils\logout.php">
                Logout
            </a>
        </span>
    </div>

    <div id="searchBar">
        <!-- <input type="text" placeholder="Pesquisar"> -->
        <form id="searchForm">
            <h3>Pesquisar: </h3>
            <label>Nome</label>
            <br>
            <input type="text" id="searchName" placeholder="Digite o Nome">
            <br>
            <label>Status: </label>
            <div id="statusOptions">
                <label><input type="radio" name="status" value="alive"> Vivo</label>
                <label><input type="radio" name="status" value="dead"> Morto</label>
                <label><input type="radio" name="status" value="unknown"> Desconhecido</label>
            </div>
            <br>
            <label>Espécie</label>
            <br>
            <input type="text" id="species" placeholder="Digite a Espécie">
            <br>
            <label>Tipo</label>
            <br>
            <input type="text" id="type" placeholder="Digite o Tipo">
            <br>
            <label>Gênero</label>
            <div id="statusOptions">
                <label><input type="radio" name="gender" value="female"> Mulher</label>
                <label><input type="radio" name="gender" value="male"> Homem</label>
                <label><input type="radio" name="gender" value="unknown"> Desconhecido</label>
                <label><input type="radio" name="gender" value="genderless"> Sem gênero</label>
            </div>
            <br>
            <button type="button" onclick="search()">Pesquisar</button>
        </form>

    </div>

    <div id="pagination">
        <span>Página</span>
        <span id="pageNumber">1</span>
        <br>
        <button type="button" onclick="search(-1)"><- Anterior</button>
                <button type="button" onclick="search(+1)">Próxima -></button>
    </div>
    <br>

    <div id="content">
        <!-- Exemplo de como vai ficar-->
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
        const response = await fetch('app/router/CharactersRoutes.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        // const response = await fetch('https://rickandmortyapi.com/api/character', { // Fazer em javascript seria mais direto ao ponto, comento mais sobre isso no README
        //     method: 'GET',
        //     headers: {
        //         'Content-Type': 'application/json'
        //     }
        // });

        const data = await response.json();
        const { results } = data;

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
            p.innerHTML = `<img src="${character.image}" alt="${character.name} image"><br>Gender: ${character.gender}<br>Origin: ${character.origin.name}<br>Status: ${character.status}<br>Type: ${character.type ? character.type : 'Null'}`;
        });
    }

    getCharacters();

    const search = async (page) => {
        const searchName = document.getElementById('searchName').value;
        const species = document.getElementById('species').value;
        const type = document.getElementById('type').value;

        let status = "";
        const statusOptions = document.getElementsByName('status');
        for (let i = 0; i < statusOptions.length; i++) {
            if (statusOptions[i].checked) {
                status = statusOptions[i].value;
                break;
            }
        }

        let gender = "";
        const genderOptions = document.getElementsByName('gender');
        for (let i = 0; i < genderOptions.length; i++) {
            if (genderOptions[i].checked) {
                gender = genderOptions[i].value;
                break;
            }
        }

        const queryParams = [];

        if (searchName) queryParams.push(`name=${searchName}`);
        if (status) queryParams.push(`status=${status}`);
        if (species) queryParams.push(`species=${species}`);
        if (type) queryParams.push(`type=${type}`);
        if (gender) queryParams.push(`gender=${gender}`);

        let pageNumber = document.getElementById('pageNumber').textContent;


        let baseUrl = "https://rickandmortyapi.com/api/character?";

        if (!page) {
            baseUrl = "https://rickandmortyapi.com/api/character?" + queryParams.join('&');
        } else {
            pageNumber = parseInt(pageNumber);
            pageNumber += page;
            pageNumber <= 0 ? pageNumber = 1 : pageNumber;

            let pageNumberHTML = document.getElementById('pageNumber');
            pageNumberHTML.innerHTML = pageNumber;
            baseUrl = "https://rickandmortyapi.com/api/character?" + `page=${pageNumber}&` + queryParams.join('&');
        }

        const response = await fetch(baseUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const data = await response.json();

        if (data.error) {
            alert("Nenhum personagem com essas características.")
        } else {
            const contentDiv = document.getElementById('content');
            contentDiv.innerHTML = '';
            const { results } = data;

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
                p.innerHTML = `<img src="${character.image}" alt="${character.name} image"><br>Gender: ${character.gender}<br>Origin: ${character.origin.name}<br>Status: ${character.status}<br>Type: ${character.type ? character.type : 'Null'}`;
            });
        }
    }

</script>


</html>