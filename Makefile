# Filter either by calling phpunit directly, or
# make test args="--filter=BookOffersMethodTest"
test:
	vendor/bin/phpunit ${args}

cov:
	./vendor/bin/phpunit --coverage-html tests/coverage

fix:
	php-cs-fixer fix ./src/
