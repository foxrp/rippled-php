
test:
	vendor/bin/phpunit

cov:
	./vendor/bin/phpunit --coverage-html coverage

fix:
	php-cs-fixer fix ./src/
