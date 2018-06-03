# Filter either by calling phpunit directly, or
# make test args="--filter=BookOffersMethodTest"
test:
	vendor/bin/phpunit ${args}

cov:
	./vendor/bin/phpunit --coverage-html coverage

fix:
	php-cs-fixer fix ./src/
