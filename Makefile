SHELL := /bin/bash

EXEC_PHP :=

##
## Library
## ------

rector-check: vendor ## Run the Rector check (https://getrector.org)
	$(EXEC_PHP)  vendor-bin/rector/vendor/bin/rector process --dry-run
.PHONY: rector

rector-fix: vendor ## Run the Rector's fix (https://getrector.org)
	$(EXEC_PHP)  vendor-bin/rector/vendor/bin/rector process
.PHONY: rector

psalm: vendor ## Запустить полный статический анализ PHP кода при помощи Psalm (https://psalm.dev/)
	$(EXEC_PHP) vendor-bin/psalm/vendor/bin/psalm --threads=4 $(file)
.PHONY: psalm

lint: vendor ## Проверить PHP code style при помощи PHP CS Fixer (https://github.com/FriendsOfPHP/PHP-CS-Fixer)
	$(EXEC_PHP) vendor-bin/php-cs-fixer/vendor/bin/php-cs-fixer fix --dry-run --diff --verbose
.PHONY: lint

fixcs: vendor ## Исправить ошибки PHP code style при помощи PHP CS Fixer (https://github.com/FriendsOfPHP/PHP-CS-Fixer)
	$(EXEC_PHP) vendor-bin/php-cs-fixer/vendor/bin/php-cs-fixer fix --diff --verbose
.PHONY: fixcs


help:
	@awk ' \
		BEGIN {RS=""; FS="\n"} \
		function printCommand(line) { \
			split(line, command, ":.*?## "); \
        	printf "\033[32m%-28s\033[0m %s\n", command[1], command[2]; \
        } \
		/^[0-9a-zA-Z_-]+: [0-9a-zA-Z_-]+\n[0-9a-zA-Z_-]+: .*?##.*$$/ { \
			split($$1, alias, ": "); \
			sub(alias[2] ":", alias[2] " (" alias[1] "):", $$2); \
			printCommand($$2); \
			next; \
		} \
		$$1 ~ /^[0-9a-zA-Z_-]+: .*?##/ { \
			printCommand($$1); \
			next; \
		} \
		/^##(\n##.*)+$$/ { \
			gsub("## ?", "\033[33m", $$0); \
			print $$0; \
			next; \
		} \
	' $(MAKEFILE_LIST) && printf "\033[0m"
.PHONY: help
.DEFAULT_GOAL := help
