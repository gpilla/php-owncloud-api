# Object Oriented PHP Owncloud API (php-owncloud-api)

An object oriented API to consume

It is still on development, for now we only have

## FileSharing

### Get all shares

See: http://doc.owncloud.org/server/6.0/admin_manual/sharing_api/get_all_shares.html

Usage:

$api = new Api('http://somewhere.com', ['user', 'password']);
$shares = $api->fileSharing()->getAllShares();

### Get one share

$api = new Api('http://somewhere.com', ['user', 'password']);
$share = $api->fileSharing()->getShare(1); // You should send the share ID as parameter

### Create a new share

$api = new Api('http://somewhere.com', ['user', 'password']);
$share = $api->fileSharing()->createNewShare('path/to/file/or/folder', ['shareType' => Owncloud\Api\FileSharing::SHARE_TYPE_PUBLIC_LINK]); // You should send the share ID as parameter

### Delete a share

## TODO:

* Manage by webdav files, listings, download, upload, etc.
* Create a object entity to manage the File.
* Internationalization of message errors.

