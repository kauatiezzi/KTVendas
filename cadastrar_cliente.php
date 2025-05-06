<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Paleta de cores de doceria */
        :root {
            --brown-light: #d4b19b;
            --brown-dark: #5e3a3a;
            --cream: #f3e1d1;
            --pink: #f1b6b6;
        }
    </style>
</head>
<body class="bg-cream min-h-screen flex flex-col">

    <!-- Barra Superior -->
    <header class="bg-[#5e3a3a] text-white py-4 px-6 flex items-center justify-between sm:px-8">
        <div class="flex items-center space-x-4">
            <img src=".\assets\imagens\logo.png" alt="Logo" class="h-16 w-34 rounded-full">
        </div>
        <nav>
          <a href="dashboard.php" class="w-full bg-[#d4b19b] text-white font-semibold py-3 px-6 rounded-lg" >Voltar</a>
        </nav>
    </header>

    <!-- Conteúdo Principal -->
    <main class="flex-grow flex items-center justify-center px-4 py-8">
        <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-bold text-[#5e3a3a] mb-6 text-center">Cadastrar Cliente</h2>

            <!-- Formulário de Cadastro -->
            <form action="cadastrar_cliente.php" method="POST" class="space-y-6">
                <div>
                    <label for="nome" class="block text-[#5e3a3a]">Nome:</label>
                    <input type="text" name="nome" id="nome" class="w-full p-3 border border-[#d4b19b] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5e3a3a]" required>
                </div>

                <div>
                    <label for="telefone" class="block text-[#5e3a3a]">Telefone:</label>
                    <input type="text" name="telefone" id="telefone" class="w-full p-3 border border-[#d4b19b] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5e3a3a]" required>
                </div>

                <button type="submit" class="w-full bg-[#d4b19b] text-white font-semibold py-3 rounded-lg hover:bg-[#5e3a3a] transition">Cadastrar</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                require 'conexao.php';
                $nome = $_POST['nome'];
                $telefone = $_POST['telefone'];

                $stmt = $pdo->prepare("INSERT INTO clientes (nome, telefone) VALUES (?, ?)");
                $stmt->execute([$nome, $telefone]);

                echo "<p class='mt-6 text-center text-green-600 font-semibold'>Cliente cadastrado com sucesso!</p>";
            }
            ?>
        </div>
    </main>

</body>
</html>
