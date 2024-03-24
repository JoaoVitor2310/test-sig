<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register test SIG</title>
    <link rel="stylesheet" href="./app/View/styles/auth-style.css">
</head>

<body>
    <h1>Teste SIG - João Vitor Matos Gouveia</h1>
    <div class="auth-screen">
        <form id="registerForm" method="POST" action="/api/register">
            <h2>Crie sua conta</h2>
            <label>Digite o seu email</label>
            <br>
            <br>
            <input type="email" id="emailInput" placeholder="Email">
            <br>
            <br>
            <label>Digite a sua senha</label>
            <br>
            <br>
            <input type="password" id="passwordInput" placeholder="Senha">
            <br>
            <br>
            <label>Digite novamente a senha</label>
            <br>
            <br>
            <input type="password" id="confirmPasswordInput" placeholder="Confirmar">
            <br>
            <br>
            <input type="submit" name="action" value="Criar"></input>
        </form>
        <p>
            Já tem conta?
            <a href="?page=login">Login</a>
        </p>
    </div>
</body>
<script>
    document.getElementById('registerForm').addEventListener('submit', async function (event) {
        event.preventDefault(); // Previne o comportamento padrão do formulário de recarregar a página

        // Obtém os valores dos campos de entrada
        const email = document.getElementById('emailInput').value;
        const password = document.getElementById('passwordInput').value;
        const confirm_password = document.getElementById('confirmPasswordInput').value;

        if (password !== confirm_password) {
            alert('Senhas diferentes, tente novamente.');
            return;
        }


        // Constrói o objeto com os dados a serem enviados
        const registerData = {
            email,
            password,
            confirm_password
        };

        // Envia a requisição POST para a rota /api/register
        const response = await fetch('app/router/UserRoutes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(registerData)
        });

        const data = await response.json();

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