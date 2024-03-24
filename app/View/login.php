<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login test SIG</title>
    <link rel="stylesheet" href="./app/View/styles/auth-style.css">
</head>

<body>
    <h1>Teste SIG - João Vitor Matos Gouveia</h1>
    <div class="auth-screen">
        <form id="loginForm" method="POST" action="/api/register">
            <label for="">Login para autenticação</label>
            <br>
            <br>
            <input type="email" id="emailInput" placeholder="Email">
            <br>
            <br>
            <input type="password" id="passwordInput" placeholder="Senha">
            <br>
            <br>
            <input type="submit" name="action" value="Login"></input>
        </form>
        <p>
            Não possui login?
            <a href="?page=register">Cadastre-se</a>
        </p>
    </div>
</body>
<script>
    document.getElementById('loginForm').addEventListener('submit', async function (event) {
        event.preventDefault(); // Previne o comportamento padrão do formulário de recarregar a página

        // Obtém os valores dos campos de entrada
        const email = document.getElementById('emailInput').value;
        const password = document.getElementById('passwordInput').value;

        // Constrói o objeto com os dados a serem enviados
        const loginData = {
            email,
            password
        };

        // Envia a requisição POST para a rota /api/register
        const response = await fetch('app/router/UserRoutes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(loginData)
        });

        const data = await response.json();
        console.log(data);

        if (data.error) {
            console.error(data.message); // Exibe o erro no console, se ocorrer algum
            alert(data.message);
            return;
        }

        alert(data.message);
        window.location.href = "?page=home";

    });

</script>

</html>