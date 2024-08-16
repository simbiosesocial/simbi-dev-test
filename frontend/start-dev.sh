#!/bin/bash
set -e
echo "Instalando dependências com yarn..."
yarn install
if [ ! -f .env ]; then
  echo ".env não encontrado, copiando .env.example para .env"
  cp .env.example .env
fi
echo "Iniciando a aplicação em modo de desenvolvimento..."
yarn dev