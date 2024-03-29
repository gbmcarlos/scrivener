SHELL := /bin/bash
.DEFAULT_GOAL := logs
.PHONY: logs run command watch build

MAKEFILE_PATH := $(abspath $(lastword ${MAKEFILE_LIST}))
PROJECT_PATH := $(dir ${MAKEFILE_PATH})
PROJECT_NAME := $(notdir $(patsubst %/,%,$(dir ${PROJECT_PATH})))

export DOCKER_BUILDKIT ?= 1
export APP_PORT ?= 99
export APP_NAME ?= ${PROJECT_NAME}
export APP_RELEASE ?= latest
export APP_DEBUG ?= true
export XDEBUG_MODE ?= debug
export XDEBUG_REMOTE_HOST ?= host.docker.internal
export XDEBUG_REMOTE_PORT ?= 10000
export XDEBUG_IDE_KEY ?= ${APP_NAME}_PHPSTORM
export MEMORY_LIMIT ?= 3M

ENTRYPOINT_COMMAND := set -ex
ENTRYPOINT_COMMAND += ; npm install
ENTRYPOINT_COMMAND += ; /var/task/node_modules/webpack/bin/webpack.js --hide-modules --config=/var/task/node_modules/laravel-mix/setup/webpack.config.js
ENTRYPOINT_COMMAND += ; composer install -v --no-dev --no-interaction --no-ansi
ENTRYPOINT_COMMAND += ; /opt/bin/init.sh

logs: run
	docker logs -f ${APP_NAME}

run: build

	docker rm -f ${APP_NAME} || true

	docker run \
    --name ${APP_NAME} \
    -d \
    -p ${APP_PORT}:80 \
    -e APP_PORT \
    -e APP_NAME \
    -e APP_DEBUG \
    -e XDEBUG_MODE \
    -e XDEBUG_REMOTE_HOST \
    -e XDEBUG_REMOTE_PORT \
    -e XDEBUG_IDE_KEY \
    -v ${PROJECT_PATH}src:/var/task/src \
    -v ${PROJECT_PATH}vendor:/opt/vendor \
	-v ${PROJECT_PATH}node_modules:/var/task/node_modules \
    ${APP_NAME}:latest \
    /bin/sh -c "${ENTRYPOINT_COMMAND}"

command: build

	docker run \
    --name ${APP_NAME}-command \
    --rm \
    -it \
    -e APP_NAME \
    -e XDEBUG_MODE \
    -e XDEBUG_REMOTE_HOST \
    -e XDEBUG_REMOTE_PORT \
    -e XDEBUG_IDE_KEY \
    -v ${PROJECT_PATH}src:/var/task/src \
    -v ${PROJECT_PATH}vendor:/opt/vendor \
	-v ${PROJECT_PATH}node_modules:/var/task/node_modules \
    ${APP_NAME}:latest \
    /bin/sh -c "composer install -v --no-dev --no-interaction --no-ansi && php src/artisan ${COMMAND}"

watch:
	docker exec \
    -it \
    ${APP_NAME} \
    /bin/sh -c "/var/task/node_modules/webpack/bin/webpack.js --hide-modules --config=/var/task/node_modules/laravel-mix/setup/webpack.config.js --watch"

build:
	docker build -t ${APP_NAME} .