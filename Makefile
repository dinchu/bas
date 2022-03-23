help:	## Show this help
	@echo ""
	@echo "Usage:  make COMMAND"
	@echo ""
	@echo "Commands:"
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'
	@echo ""
.PHONY: help
execute: ## execute app -a stdin
	 docker run -it --rm -v ./:/usr/src/myapp --name basappInstance basapp
.PHONY: execute

exec:	## Start the docker containers for local development
	docker-compose up -d
.PHONY: up

build:	## build the docker container
	docker build -t basapp .docker/
.PHONY: build

