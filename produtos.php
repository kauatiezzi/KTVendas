<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
            <h2 class="text-2xl font-bold text-[#5e3a3a] mb-6 text-center">Cadastrar Tipo de Brigadeiro</h2>
            <form action="cadastrar_produto.php" method="POST">
                <div class="mb-4">
                    <label for="nome" class="block text-[#5e3a3a] font-semibold mb-2">Nome:</label>
                    <input type="text" name="nome" id="nome" class="w-full p-3 border border-[#d4b19b] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5e3a3a]" required>
                </div>
                <div class="mb-4">
                    <label for="preco" class="block text-[#5e3a3a] font-semibold mb-2">Preço:</label>
                    <input type="number" step="0.01" name="preco" id="preco" class="w-full p-3 border border-[#d4b19b] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5e3a3a]">
                </div>
                <button type="submit" class="w-full bg-[#d4b19b] text-white font-semibold py-3 rounded-lg hover:bg-[#5e3a3a] transition">
                    Cadastrar
                </button>
            </form>
        </div>
    </main>

</body>
</html>
