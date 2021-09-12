cp app/config/parameters.php.test app/config/parameters.php
cp -rf app/config/certs/travis.crt.dist app/config/certs/travis.crt
cp -rf app/config/certs/travis.key.dist app/config/certs/travis.key

# Setup real database for Functional Tests suite
mysql -uroot -e "create database idm_db;" -pDotb123
./bin/console migrations:migrate --no-interaction && ./bin/console fixtures:load
