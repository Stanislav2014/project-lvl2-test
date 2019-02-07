install:
	composer install

test:
	composer run-script phpunit

lint:
	composer run-script phpcs -- --standard=PSR12 src tests 

lint-fix:
	composer run-script phpcbf src bin
	
