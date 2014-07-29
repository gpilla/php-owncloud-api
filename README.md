# Object Oriented PHP Owncloud API

[![Build Status](https://travis-ci.org/gpilla/php-owncloud-api.svg?branch=master)](https://travis-ci.org/gpilla/php-owncloud-api)
[![Coverage Status](https://coveralls.io/repos/gpilla/php-owncloud-api/badge.png)](https://coveralls.io/r/gpilla/php-owncloud-api)
[![Latest Stable Version](https://poser.pugx.org/gpilla/php-owncloud-api/v/stable.svg)](https://packagist.org/packages/gpilla/php-owncloud-api) [![Total Downloads](https://poser.pugx.org/gpilla/php-owncloud-api/downloads.svg)](https://packagist.org/packages/gpilla/php-owncloud-api) [![Latest Unstable Version](https://poser.pugx.org/gpilla/php-owncloud-api/v/unstable.svg)](https://packagist.org/packages/gpilla/php-owncloud-api) [![License](https://poser.pugx.org/gpilla/php-owncloud-api/license.svg)](https://packagist.org/packages/gpilla/php-owncloud-api)

An object oriented API to consume from PHP. The idea of this API is to manage all the files
download, upload and sharing.

It is still on development, for now we only have this:

## FileSharing

### Get all shares

See: http://doc.owncloud.org/server/6.0/admin_manual/sharing_api/get_all_shares.html

Usage:

```php
$api = new Api('http://somewhere.com', ['user', 'password']);
$shares = $api->fileSharing()->getAllShares();
```

### Get one share

```php
$api = new Api('http://somewhere.com', ['user', 'password']);
// You should send the share ID as parameter
$share = $api->fileSharing()->getShare(1);
```

### Create a new share

```php
$api = new Api('http://somewhere.com', ['user', 'password']);
$share = $api->fileSharing()->createNewShare('path/to/file/or/folder', ['shareType' => Owncloud\Api\FileSharing::SHARE_TYPE_PUBLIC_LINK]);
```

### Delete a share

```php
$api = new Api('http://somewhere.com', ['user', 'password']);
// You should send the share ID as parameter
$share = $api->fileSharing()->deleteShare(1);
```

## TODO:

* Manage by webdav files, listings, download, upload, etc.
* Create a object entity to manage the File.
* Internationalization of message errors.
