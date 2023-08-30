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
