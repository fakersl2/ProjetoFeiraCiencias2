# Usar a imagem base do PHP
FROM php:8.0-cli

# Definir o diretório de trabalho
WORKDIR /app

# Copiar todos os arquivos do projeto para o diretório de trabalho
COPY . .

# Expor a porta 10000
EXPOSE 10000

# Comando para iniciar o servidor embutido do PHP
CMD ["php", "-S", "0.0.0.0:10000", "-t", "app/src"]
