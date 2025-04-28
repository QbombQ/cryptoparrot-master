build: delete-container ## Build the container
	@docker-compose build

restart: ## Restart the container
	@docker-compose restart

cmd-php: ## Access php bash
	@docker-compose exec php /bin/bash

cmd-nginx: ## Access nginx bash
	@docker-compose exec nginx /bin/bash

up:
	@docker-compose up

start:
	@docker-compose start

down: ## Stop container
	@docker-compose stop || true

delete-container: down
	@docker-compose down || true

remove: delete-container ## Delete containers and images

.DEFAULT_GOAL := help
