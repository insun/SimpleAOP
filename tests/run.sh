#! /bin/sh

clear
phpunit --coverage-html ./coverage-html --bootstrap bootstrap.php .
echo "\n"