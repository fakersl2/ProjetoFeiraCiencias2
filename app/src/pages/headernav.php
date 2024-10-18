<?php
// headernav.php

// Função para buscar o nome do usuário
function fetchUserName($userId) {
    if (!$userId) {
        return null; // Retorna null se o ID do usuário não for encontrado
    }

    $url = "https://projetofeiraciencias-5.onrender.com/usuarios/$userId"; // URL da API
    $response = file_get_contents($url); // Faz a requisição
    if ($response === FALSE) {
        return null; // Retorna null em caso de erro
    }

    $data = json_decode($response, true); // Decodifica o JSON
    return $data['senha'] ?? null; // Assume que "senha" é o nome do usuário
}

// Obtém o ID do usuário do localStorage (simulando com $_SESSION para o exemplo)
session_start();
$userId = $_SESSION['userId'] ?? null; // Simulando localStorage
$userName = fetchUserName($userId); // Busca o nome do usuário

?>

<div>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex items-center justify-around max-w-screen-xl p-4 mx-auto flex-nowrap">
            <div class='flex flex-nowrap md:flex-wrap'>
                <a 
                    target="_blank" 
                    href="http://colegiocomercialcpv.com.br/"
                    class="flex items-center space-x-3 transition-all rtl:space-x-reverse hover:scale-105 hover:mx-2" 
                    rel="noreferrer"
                >
                    <img src="../assets/img/logo.png" alt="Logo" class="w-auto h-12" />
                    <p class="block px-3 py-2 text-gray-900 text-wrap md:hover:bg-transparent md:hover:text-green-700 md:p-0 md:dark:hover:text-green-500">
                        Colégio Comercial de Caçapava
                    </p>
                </a>
                <a 
                    href="/inicio"
                    class="flex items-center space-x-3 transition-all rtl:space-x-reverse hover:scale-105 sm:ml-2 md:ml-6" 
                    rel="noreferrer"
                >
                    <p class="block px-3 py-2 text-gray-900 text-wrap md:hover:bg-transparent md:hover:text-green-700 md:p-0 md:dark:hover:text-green-500 hover:underline decoration-green-800">
                        Início
                    </p>
                </a>
            </div>
            <div class="flex items-center space-x-3 text-black bg-white md:order-2 md:space-x-0 rtl:space-x-reverse">
                <button 
                    type="button"
                    class="flex text-sm transition-all bg-white rounded-full md:me-0 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-400 hover:scale-105 hover:mx-2"
                    id="user-menu-button" 
                    aria-expanded="false" 
                    data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom"
                >
                    <p class='z-10 mx-1 mt-1 font-semibold text-black bg-white'><?php echo htmlspecialchars($userName); ?></p>
                    <span class="sr-only">Open user menu</span>
                    <img src="../assets/img/personicon.svg" alt="User Icon" class="w-8 h-8 bg-white border-none rounded-full outline-none" />
                </button>
                <div
                    class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown"
                >
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">Comercial</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a 
           
