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
- Webpack (ES6 🎉)
- Composer with autoloader
- Hashed production assets. No more hasseling with caching or version parameters👋
- Lint SCSS & JS files
- Critical CSS - This is automatically build for the homepage, though you could quite easily expand this to other pages

**Plugins:**
- [Timber](http://upstatement.com/timber/)
- [Cuisine](http://docs.get-cuisine.cooking/core/)
- A simple patternlab plugin
- Some frequently used plugins like Yoast SEO

Getting started - Server part
---------------

We use a vagrant box with nginx and php7. It includes a custom provision script called `provision.sh`.

> **NOTE** You only have to do the following **two steps** the very first time you use this boilerplate.
#### Download the base box

Download the .box file from [https://corjen.stackstorage.com/index.php/s/19qLztoSvs4cIJA](https://corjen.stackstorage.com/index.php/s/19qLztoSvs4cIJA) and put it in the repo folder

#### Import the box

Import the box by running:

```vagrant box add ubuntu-16.04-php7-mysql-v1.0 ubuntu16-php7-mysql.box```

This will save the box to ```~/.vagrant.d/boxes/ubuntu-16.04-php7-mysql-v1.0```

> **NOTE** You need to follow the steps below every time.

#### Clone & install

- Clone this repo by running `git clone --recursive https://github.com/Corjen/wordpress-gulp-webpack-composer-starter-pack.git my_project_folder`

- In `.Vagrantfile` and `provision.sh`, change every occurence of `example.dev` to your local development URL`

- Also, in `provision.sh`, change the url on this line `rewrite ^ http://mylivesite.com/$uri;` to you live site url. This will lookup an image on your live site when it has a local 404.

- If needed, change the ip adres and port in `.Vagrantfile`

> You will need to add the development URL and ip adres to your hosts file. For OSX, just run `sudo nano /etc/private/hosts` and add a rule like `192.168.50.1 example.dev`

#### Connecting to the database


You can authenticate to the db with username *dev* and passsword *dev*. MySQL is running on localhost.

If you want to do database management with something like Sequel Pro you can use the following settings:

- MySQL Host *127.0.0.1*
- Username *dev*
- Password *dev*
- SSH Host *Fill in the ip adress you've set in Vagrantfile*
- SSH User *vagrant*
- SSH Key *Point it to: ~/.vagrant.d/insecure_private_key*


**Your server is good to go!** Simply run `vagrant up` in your root folder and lookup your development URL in the browser.

Getting started - Theme part
---------------

- Run ```npm install``` inside the root folder
- In `gulpconfig.js` change every occurence of *example* to your project name/url
- In `package.json` change the *name*, *description*, *repo* and *license* if needed
- In `composer.json` change the name

#### Wordpress config

- `public/wp-config.php` is split into three seperate files, located in `public/config`. Change the url and database credentials in `wp-config.php` and `public/config/development.php`

> The WP_ENV constant is set in `wp-config.php`, you can use this in your theme. The value will be *dev*, *stage* or *prod* based on your environment.

### Theme files
- Your namespace (in php files) will be Example\Lib, since your project probably isn't called *Example*, change this to your prefference. E.g in `functions.php` and the php files in `/lib`

#### Composer

- Install composer dependencies by running `composer install` inside the `src` folder.

Development
---------------
- To start, simply run `npm run start`. This will clean your build folder and run browsersync. Go to [http://localhost:3000/](http://localhost:3000/) to view your project.
- To run webpack (for javascript files), run `npm run dev` in a seperate terminal tab.

> The webpack server is bound to your local IP, like 192.168.2.101:8080/bundle.js. This way you can fully test your project locally on seperate devices. Check `Lib/Settings.php` for how this is enqueued.

Building for production
-----------------------
To build for production, simply run `npm run build`.

Building for production will do a couple of tasks(in order):

- **lint** - Lint your scss, php and js files
- **test** - You can fill in your own preferred testing utility here. Currently it's just an empty script.
- **clean:dist** - This will delete you */dist* folder and create a new one
- **build** - this will run a sequence of build tasks, which will output into the `/dist/` folder.



Additional tips & tricks
------------------------

- CSS and JS builds are hashed by default after being build for production. Please check `Lib/Settings.php` on how they are enqueued.

- When you're developing a new project, it can be useful to build for production, commit the *dist/* folder and push in a single command. You can do that by running `npm run deploy`

Deploying
------------------------

I highly recommend using a deploy tool like [Capistrano](http://capistranorb.com/) or [DeployHQ](https://www.deployhq.com/). Alternatively, you could use (s)ftp.

You need to deploy two folders:
- `/public` to your site root
- `/dist` to your theme folder, e.g. *wp-content/themes/theme_name*
