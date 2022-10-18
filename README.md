# Nextcloud App Starter
Startup project for Nextcloud app development. 

The project comes with a simple "hello world" modal which shows every page load for some apps (such as the Files app). Annoying, I know.

## Set-up

1. `cd` into the `apps` directory of your development Nextcloud
```shell
# Location may vary, some examples:
cd /var/www/html/apps/
cd ~/nextcloud-docker-dev/workspace/server/apps/
```

2. Initiate project
```shell
composer create-project \
  raudius/nextcloud_app . "dev-main" \
  --repository '{"type": "vcs", "url": "https://github.com/Raudius/nextcloud_app"}' \
  --ask
```

3. `cd` into project directory and call the init script
```shell
cd nextcloud_app # Change to your project's directory
php init.php
```

4. Go through the init script steps and Bob's your uncle.


## Front-end (Typescript + Vue)

The project comes with all the required config files to start developing in Typescript using the Vue framework.

```shell
npm install    # Make sure you install dependencies 

npm run dev    # Compiles development build
npm run watch  # Auto-compiles for development when changes are detected
npm run build  # Compiles production build
```

## Unit testing

The project comes with PHPUnit set up. Just create a filein `test/unit` that ends in `Test`. An example one is already included.

```shell
composer install        # Make sure you install dependencies 
composer run test:unit  # Run the PHPUnit test suite
```

## Linters (cs-fixer + eslint)

```shell
composer run cs:check  # Check syntax
composer run cs:fix    # Fix syntax
```

```shell
npm run lint     # Check syntax
npm run lint:fix # Fix syntax
```
