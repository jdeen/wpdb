# JDeen WPDB

WPDB is a MIT licensed simple script that can be used to configure local database
by means of creating users, databases and assigning users for the database based
on the wp-config.php file of a WordPress installation.

At the moment the scrip is limited in functionality. I just wrote this in a rush
when I returned to WordPress development after nearly a 3 year void and had to
create database and users for a newly cloned repo (of a Digital Ocean running
WordPress droplet).

Please feel fre to hack and play around. If you are interested in a discussion
do open an issue.

Ziyan

## Dependencies

1. PHP
2. Composer - to install dependencies
3. Obviously a WordPress installation and a MySQL DB :P


## Instructions

Getting the source code to run. This is the part that needs composer.

```
~# git clone git@github.com:jdeen/wpdb.git
~# cd wpdb
~# composer install
```

I have made wpdb an executable and I hope it remains so when you clone it
to your machine...

```
~# cp config.yaml.sample config.yaml
~# ./wpdb.php /path/to/wordpress/installation/wp-config.php
```

If you are on Windows, you might need to use `php wpdb.php /path/to/wp-config.php`.
But why Windows when Linux is free ;).

Greetings by JDeen and Happy hacking!