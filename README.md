## PHP API

## INTRODUÇÃO

CRUD para produtos codificado em PHP8.2, Bootstrap5, HTML5 e JQuery, contemplando Controllers, Routes, Database setup,
Migrations, Auth simples (via local session) e DB MySQL, segue o padrão SOLID e contem o frontend para Login e
Listagem/Edição dos produtos.

OBS: A aplicação conta com "requests collections"no padrão Insomnia e HTTP Har, ambos os arquivos estão presentes na pasta
"requests_collections" para importação.

Repositórios git: 
* (HTTP) https://github.com/haslley-vinicius/hubxp.git
* (SSH) git@github.com:haslley-vinicius/hubxp.git

-> PS: Login padrão (admin - 1234)

### Pre-requisitos

O projeto utiliza composer para gerenciamento de pacotes PHP e permite iniciar a API via local server.
Também possui testes para criação, listagem e busca de produto utilizando PHPUnit.

OBS: É necessário ter instalados: PHP8+ e Composer.

* Instalar as dependências PHP via composer;
* Criar um database como o nome "phpapi" apenas com usuário ("root") e senha em branco ("");
-> (PS: Caso deseje utilizar outras configurações para o DB, faz-se necessário alterar o arquivo .env)  
* Rodar as migrations;
* Usar a request collection.

### Installation

_Abaixo seguem os passos para a instalação das dependências e setups necessários._

1. Clonar o repositório no local desejado;
    ```sh
   git clone git@github.com:haslley-vinicius/hubxp.git
   ```
2. Entrar na pasta do projeto "/hubxp/phpapi" e executar o composer para instalação das dependências
   ```sh
   composer install
   ```
3. Executar a migration para criação da TB (tabela) necessária
   ```sh
   php src/Migrations/create_products_table.php
   ```
4. Importar a collection no "request client" de sua escolha
   ```phpapi_insomnia_collection.har ou phpapi_insomnia_collection.yaml
   ambos os arquivos estão presentes na pasta "requests_collections" para importação
   ```
5. Executar a aplicação com o servidor local, ficará acessível pelo endpoint: http://localhost:8000/
   (OBS: É necessário estar na pasta "phpapi" que encontra-se dentro da pasta raíz "hubxp")
   ```sh
   php -S localhost:8000 -t public
   ```

## Usage

Aplicação possui frontend para as telas de login e painel de gerenciamento de produtos, mas também
pode usada via collection no "request client" de sua escolha.

OBS: Para ambas as situações faz-se necessário estar logado, sendo o login padrão (amin - 1234)