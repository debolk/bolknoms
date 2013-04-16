# Bolknoms

The very best application in the world for feeding your members in an organized and predictable way.

## Requirements
* PHP 5.2.3+
* SQL-compatible database
* Something to send e-mails with

## Installation
1. Clone the repository using git
1. Copy config/database.sample.php to config/database.php and fill in the details
1. Copy config/bolknoms.sample.php to config/bolknoms.php and fill in the details
1. Copy public/.htaccess.sample to public/.htaccess and fill in the details
1. Create a database and execute all migrations (/migrations/*.sql) in alphabetical filename order
1. Initialize the git submodules by executing `git submodule init` and `git submodule update`
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

All releases are tagged using [Semantic Versioning 2.0.0-rc.1](http://semver.org/), though earlier releases (up to 1.3.2) have a "v"-prefix.

## License
Copyright 2012 [Jakob Buis](http://www.jakobbuis.com). Distributed under the [GNU Lesser General Public License, version 3.0](http://opensource.org/licenses/lgpl-3.0.html).
