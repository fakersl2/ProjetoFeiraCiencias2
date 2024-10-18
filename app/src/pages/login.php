<div class="flex items-center justify-center min-h-screen mx-2 bg-gray-100 select-none">
    <!--Container principal do formulário, centralizado na tela-->
    <div class="flex flex-col w-full max-w-4xl overflow-hidden bg-white rounded-lg shadow-md md:flex-row">
        <div class="w-full p-8 mt-12 md:w-1/2">
            <div class="flex justify-center mb-8">
                <!--Espaço reservado para algum conteúdo adicional-->
            </div>
            <h2 class="mb-4 text-2xl font-bold text-gray-700 md:text-3xl">Logar</h2>
            {/* Mensagem que convida o usuário a se cadastrar, caso não tenha conta */}
            <p class="mb-6 text-sm text-gray-600 md:text-base">Não possui conta? <a href="/Cadastro"
                    class="text-green-600 hover:underline">Cadastrar</a></p>

            <form onSubmit={handleSubmit} class="bg-white">
                <div class="mb-4">
                    <label htmlFor="email"
                        class="block text-sm font-medium text-gray-700 md:text-base">Identificação:</label>
                    <input type="password" // Campo para senha (código de identificação) id="email" // ID do campo
                        class="w-full px-4 py-2 leading-tight transition-all bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:bg-white focus:border-green-600 focus:mt-2"
                        placeholder="Código de identificação" // Placeholder do campo required // Campo obrigatório
                        value={codigo} // O valor do input está vinculado ao estado onChange={(e)=>
                    setCodigo(e.target.value)} // Atualiza o estado conforme o usuário digita
                    />
                </div>

                <div class="mb-6">
                    <button type="submit"
                        class="flex items-center justify-center w-full px-4 py-2 text-white transition duration-300 ease-in-out bg-green-500 border-2 border-gray-200 rounded-lg hover:bg-green-600">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
        {/* Espaço para Imagem */}
        <div class="hidden md:block md:w-1/2">
            <div class="object-cover w-full h-full bg-green-500">
                <img src={Logo} class='relative mx-auto w- h-2/3 top-1/2 ' style={{ transform: "translateY(-50%)" }} />
                {/* Exibe o logo do colégio, centralizado verticalmente */}
            </div>
        </div>
    </div>
</div>