build:
	docker compose up -d --build
install: build
	docker compose run --rm api composer install
	docker compose run --rm api composer build
	docker compose run --rm api composer build:test
start:
	docker compose up -d
stop:
	docker compose stop
remove:
	docker compose down
exec:
	docker compose exec api /bin/bash
test:
	docker compose run --rm api composer test
