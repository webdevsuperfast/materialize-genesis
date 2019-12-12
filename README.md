# Materialize Genesis

## Introduction

Materialize Genesis is a Genesis Framework child theme that integrates [MaterializeCSS](https://materializecss.com).

## Installation Instructions

1. Upload the `Materialize Genesis` theme folder via FTP to your wp-content/themes/ directory. (The Genesis parent theme needs to be in the wp-content/themes/ directory as well.)
2. Go to your WordPress dashboard and select Appearance.
3. Activate the `Materialize Genesis` theme.
4. Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.

## Building from Source

1. Install [Git](https://git-scm.com/).
2. Clone the repository to your local machine.
3. Install [Node](https://nodejs.org/en/).
4. Install [Yarn](https://yarnpkg.org/).
5. Install [Gulp](https://gulpjs.com/) globally.
6. Run `yarn install` to install dependencies through terminal/CLI program.
6. Replace site url in line `48` of `gulpfile.js` to your local development URL(e.g. http://bootstrap.test).
7. Run `gulp` through your favorite CLI program.

**Note:** I suggest using package manager to install Git, Node and Yarn. You can use [Homebrew](httsp://brew.sh) if you're on a Mac or Linux/WSL, [Scoop](https://scoop.sh) or [Chocolatey](https://chocolatey.org/) if you're on Windows.

## Features

1. MaterializeCSS
2. Bootstrap components
	* Comment Form
	* Search Form
	* Navbar
3. Sass
4. Gulp
5. Footer Widgets(modified to add MaterializeCSS column classes based on the number of widget areas)
7. TGM Plugin Activation Support

## Issues

* Multi-level dropdown

## Credits

Without these projects, this theme wouldn't be where it is today.

* [Genesis Framework](http://my.studiopress.com/themes/genesis/)
* [MaterializeCSS](https://materializecss.com)
* [Sass](http://sass-lang.com/)
* [Gulp](http://gulpjs.com/)
* [TGM Plugin Activation](http://tgmpluginactivation.com/)
* [WP Bootstrap Navwalker](https://github.com/twittem/wp-bootstrap-navwalker)
* [Bootstrap Genesis](https://github.com/salcode/bootstrap-genesis)
* [Bones for Genesis 2.0 with Bootstrap integration](https://github.com/jer0dh/bones-for-genesis-2-0-bootstrap)