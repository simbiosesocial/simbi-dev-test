<center>

# Teste de Desenvolvimento - Simbi

</center>

## Tabela de conteúdos

- [Sobre o projeto](#sobre)
- [Instalação](#instalação)
  - [Pré-Requisitos](#pré-requisitos)
- [Arquitetura e definições](#arquitetura)
- [Documentação da API](#documentacao-api)
- [Testes Automatizados](#testes)
- [Entrega](#entrega)

## Sobre

O teste técnico consiste na criação de um sistema de gestão de empréstimos de livros. Este projeto tem como objetivo implementar um CRUD completo para gerenciar estes empréstimos, uma vez que os Autores e Livros já estão criados.

No escopo deste projeto, você lidará com três principais entidades: Authors, Books e Loans.O repositório já inclui exemplos básicos de um CREATE e um READ para você se basear (Author, Book) e deve permitir gerenciar o cadastro de empréstimos e garantir que cada operação seja corretamente registrada.

Além disso, o projeto requer a implementação de testes automatizados, factories e seeders para assegurar que todas as funcionalidades estejam robustas e que o banco de dados esteja corretamente populado com dados de exemplo. A documentação da API será gerada utilizando o Swagger, facilitando a integração e a compreensão das funcionalidades disponíveis.

O teste do frontend consiste na integração da API com um projeto Next.JS em que será necessário complementar o supramencionado CRUD a partir do projeto base, que já implementa a listagem de livros.

## Instalação

### Pré-Requisitos

Caso tenhas as dependências instaladas em sua máquina, você poderá rodar o projeto diretamente ou, caso prefira, use os comandos abaixo para rodar as aplicações em containers Docker.

> Obs: caso opte por rodar o projeto localmente, lembre-se de alterar as variáveis ambiente de forma adequada.

```
PHP >= 8.2
Node.JS >= 20.16
Yarn = 1.22.22
```

Para rodar o projeto é necessário ter o **Docker** instalado na máquina e o Node.JS para instalar algumas dependências. Primeiro passo copie o arquivo .env.example para .env e ajuste os valores conforme necessário:

```bash
cd backend && cp .env.example .env
```

> Obs: o projeto do backend possui dependências do Node.JS

Para instalar as dependências do Node, rode o seguinte comando na sua máquina local:

```bash
cd backend && yarn
```

Execute os seguintes comandos para subir o ambiente de desenvolvimento e instalar as depedências necessárias:

```bash
docker compose up -d
```

Certifique-se de que o container do frontend e do backend estejam rodando e gere a key do Laravel:

```bash
docker compose ps
docker compose exec backend php artisan key:generate
```

Você poderá acessar os projetos nas seguintes portas:

```
Frontend: http://localhost:3000
Backend: http://localhost:9000
```

Você poderá executar os comandos do `PHP` a partir da sua máquina com o seguinte comando:

```bash
docker compose exec backend php artisan
```

Execute as migrações e seeders do banco de dados:

```bash
docker compose exec backend php artisan migrate
```

```bash
docker compose exec backend php artisan db:seed
```

Alternativamente, você poderá logar no container pelo seu terminal e executar os comandos a partir dele:

```bash
docker compose exec -it backend sh
```

A partir desse momento, você estará logado no terminal do backend e poderá rodar os comandos do `PHP` como se estivesse localmente.

## Arquitetura

O projeto foi desenvolvido seguindo o [Clean Architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html) adaptado para o PHP unindo com funcionalidades do Laravel.

<center>

![CleanArchitecture](https://blog.cleancoder.com/uncle-bob/images/2012-08-13-the-clean-architecture/CleanArchitecture.jpg)

</center>

## Estrutura de pastas do backend

Listagem dos principais arquivos e pastas do projeto.

```
📦
┣ 📂 .docker -> contém scripts de inicialização de containers
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
docker compose exec backend php artisan l5-swagger:generate
```

2. A documentação estará disponível na rota:

```bash
/api/documentation
```

3. Os arquivos gerados serão salvos na pasta:

```bash
./storage/api-docs
```

## Estrutura de pastas do frontend

```bash
.
├── app -> diretório next router
├── common -> conteúdos utilitários e componentes comuns da aplicação
│   ├── components -> componentes comuns e reutilizáveis do projeto
│   ├── config -> arquivos de configuração
│   ├── providers -> contexto de dados do react para o projeto
│   ├── theme -> arquivos de configuração do tema (Mui React)
│   └── utils -> funções utilitárias
├── features -> funcionalidades do projeto
│   └── components -> componentes do projeto
├── public -> diretório público do Next.JS
└── views -> arquivos incluídos nas páginas
```

## Testes

Para garantir que seu código esteja funcionando corretamente e que os dados sejam populados adequadamente no banco de dados, você deve:

- Criar testes automatizados para as funcionalidades que implementar.
- Desenvolver factories para gerar dados de teste de forma fácil e consistente.
- Implementar seeders para popular o banco de dados com dados iniciais.

Organize seus testes no diretório tests, e utilize os diretórios padrão do Laravel para as factories e seeders.

## Entrega

- Faça um fork do repositório e implemente a sua solução;
- Certifique-se de que todos os testes estão passando, que a API está devidamente documentada com o Swagger, e que as factories e seeders estão funcionando corretamente;
- Quando tudo estiver pronto, abra um Pull Request para o repositório original.
