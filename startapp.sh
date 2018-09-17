#!/bin/bash
echo "Setando UID"
export UID=$UID;
echo "Criando arquivo .env"
cp .env.example .env
echo "starting docker-compose";
docker-compose up -d