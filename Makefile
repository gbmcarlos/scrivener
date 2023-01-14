SHELL := /bin/bash
.DEFAULT_GOAL := build
.PHONY: command build

MAKEFILE_PATH := $(abspath $(lastword ${MAKEFILE_LIST}))
PROJECT_PATH := $(dir ${MAKEFILE_PATH})
PROJECT_NAME := $(notdir $(patsubst %/,%,$(dir ${PROJECT_PATH})))

export DOCKER_BUILDKIT ?= 1
export APP_NAME ?= ${PROJECT_NAME}
export APP_RELEASE ?= latest
export APP_DEBUG ?= true
export XDEBUG_MODE ?= debug
export XDEBUG_REMOTE_HOST ?= host.docker.internal
export XDEBUG_REMOTE_PORT ?= 10000
export XDEBUG_IDE_KEY ?= ${APP_NAME}_PHPSTORM
export MEMORY_LIMIT ?= 3M

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
    ${APP_NAME}:latest \
    /bin/sh -c "composer install -v --no-dev --no-interaction --no-ansi && php src/artisan ${COMMAND}"

build:
	docker build -t ${APP_NAME} .