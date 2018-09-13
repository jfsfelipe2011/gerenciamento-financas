#!/bin/bash
echo "Setando UID"
export UID=$UID;
echo "starting docker-compose";
docker-compose up -d