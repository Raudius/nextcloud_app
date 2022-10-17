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
