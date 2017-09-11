# puush

This puush server "emulation" is based on the puush server of "ajanvier" (even if not much is left :D of his code).
Puush.me doesn't allow to register an account since a few weeks, so maybe the login will be offline too in the future.
I wrote the missing Auth-API for this emulator.

# Setup
## Server
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
Puush uses this key to authentificate while uploading and so on. Just make sure you use unique strings.
Example: 90AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA

**What means "domain"? // I don't have an extra domain?**
Well, it's simple. You **can** choose a different domain for every user, but the images are avaiable on all domains.
Of course you can use only one domain or only the ip of your server.
Just make sure to add every domain/hostname/ip in your RewriteRules.

### RewriteRules

