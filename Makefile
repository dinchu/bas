help:	## Show this help
	@echo ""
	@echo "Usage:  make COMMAND"
	@echo ""
	@echo "Commands:"
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'
	@echo ""
.PHONY: help

down:	## Stop the docker containers for local development
	docker-compose down
.PHONY: down

up:	## Start the docker containers for local development
	docker-compose up -d
.PHONY: up

build:	## Start the docker containers for local development
	docker build -t basapp .docker
.PHONY: build

