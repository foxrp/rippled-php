
test:
	vendor/bin/phpunit

testcov:
	./vendor/bin/phpunit --coverage-html coverage

fix:
	php-cs-fixer fix ./src/
