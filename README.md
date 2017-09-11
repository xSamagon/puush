# puush

This puush server "emulation" is based on the puush server of "ajanvier" (even if not much is left :D of his code).
Puush.me doesn't allow to register an account since a few weeks, so maybe the login will be offline too in the future.
I wrote the missing Auth-API for this emulator.

# Setup
## Server
## Requirements
You need an webserver with PHP and MySQL. I added only the RewriteRules for Apache, if you want to use NGINX or something else, you have to adapt them!

## Setup

```sql
First of all create a database and execute the following query:
CREATE TABLE `accounts` (
  `email` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `apikey` varchar(200) NOT NULL,
  `domain` varchar(200) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
```