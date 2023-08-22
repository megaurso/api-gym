## api-gym
## Como Rodar a API em Laravel - Guia Passo a Passo
Este guia irá orientar você através dos passos necessários para rodar sua API em Laravel. Siga atentamente cada etapa para garantir o funcionamento correto da sua aplicação.

## Passo 1: Navegue até a pasta do projeto
No terminal, navegue até a pasta do seu projeto Laravel (api-gym):
comando: "cd api-gym"

## Passo 2: Instale o Composer (caso não esteja instalado)
O Composer é essencial para gerenciar as dependências do Laravel. Se você ainda não o tem instalado, siga as instruções em: https://getcomposer.org/download/.

## Passo 3: Instale as dependências do projeto
Execute o seguinte comando no terminal para instalar as dependências do seu projeto Laravel: composer install.

## Passo 4: Configure as variáveis de ambiente
Renomeie o arquivo .env.example para .env e preencha as variáveis de ambiente necessárias, como conexão com o banco de dados e chaves de API.

## Passo 5: Gere a chave de aplicação
Se a variável APP_KEY no arquivo .env estiver vazia, gere uma chave de aplicação com o seguinte comando no terminal: php artisan key:generate

## Passo 6: Configure o banco de dados
No arquivo .env, preencha as informações do banco de dados (host, porta, nome do banco, usuário e senha).

## Passo 7: Migre o banco de dados
Execute as migrações do banco de dados para criar as tabelas necessárias com o comando no terminal: php artisan migrate

## Passo 8: Inicie o servidor de desenvolvimento
Inicie o servidor de desenvolvimento com o seguinte comando: php artisan serve

## Documentação da api
http://localhost:8000/api/documentation
