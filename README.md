# Weather app

## Install (using docker compose)

### clone repository
``git clone https://github.com/ivarsju/weather.git``

### run docoker compose
``docker compose up -d``

### run migrations
``php bin/console doctrine:migrations:migrate``

### open localhost in browser
``https://localhost/``

## load weather data (console)

### run command
``php bin/console app:get-weather weatherstack riga 2022-10-10``

### consume messenger
``php bin/console messenger:consume async -vv``

