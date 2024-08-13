<center>

![Simbiose Social](https://i.ibb.co/GW2JwJd/simbiose.png)

# Simbi Laravel Template

</center>

## Tabela de conteúdos

-   [Sobre o projeto](#sobre)
-   [Instalação](#instalação)
    -   [Pré-Requisitos](#pré-requisitos)
-   [Arquitetura e definições](#arquitetura)

## Sobre

Template de aplicação Laravel.

## Instalação

### Pré-Requisitos

Para rodar o projeto é necessário ter o **Docker** instalado na máquina e o Node.JS para instalar algumas dependências. Execute os seguintes comandos para subir o ambiente de desenvolvimento e instalar as depedências necessárias:

```bash
docker-compose up -d
```

Para instalar as dependências do Node, rode o seguinte comando na sua máquina local:

```bash
yarn
```

Você poderá executar os comandos do `PHP` a partir da sua máquina com o seguinte comando:

```bash
docker-compose exec php php artisan
```

Alternativamente, você poderá logar no container pelo seu terminal e executar os comandos a partir dele:

```bash
docker-compose exec -it bash
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
