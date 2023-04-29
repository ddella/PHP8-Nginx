# Docker Compose for Webserver service
Compose is a tool for defining and running multi-container Docker applications. With Compose, you use a `YAML` file to configure your application’s services. Then, with a single command, you create and start all the services from your configuration.

Using Compose is essentially a three-step process:

1. Define your app’s environment with a `Dockerfile` so it can be reproduced anywhere. (refer to the main page to build the image)
2. Define the services that make up your app in `docker-compose.yml` so they can be run together in an isolated environment.
3. Run docker compose up and the Docker compose command starts and runs your entire app.

>Step 1 was already covered at the beginning of the tutorial

## Docker Compose commands to start the FakeAPI Server
This is the `yaml` file to run the FakeAPI Server detached.

1. To start the FakeAPI environment, just type the following command:

```sh
cd www
docker compose -f ../docker-compose.yml --project-name webserver up -d
```
>This will start the `web` container. I changed directory to `www` so make sure you points to the `docker-compose.yml` one level up.

2. To stop the server, just type the following command:

```sh
docker compose rm -f -s webserver
```
>As of this writing, the command didn't worked. I used `docker rm -f web`

## YAML file to start the FakeAPI Server
The `docker-compose.yml` file:

```yaml
# docker-compose.yml
# Start the container: docker compose -f docker-compose.yml --project-name webserver up -d
# Stop the container: docker compose rm -f -s webserver
# Stop the container: docker rm -f web
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
        source: $PWD
        target: /www
        read_only: true
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
docker compose ls
```

Command to display the running processes for the project:
```sh
docker compose top webserver
```

Command to list containers for the project:
```sh
docker compose ps webserver
```

Command to list the images used by the created containers for the project:
```sh
docker compose images webserver
```

## Logging
In case you run into problems, you can start logging the compose project with the command:
```sh
docker compose logs -f webserver
```

You get the logs from the FakeAPI and Redis container.

<p align="left">(<a href="README.md">back to the main page</a>)</p>
