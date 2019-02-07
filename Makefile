install:
	composer install

test:
	composer run-script tests

lint:
	composer run-script phpcs -- --standard=PSR12 src tests 

lint-fix:
	composer run-script phpcbf -- --standard=PSR12 src bin
	
