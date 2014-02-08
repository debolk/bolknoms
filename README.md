# Bolknoms

## Project is obsolete
This project is obsolete and has been superseded by bolknoms2, available at [debolk/bolknoms2](http://www.github.com/debolk/bolknoms2). Development on this project has been halted and new issues will not be taken into consideration. Please report any issues against the new repository. 

The very best application in the world for feeding your members in an organized and predictable way.

## Requirements
* PHP 5.2.3+
* SQL-compatible database
* Something to send e-mails with

## Installation
1. Clone the repository using git
1. Copy the following configuration files and change as needed
    1. application/config/database.sample.php -> application/config/database.php
    1. application/config/bolknoms.sample.php -> application/config/bolknoms.php
    1. public/.htaccess.sample -> public/.htaccess
1. Create a database and execute all migrations (/migrations/*.sql) in alphabetical filename order
1. Install the dependencies using composer by executing `composer install`
1. The application/cache and application/logs must be writeable by the server
1. Upload to your server
1. Point your servers webroot to /public/

## Usage
Create a meal using the administration panel. Anyone can use the front-end interface to subscribe to that meal.

### Maintenance mode
You can put the application in maintenance mode by copying public/maintenance.sample.html to public/maintenance.html. Please note that this is only a simple HTML-page and that the application will be accessible to anyone who knows the URLs.

## Architecture
Bolknoms is built using the latest version of the [Kohana framework](http://kohanaframework.org/).

## Project organisation
The repository follows the [nvie branching model](http://nvie.com/posts/a-successful-git-branching-model/). The master branch contains all features currently in deployment. The develop branch contains all stable features. Any new work must be branched of in a feature branch. These branches are prefixed with "feature-", for example "feature-moreswedishchef". Preferrably no underscores.

## License
Copyright 2012-2013 [Jakob Buis](http://www.jakobbuis.com). Distributed under the [GNU Lesser General Public License, version 3.0](http://opensource.org/licenses/lgpl-3.0.html).
