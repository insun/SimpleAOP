#! /bin/sh

clear

echo '********************'
echo '*** First use case'
php benchmark_without_aop.php --repeat 7 --debug 0 --module FirstUseCase
php benchmark_with_aop.php --repeat 7 --debug 0 --module FirstUseCase

echo '*** Second use case'
php benchmark_without_aop.php --repeat 7 --debug 0 --module SecondUseCase
php benchmark_with_aop.php --repeat 7 --debug 0 --module SecondUseCase