# Docker Compose for Webserver service
Compose is a tool for defining and running multi-container Docker applications. With Compose, you use a `YAML` file to configure your application’s services. Then, with a single command, you create and start all the services from your configuration.

Using Compose is essentially a three-step process:

1. Define your app’s environment with a `Dockerfile` so it can be reproduced anywhere.
2. Define the services that make up your app in `docker-compose.yml` so they can be run together in an isolated environment.
3. Run `docker compose up` and Docker Compose starts and runs your entire application.

>Step 1 was already covered at the beginning of the tutorial

## Docker Compose commands to start/stop the Web Server
This is the `yaml` file to run the Web Server detached.

1. To **start** the Web Server environment, just type the following command:

```sh
docker compose -f docker-compose.yml --project-name webserver up -d
```

2. To **stop** the server, just type the following command:

```sh
docker compose -f docker-compose.yml --project-name webserver rm -fs
```

## YAML file to start the Web Server
Following is the `docker-compose.yml` file. Refer the the actual file on the Git repo. This is only a copy/paste.

```yaml
# docker-compose.yml
# Start the container: docker compose -f docker-compose.yml --project-name webserver up -d
# Stop the container: docker compose -f docker-compose.yml --project-name webserver rm -fs
version: '3.9'
services:
  webserver:
    image: php8_nginx:3.17.3
    deploy:
      replicas: 1
    expose:
      - "8080"
      - "8443"
    ports:
      - "8080:80"
      - "8443:443"
    volumes:
      - type: bind
        source: $PWD/www
        target: /www
        read_only: true
      - type: bind
        source: $PWD/www
        target: /var/log/nginx
    restart: unless-stopped
    environment:
      - TZ=EAST+5EDT,M3.2.0/2,M11.1.0/2
      - TIMEZONE=America/New_York
    container_name: web
    hostname: webserver
```

## Useful commands
Command to list running compose projects:
```sh
docker compose -f docker-compose.yml ls
```

Command to display the running processes for the project:
```sh
docker compose -f docker-compose.yml --project-name webserver top
```

Command to list containers for the project (you should have only one 😀):
```sh
docker compose -f docker-compose.yml --project-name webserver ps
```

Command to list the images used by the created containers for the project:
```sh
docker compose -f docker-compose.yml --project-name webserver images
```

## Test
To the Web Server, open you favorite browser and type this URL: http://localhost:8080

You can alos use cURL by opening your terminal and type:
```sh
while true; do curl http://localhost:8080/test.php; sleep 1; done
```
>This runs the command is a loop

## Logging
In case you run into problems, you can start logging the compose project with the command:
```sh
docker compose -f docker-compose.yml --project-name webserver logs -f
```

Open a terminal and look at the file `access.log` or `error.log`:
```sh
tail -f www/access.log
```

<p align="left">(<a href="README.md">back to the main page</a>)</p>
