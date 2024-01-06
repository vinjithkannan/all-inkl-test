# Development Environment Setup

* Development Setup is dockerized
* Container managed with in repo itself
* Docker container is managing 3 container
  * all-inkl-test Web - all-inkl-nginx
  * all-inkl-test App - all-inkl-app
  * all-inkl-test DB - all-ink-database

## Build and Run Containers

### Follow the commands to build and run the containers
  * Download and install Docker (https://docs.docker.com/engine/install/)
  * Clone the repo (https://github.com/vinjithkannan/all-inkl-test.git) 
  
  * ```shell
    git clone https://github.com/vinjithkannan/all-inkl-test.git
    git fetch origin docker-development  
    git checkout docker-development
    
    cd <path of the directory cotais the source>   
    \> docker-compose up --build  # only for very first time    
       # once build completed terminal will show the three containers are running
       # from next time up and run only need
    \> docker-compose up
    
    ````
  * Once containers where up, dev env will able to browse with url
  #### (http://localhost)

  * ```shell
    docker exec -it all-inkl-app
    /var/www/# composer dump-autoload
  ```
