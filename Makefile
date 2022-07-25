CURRENT_UID := $(shell id -u)
CURRENT_GID := $(shell id -g)
include .env
export

init:
	cp .env.example .env
	sed -i -e "s/UID=0/UID=$(CURRENT_UID)/" .env
	sed -i -e "s/GID=0/GID=$(CURRENT_GID)/" .env

db_seed:
	docker-compose up -d
	docker-compose exec mysql mysqladmin -u $(DB_USER) -p$(DB_PASSWORD) create otjfs
	docker-compose exec mysql mysqladmin -u $(DB_USER) -p$(DB_PASSWORD) create otjfs
	docker-compose down

build:
	docker build -t otjfs:php --build-arg UID=${CURRENT_UID} --build-arg GID=${CURRENT_GID} .

run:
	docker run -d -v $$PWD:/var/www --name otjfs_php otjfs:php

load:
	git clone git@github.com:overthejuncture/overthejuncture.git ./www/otjl.local
