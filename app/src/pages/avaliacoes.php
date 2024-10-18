<main>
    <div class="p-4 rounded-lg bg-green-50">
        <div class="flex items-center justify-between mb-2">
            <span class="text-3xl font-bold text-black">Votos</span>
            <div class="flex space-x-2">
                <span class="flex items-center text-green-600" aria-label="0 votos positivos">
                    <svg class="w-5 h-5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    0 <!-- Mostra total de votos positivos -->
                </span>
                <span class="flex items-center text-gray-600" aria-label="0 votos neutros">
                    <svg class="w-5 h-5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    0 <!-- Mostra total de votos neutros -->
                </span>
                <span class="flex items-center text-red-600" aria-label="0 votos negativos">
                    <svg class="w-5 h-5 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    0 <!-- Mostra total de votos negativos -->
                </span>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-xl text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
            <div class="w-full h-4 bg-gray-200 rounded-full">
                <div class="flex h-4 overflow-hidden rounded-full">
                    <div class="bg-green-500" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    <div class="bg-gray-500" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    <div class="bg-red-500" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
            <span class="text-xl text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </div>

        <h1 class="pt-20 text-3xl font-bold text-black dark:text-white">Comentários</h1>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
            <div class="p-4 rounded-md bg-green-50">Comentário 1</div>
            <div class="p-4 rounded-md bg-green-50">Comentário 2</div>
            <div class="p-4 rounded-md bg-green-50">Comentário 3</div>
            <!-- Adicione mais comentários conforme necessário -->
        </div>
    </div>

</main>