## ENV
```
DB_CONNECTION=mysql
DB_HOST=[service name from docker-compose.yml]
DB_PORT=[Port value from docker-compose.yml - mysql service]
DB_DATABASE=[Database from docker-compose.yml - mysql service]
DB_USERNAME=[User from docker-compose.yml - mysql service]
DB_PASSWORD=[Password from docker-compose.yml - mysql service]
```



## Docker

** Make sure that you have docker installed on your machine **

To build and run the project. From this you can visit localhost in your browser
```
sudo docker compose up -d --build
```

For shell access in the containers, can be done as so. Note that DB credentials are in the docker-compose.yml file.
```
sudo docker compose exec php /bin/sh
sudo docker compose exec mysql /bin/sh
```

Artisan, composer and npm commands can be run as such
```
sudo docker compose run --rm composer [command]  
sudo docker compose run --rm artisan [command]  
sudo docker compose run --rm npm [command]   
```

For Browsersync, you may use
```
sudo docker compose run --rm npm run watch
```

To bring down the image
```
sudo docker compose down
```


### Permissions
```
sudo docker compose exec php /bin/sh
chown -R www-data:www-data .
```
