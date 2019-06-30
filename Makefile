.PHONY: all build deps composer-install composer-update composer reload test run-tests start stop destroy doco rebuild

current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

# 👌 Main targets

build: deps start

deps: composer-install

# 🐘 Composer

composer-install: CMD=install
composer-update: CMD=update

# Usage example (add a new dependency): `make composer CMD="require --dev symfony/var-dumper ^4.2"`
composer composer-install composer-update:
	@docker run --rm --interactive --tty --volume $(current-dir)/app:/app --user $(id -u):$(id -g) \
		gsingh1/prestissimo $(CMD) \
			--ignore-platform-reqs \
			--no-ansi \
			--no-interaction

# 🕵️ Clear cache
# OpCache: Restarts the unique process running in the PHP FPM container
# Nginx: Reloads the server

reload:
	@docker-compose exec nginx nginx -s reload

# ✅ PSR
psr:
	@docker-compose exec -T php /usr/local/bin/php -d xdebug.remote_enable=0 -d xdebug.profiler_enable=0 -d xdebug.default_enable=0 ./vendor/bin/phpcs --standard=PSR2,PSR1 src

# ✅ Tests

test:
	@docker-compose exec -T php vendor/bin/behat --format=progress -v


# 🐳 Docker Compose

start:
	@docker-compose up -d

stop: CMD=stop

destroy: CMD=down

# Usage: `make doco CMD="ps --services"`
# Usage: `make doco CMD="build --parallel --pull --force-rm --no-cache"`
doco stop destroy:
	@docker-compose $(CMD)

rebuild:
	echo "docker-compose build --parallel --pull --force-rm --no-cache"
	@docker-compose build --parallel --pull --force-rm --no-cache
	echo "composer-install"
	@make deps
	echo "start"
	@make start
