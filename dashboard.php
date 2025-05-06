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
        </nav>
    </header>

    <!-- Conteúdo Principal -->
    <main class="flex-grow flex items-center justify-center px-4 py-8">
        <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-bold text-[#5e3a3a] mb-6 text-center">Gerenciamento de Brigadeiros</h2>
            <ul class="space-y-6">
                <li>
                    <a href="produtos.php" class="block bg-[#d4b19b] text-white font-semibold text-xl py-3 px-6 rounded-xl hover:bg-[#5e3a3a] transition">
                        Cadastrar Brigadeiros
                    </a>
                </li>
                <li>
                    <a href="clientes.php" class="block bg-[#d4b19b] text-white font-semibold text-xl py-3 px-6 rounded-xl hover:bg-[#5e3a3a] transition">
                        Ver Clientes
                    </a>
                </li>
                <li>
                    <a href="cadastrar_cliente.php" class="block bg-[#d4b19b] text-white font-semibold text-xl py-3 px-6 rounded-xl hover:bg-[#5e3a3a] transition">
                        Cadastrar Cliente
                    </a>
                </li>
            </ul>
        </div>
    </main>

</body>
</html>
