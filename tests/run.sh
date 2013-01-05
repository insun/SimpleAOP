#! /bin/sh

clear
phpunit --colors --process-isolation --coverage-php coverage/ --bootstrap bootstrap.php .