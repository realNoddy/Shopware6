# Shopware6
v6.5.4.1

## Development environment:

### Windows 10

### Docker

```
version: "3"

services:
  shopware:
    image: dockware/dev:6.5.4.1
    ports:
      - 80:80
      - "443:443"
    volumes:
      - "dockware_dev_db:/var/lib/mysql"
      - "dockware_dev_html:/var/www/html"

    environment:
      - APP_URL=http://localhost
      - XDEBUG_ENABLED=0
      - XDEBUG_REMOTE_HOST=localhost
      - PHP_IDE_CONFIG=idekey=VSCODE
      - PHP_VERSION=8.1
      - NODE_VERSION=16

volumes:
  dockware_dev_db:
    driver: local
  dockware_dev_html:
    driver: local
```

On my end this docker setup was only running for the first time, when you compose it. 
If you stop it and try to run it again, it will crash.
However any other docker image/container I tried, wasnt able to compile the JaveScript files or didnt start at all. 
