CURRENT_UID := $(shell id -u)
CURRENT_GID := $(shell id -g)

init:
	cp .env.example .env
	sed -i -e "s/UID=0/UID=$(CURRENT_UID)/" .env
	sed -i -e "s/GID=0/GID=$(CURRENT_GID)/" .env

build:
	docker build -t otjfs:php --build-arg UID=${CURRENT_UID} --build-arg GID=${CURRENT_GID} .

run:
	docker run -d -v $$PWD:/var/www --name otjfs_php otjfs:php

load:
	git clone git@github.com:overthejuncture/overthejuncture.git ./www/otjl.local
