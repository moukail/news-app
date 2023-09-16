#!/usr/bin/env bash

# create new project
# . /home/install.sh

export APP_ENV=dev
rm -rf var vendor composer.lock symfony.lock node_modules yarn.lock package-lock.json
cp .env.develop .env

echo "---------------------------------------------------------------------------------------------------------------------------"
echo "-                                         composer update                                                                 -"
echo "---------------------------------------------------------------------------------------------------------------------------"
symfony composer update --no-interaction #--no-plugins --no-scripts
echo "---------------------------------------------------------------------------------------------------------------------------"
echo "-                                       composer check-platform-reqs                                                      -"
echo "---------------------------------------------------------------------------------------------------------------------------"
symfony composer check-platform-reqs --no-interaction
echo "---------------------------------------------------------------------------------------------------------------------------"
echo "-                                           check:requirements                                                            -"
echo "---------------------------------------------------------------------------------------------------------------------------"
symfony check:requirements
echo "---------------------------------------------------------------------------------------------------------------------------"
echo "-                                              check:security                                                             -"
echo "---------------------------------------------------------------------------------------------------------------------------"
symfony check:security

echo "-------------------------------------------------------------------"
echo "-                        waiting for DB                           -"
echo "-------------------------------------------------------------------"
while ! nc -z news-database 3306; do sleep 1; done
echo "-------------------------------------------------------------------"
echo "-                        prepare the DB                           -"
echo "-------------------------------------------------------------------"
#symfony console doctrine:database:drop --if-exists --force
symfony console doctrine:database:create --if-not-exists
#symfony console doctrine:migrations:diff --no-interaction
symfony console doctrine:migrations:migrate --allow-no-migration --no-interaction
symfony console doctrine:fixtures:load --no-interaction

echo "-------------------------------------------------------------------"
echo "-                        website is ready                         -"
echo "-------------------------------------------------------------------"
chmod -R a+rw ./
symfony server:start --daemon

echo "-------------------------------------------------------------------"
echo "-                        testing                                  -"
echo "-------------------------------------------------------------------"
codecept clean
codecept run --steps

npm install
npm run watch
#symfony server:stop
#symfony server:start