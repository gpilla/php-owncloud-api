# Installation

Through composer, simply run :

```bash
$ php composer.phar require gpilla/php-owncloud-api:dev-master
```
Or edit your composer.json:

```json
// composer.json
{
    "require": {
        "gpilla/php-owncloud-api": "dev-master"
    }
}
```

## For development

```bash
$ git clone https://github.com/gpilla/php-owncloud-api.git
$ cd php-owncloud-api
$ php composer.phar install --dev
```

In the contrib folder there is a hook for checking phpunit and phpcs before commiting.
