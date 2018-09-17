#!/bin/bash
echo "Setando UID"
export UID=$UID;

echo "Criando arquivo .env"
cp .env.example .env

echo "Subindo container com docker-compose";
docker-compose up -d