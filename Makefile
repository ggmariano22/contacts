CONTAINER_NAME=contacts-php

docker-install: docker-build docker-up docker-composer-install

docker-build:
	docker-compose build

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-composer-install:
	docker exec -t ${CONTAINER_NAME} composer install

docker-bash:
	docker exec -it ${CONTAINER_NAME} bash

docker-test:
	docker exec -t ${CONTAINER_NAME} composer tests