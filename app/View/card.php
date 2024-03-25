<?php
include 'app\utils\protect.php';

// if (isset ($_GET['character'])) {
//     $character = $_GET['character'];
//     echo $character;
// }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character Page</title>
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
    </div>

    <div id="characterPage">
        <!-- Exemplo -->
        <!-- <article>
            <a href="">
                <header>
                    <h2>Character Title</h2>
                </header>
                <p>Character details</p>
            </a>
        </article> -->
    </div>
</body>

<script>
    const params = new URLSearchParams(window.location.search);
    const id = params.get('character');
    console.log(id);

    const getCharacterDetails = async (id) => {
        const response = await fetch(`https://rickandmortyapi.com/api/character/${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            }
        });

        const data = await response.json();
        console.log(data);

        const contentDiv = document.getElementById('characterPage');

        const article = document.createElement('article');
        const header = document.createElement('header');
        const h2 = document.createElement('h2');
        const p = document.createElement('p');

        h2.textContent = data.name;
        header.appendChild(h2);
        article.appendChild(header);
        article.appendChild(p);
        contentDiv.appendChild(article);

        p.innerHTML = `<img src="${data.image}" alt="${data.name} image"><br><b>Id:</b> ${data.id}<br><b>Gender:</b> ${data.gender}<br><b>Origin:</b> ${data.origin.name}<br><b>Status:</b> ${data.status}<br><b>Species:</b> ${data.species}<br><b>Location:</b> ${data.location.name}`;

    }
    getCharacterDetails(id);



</script>

</html>