DOTB_ENV ?= dev
DOTB_LUMIA_DOCKER_VERSION ?= 8.9.2

# V := 1 # When V is set, print commands and build progress.
Q := $(if $V,,@)

.DEFAULT_GOAL := build

.PHONY: help
help:
	@echo "Example:"
	@echo " make clean build"
	@echo ""
	@echo "ENVIRONMENT VARS:"
	@echo " DOTB_ENV=      set to production when building the release packages Default: $(DOTB_ENV)"
	@echo ""
	@echo "TARGETS:"
	@echo " build:          builds lumia"
	@echo " release_build:  alias to build"
	@echo " docker_build:   runs the build inside of docker instead of on the local host"
	@echo " clean:          resets the compile versions"

.PHONY: build
build:
	@echo "=====> Building Lumia <====="
	$Q yarn install
	$Q node_modules/gulp/bin/gulp.js build
ifeq ($(DOTB_ENV), production)
	@echo "=====> Removing Dev Dependencies <====="
	$Q yarn install --production --no-bin-links
endif

.PHONY: release_build
release_build: build

.PHONY: docker_build
docker_build:
	@echo "=====> Building In Docker <====="
	$Q docker run -v $(CURDIR):/lumia -e DOTB_ENV=$(DOTB_ENV) -w /lumia --rm node:$(DOTB_LUMIA_DOCKER_VERSION) make build

.PHONY: clean
clean:
	@echo "=====> Cleaning Minified Files <====="
	$Q git checkout -- minified/lumia.min.js
	$Q git checkout -- minified/lumia.min.js.map
