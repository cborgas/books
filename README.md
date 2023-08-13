# Books 📚
A simple REST API with Event Sourced persistence that stores Books and their stock levels.

Built with [eventsauce.io](https://eventsauce.io/).

### Setup

1. Install Docker
2. Clone this GitHub Repository
3. Use these commands to get started

- `make build` to build the Docker images.
- `make install` to build and install dependencies.
- `make start` to to start the containers.
- `make stop` to stop the containers.
- `make remove` to remove the images.
- `make exec` to shell into the main container. 
- From the container you can run `composer test` to run the tests or
run `make test` to run them in an isolated container.
