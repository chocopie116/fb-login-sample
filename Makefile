PHP=$(shell which php)

setup:
	$(PHP) -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"
install: setup
	$(PHP) composer.phar install
