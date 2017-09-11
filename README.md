# puush

This puush server "emulation" is based on the puush server of "ajanvier" (even if not much is left :D of his code).
Puush.me doesn't allow to register an account since a few weeks, so maybe the login will be offline too in the future.
I wrote the missing Auth-API for this emulator.

# Server
## Requirements
You need an webserver with PHP and MySQL. I added only the RewriteRules for Apache, if you want to use NGINX or something else, you have to adapt them!

## Setup

### SQL
First of all create a database and execute the following query:
```sql
CREATE TABLE `accounts` (
  `email` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `apikey` varchar(200) NOT NULL,
  `domain` varchar(200) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```

It creates the table "accounts", here you can add some useraccounts.

**What means "apikey"?**

Puush uses this key to authentificate while uploading an image and so on. Just make sure you use unique strings.
Examples: 90AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA, 90AAAAAAAAAAAAAAAAAAAAAAAAAAAAAB, 90AAAAAAAAAAAAAAAAAAAAAAAAAAAAAC

**What means "domain"? // I don't have an additional domain?**

Well, it's simple. You **can** choose a different domain for every user, but the images are avaiable on all domains.
Of course you can use only one domain or only the ip of your server.
Just make sure to add every domain/hostname/ip in your RewriteRules.

### RewriteRules
I commited a .htaccess file as example. It has two image domains included.

As you can see in it, you just have to duplicate the following part and adapt the domain (img.DOMAIN1.de):

```sql
RewriteCond %{HTTP_HOST} img.DOMAIN1.de$ [NC]
RewriteRule ^([a-zA-Z0-9]+)$ view.php?image=$1 [NC,L]

RewriteCond %{HTTP_HOST} img.DOMAIN1.de$ [NC]
RewriteCond %{REQUEST_FILENAME} !-d 
RewriteCond %{REQUEST_URI} !\.(php)$
RewriteRule ^([a-zA-Z0-9]+).([a-zA-Z0-9]+)$ view.php?image=$1 [NC,L]
```

With this RewriteRules you are able to access your picture without extension or like puush.me with any extension you like.
**Example:**
You uploaded the image asd239asdj.png.
You can access it via:
* img.DOMAIN1.de/asd239asdj
* img.DOMAIN1.de/asd239asdj.png
* img.DOMAIN1.de/asd239asdj.extension
* img.DOMAIN1.de/asd239asdj.WhatEverYouWant

### PHP
I think I don't have to say much about this. Just upload the files on your server and adapt the following two configs.
* include/config/Database.conf.php
* include/config/Global.conf.php

Make sure you give enough permissions to the files! ( Remember, it has to store files on the server ;) )

# Client
## Requirements
You need access to the hosts file of the client and you need the old puush uploader (You can find the uploader in the folder client, or you can download it @puush.me link is in the same folder too)

## Setup
### Hosts
Add the following line to the hosts file of your client (C:\System32\drivers\etc\hosts):

**IP.OF.YOUR.SRV puush.me**

### Client
Just start it and login with your account details, which you created in the accounts table.


