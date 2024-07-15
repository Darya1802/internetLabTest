-include .env.dist
-include .env


##################
# Initialization
##################

define generate_docs
    echo -e "\x1b[42mGenerating docs\x1b[0m"
	${PHP} ./yii open-api/generate-docs src
endef

define run_tests
    echo -e "\x1b[42mRunning tests\x1b[0m"
    ${PHP} vendor/bin/robo parallel:split-tests
    ${PHP} vendor/bin/robo parallel:run
    ${PHP} vendor/bin/robo parallel:merge-results
endef

DOCKER_PHP=docker compose exec "internet_lab.php"
ifeq (${USE_DOCKER}, true)
	PHP=${DOCKER_PHP} php
	COMPOSER_CMD=${DOCKER_PHP} composer
else
	COMPOSER_CMD=${PHP} ${COMPOSER}
endif


##################
# Git & Deploy
##################

docs:
	$(call generate_docs)

csfix:
	${PHP} -dxdebug.mode=off vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php

pull:
	git checkout ${GIT_BRANCH}
	git reset --hard HEAD
	git pull -f origin ${GIT_BRANCH}

flush-cache:
	${PHP} ./yii cache/flush cache --interactive=0


##################
# Dependencies
##################

composer-install:
	${COMPOSER_CMD} update -o


##################
# DB
##################

migrate:
	${PHP} yii migrate/up --interactive=0

migrate/down:
	${PHP} yii migrate/down $(count) --interactive=0

migration:
	${PHP} yii migrate/create $(name)

##################
# Docker compose
##################

docker.start:
	docker compose -f "docker-compose.yml" start

docker.stop:
	docker compose -f "docker-compose.yml" stop

docker.up:
	docker compose -f "docker-compose.yml" up --build --force-recreate --remove-orphans -d

docker.down:
	docker compose -f "docker-compose.yml" down

docker.restart:
	make docker.stop && make docker.start

docker.hard-restart:
	make docker.down && make docker.up


##################
# Tests
##################

test-and-generate:
	$(call run_tests,$(DIR))

	$(call generate_docs)

test:
	$(call run_tests,$(DIR))

old_test:
	${PHP} vendor/bin/codecept run --debug
