# Basic usage

## FileManagement

Is based on league/flysystem and the API is here: http://flysystem.thephpleague.com/api/

(It will be changed)

Examples:

### Read a file

```php
// As everytime instantiate the API
$api = new Owncloud\Api('http://host.foobar.com/', 'user', 'password');
$api->fileManagement()->read('path/to/the/test/file.txt');
```

## FileSharing

### Get all shares

See: http://doc.owncloud.org/server/6.0/admin_manual/sharing_api/get_all_shares.html

Usage:

```php
$api = new Api('http://somewhere.com', 'user', 'password');
$shares = $api->fileSharing()->getAllShares();
```

### Get one share

```php
$api = new Api('http://somewhere.com', 'user', 'password');
// You should send the share ID as parameter
$share = $api->fileSharing()->getShare(1);
```

### Create a new share

```php
$api = new Api('http://somewhere.com', 'user', 'password');
$share = $api->fileSharing()->createNewShare(
    'path/to/file/or/folder'
    , ['shareType' => Owncloud\Api\FileSharing::SHARE_TYPE_PUBLIC_LINK]
);
```

### Delete a share

```php
$api = new Api('http://somewhere.com', 'user', 'password');
// You should send the share ID as parameter
$share = $api->fileSharing()->deleteShare(1);
```
