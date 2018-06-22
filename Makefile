# Bash is required so `source` can load env vars in targets.
SHELL := /bin/bash

# Filter either by calling phpunit directly, or
# make test args="--filter=MyClass::MyMethod"
test:
	vendor/bin/phpunit ${args}

# Functional tests
testf:
	source .env.test && vendor/bin/phpunit -c phpunit_functional.xml ${args}

cov:
	./vendor/bin/phpunit --coverage-html tests/unit/coverage

fix:
	php-cs-fixer fix ./src/

generate-types:
	php bin/generate.php types

generate-methods:
	php bin/generate.php methods


