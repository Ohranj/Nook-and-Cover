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

** In addition, create an empty mysql folder in the root of your project. This is used to persist the data as you bring the image up and down. **

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

For Browsersync, you may use the below, opening up the returned external url;
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



## About the project
Nook and Cover allows users to review books in a more sequential manner. Rather than reviewing on completing the book, users are promoted to review the book on a chapter by chapter basis. Allowing them to see how their opinion changes. The site facilitates interaction with others and allows both the discovery and discussion in how the opinion of others evolves in comparison to yours. Finally, Nook and Cover serves as a place to upload a snapshot of your reading corner on an interactive map. 

## TECH
 - Laravel
 - Tailwind css
 - Alpine JS

Hosting of the site is done via AWS EC2. A link will folllow.