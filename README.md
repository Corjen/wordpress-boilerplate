Wordpress development boilerplate
===========

> **NOTE:** this is a combined repo of these [vagrant-ubuntu-16.04-php7-mysql-provision](https://github.com/Corjen/vagrant-ubuntu-16.04-php7-mysql-provision) and [wordpress-gulp-webpack-composer-starter-pack](https://github.com/Corjen/wordpress-gulp-webpack-composer-starter-pack) repos.

Before you dive in; this is a highly opinionated starter pack which gives a very smooth developer experience. There are a lot of other great options around that offer more freedom in the choice of your tools.

I use this for myself as the start of every WordPress project. It has gone trough a lot of tweaking and improving. If you have any issues or recommendations, I would love to hear them!

About
---------------
This is a starter pack for developing WordPress projects. The project structure is much like 'regular' software developing. E.g, a */src* folder for all your source files, a */build* folder for local development builds and a */dist* folder for production builds.

###Features

- WordPress as a submodule - see [wordpress-boilerplate](https://github.com/Darep/wordpress-boilerplate) on how to update WordPress
- Seperate configs for development, staging and production environments
- Gulp with browsersync
- SCSS
- JPG, PNG, SVG image minification
- Bundles SVG icons to a single file
- Prettier & ESLint
- Webpack (ES6 🎉)
- Composer with autoloader
- Hashed production assets. No more hasseling with caching or version parameters👋

**Plugins:**
- [Timber](http://upstatement.com/timber/)
- [Cuisine](http://docs.get-cuisine.cooking/core/)
- [Pageblocks](https://github.com/Corjen/wordpress-pageblocks.git)
- A simple patternlab plugin
- Some frequently used plugins like Yoast SEO


We use a vagrant box with nginx and php7. It includes a custom provision script called `provision.sh`.

Getting started
---------------

- Ensure you've installed docker & docker-compose

#### Connecting to the database

Your server (including mysql) will run on localhost:7200. You can connect to the database with something like Sequel Prop using the following settings:


- MySQL Host *127.0.0.1:7200*
- Host: *mysql*
- Username *docker*
- Password *docker*
- Database name *docker*

**Your server is good to go!** Simply run `docker-compose up` in your root folder and lookup http://localhost:7200 in your browser.

Getting started - Theme part
---------------

- Run ```yarn install``` inside the root folder
- In `gulpconfig.js` change every occurence of *example* to your project name/url
- In `package.json` change the *name*, *description*, *repo* and *license* if needed
- In `style.css` change the theme name & author
- In `composer.json` change the project name

#### Wordpress config

- `public/wp-config.php` is split into three seperate files, located in `public/config`. Change the url and database credentials in `wp-config.php` and `public/config/development.php`

> The WP_ENV constant is set in `wp-config.php`, you can use this in your theme. The value will be *dev*, *stage* or *prod* based on your environment.

### Theme files
- Your namespace (in php files) will be Example\Lib, since your project probably isn't called *Example*, change this to your preference. E.g in `functions.php` and the php files in `/lib`

#### Composer

- Install composer dependencies by running `composer install` inside the `src` folder.

Development
---------------
- To start, simply run `npm run start`. This will clean your build folder and run browsersync. Go to [http://localhost:3000/](http://localhost:3000/) to view your project.
- To run webpack (for javascript files), run `npm run dev` in a seperate terminal tab.

Building for production
-----------------------
To build for production, simply run `npm run build`.

Building for production will do a couple of tasks(in order):

- **test** - You can fill in your own preferred testing utility here. Currently it's just an empty script.
- **build** - this will run a sequence of build tasks, which will output into the `/dist/` folder.


Additional tips & tricks
------------------------

- CSS and JS builds are hashed by default after being build for production. Please check `Lib/Settings.php` on how they are enqueued.

