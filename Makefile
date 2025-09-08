.DEFAULT_GOAL= help
.PHONY:

help:
	make -pn | grep "^.PHONY:"

init-database:
	cd packages/device-manager && bin/console migrations:migrate --no-interaction

init-fixtures:
	cd packages/device-manager && tests/console doctrine:fixtures:load

cs:
	vendor/bin/phpcs

cs-fix:
	vendor/bin/phpcbf

phpstan:
	vendor/bin/phpstan analyse -c phpstan.neon --no-progress --memory-limit=1G

phpstan-baseline:
	vendor/bin/phpstan analyse -c phpstan.neon --generate-baseline phpstan-baseline.neon

unit:
	vendor/bin/phpunit -c phpunit.xml
