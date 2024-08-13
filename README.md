<center>

# Teste de Desenvolvimento - Simbi

</center>

## Tabela de conteúdos

-   [Sobre o projeto](#sobre)
-   [Instalação](#instalação)
    -   [Pré-Requisitos](#pré-requisitos)
-   [Arquitetura e definições](#arquitetura)
-   [Documentação da API](#documentacao-api)
-   [Testes Automatizados](#testes)
-   [Entrega](#entrega)

## Sobre

O teste técnico consiste na criação de um sistema de gestão de empréstimos de livros. Este projeto tem como objetivo implementar um CRUD completo para gerenciar estes empréstimos, uma vez que os Autores e Livros já estão criados.

No escopo deste projeto, você lidará com três principais entidades: Authors, Books e Loans.O repositório já inclui exemplos básicos de um CREATE e um READ para você se basear (Author, Book) e deve permitir gerenciar o cadastro de empréstimos e garantir que cada operação seja corretamente registrada.

Além disso, o projeto requer a implementação de testes automatizados, factories e seeders para assegurar que todas as funcionalidades estejam robustas e que o banco de dados esteja corretamente populado com dados de exemplo. A documentação da API será gerada utilizando o Swagger, facilitando a integração e a compreensão das funcionalidades disponíveis.


## Instalação

### Pré-Requisitos

Para rodar o projeto é necessário ter o **Docker** instalado na máquina e o Node.JS para instalar algumas dependências. Primeiro passo copie o arquivo .env.example para .env e ajuste os valores conforme necessário:

```bash
cp .env.example .env
```

Execute os seguintes comandos para subir o ambiente de desenvolvimento e instalar as depedências necessárias:

```bash
docker compose up -d
```

Para instalar as dependências do Node, rode o seguinte comando na sua máquina local:

```bash
yarn
```

Você poderá executar os comandos do `PHP` a partir da sua máquina com o seguinte comando:

```bash
docker compose exec php php artisan
```

Execute as migrações e seeders do banco de dados:

```bash
docker-compose exec php php artisan migrate
```
```bash
docker-compose exec php php artisan db:seed
```

Alternativamente, você poderá logar no container pelo seu terminal e executar os comandos a partir dele:

```bash
docker compose exec -it bash
```

A partir desse momento, você estará logado no terminal e poderá rodar os comandos do `PHP` como se estivesse localmente.

## Arquitetura

O projeto foi desenvolvido seguindo o [Clean Architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html) adaptado para o PHP unindo com funcionalidades do Laravel.

<center>

![CleanArchitecture](https://blog.cleancoder.com/uncle-bob/images/2012-08-13-the-clean-architecture/CleanArchitecture.jpg)

</center>

## Estrutura de pastas

Listagem dos principais arquivos e pastas do projeto.

```
📦
┣ 📂 .docker -> contém scripts de inicialização de containers
┣ 📂 .github -> contém scripts de ci e pull request template
┣ 📂 app -> pasta principal do sistema
┃ ┠
┠━📂 Adapter -> contém os adaptadores de interface externa
┠━📂 Core -> contém os arquivos principais do domínio da aplicação
┃ ┠━━━━ 📂 Common -> contém os arquivos a serem compartilhados entre os arquivos de domínio
┃ ┠━━━━ 📂 Domain -> contém os arquivos de domínio
┃ ┗━━━━ 📂 Service -> contém as implementações dos casos de uso
┃ ┗ 📂 Infra -> contém as implementações de infraestrutura (modelos de banco, repositórios, mappers)
┣ 📂 routes -> roteamento da aplicação
┣ 📂 tests -> arquivos de testes da aplicação
┣ 📜 phpstan.neon -> extensões e regras para testes de qualidade de código
┣ 📜 phpcs.xml -> definições PSR12 para lint do código

```

## Documentação API

A documentação da API será gerada usando o L5-Swagger

1. Gere a documentação dentro do container PHP
```bash
docker-compose exec php php artisan l5-swagger:generate
```

2. A documentação estará disponível na rota:
```bash
/api/documentation
```

3. Os arquivos gerados serão salvos na pasta:
```bash
./storage/api-docs
```

## Testes

Para garantir que seu código esteja funcionando corretamente e que os dados sejam populados adequadamente no banco de dados, você deve:

- Criar testes automatizados para as funcionalidades que implementar.
- Desenvolver factories para gerar dados de teste de forma fácil e consistente.
- Implementar seeders para popular o banco de dados com dados iniciais.

Organize seus testes no diretório tests, e utilize os diretórios padrão do Laravel para as factories e seeders.

## Entrega

- Faça um fork do repositório e implemente a sua solução.
- Certifique-se de que todos os testes estão passando, que o código está devidamente documentado com o Swagger, e que as factories e seeders estão funcionando corretamente.
