# Advanced Caching Web Summer Camp Workshop 2021

This repository contains the code for the "Advanced Caching" workshop at
[Web Summer Camp 2021](http://2021.websummercamp.com/). The solution for 
each lession corresponds to a branch name starting with 01. But please 
use it only if you're stuck and are falling behind, also do not skip ahead.

## Requirements
- PHP 7.x or 8.x
- [Composer](https://getcomposer.org/)
- [Symfony CLI](https://symfony.com/download)
- [Postgres](https://www.postgresql.org/) or some other DB supported by doctrine
- ab ([apache bench](http://httpd.apache.org/docs/2.4/programs/ab.html) - recommended, available via apache2-utils apt package)
- [Varnish 6.x](https://varnish-cache.org/)

## Setup

If you are using the virual machine provided by Web Summer Camp, everything should be setup for you, just do a git pull.
Otherwise setup the project locally:
- git clone git@github.com:jstuhli/websc2021.git
- cd websc2021
- composer install

## Structure

The application is a simple Symfony app that we're going to use to demonstrate and test out different cache options.
I've chosen Symfony as the framework, but the same principles apply any framework and language.

Layout of a Symfony application is as follows:

- `bin/console` - command line for various tasks
- `public/index.php` - Main application entrypoint
- `config/` - folder where configuration files exist
- `src/` - Location for Controllers, Entities and Repositories

## Exercises

We are going to start with a simple.php script to get a grip on the basic. 
Afterwards we'll progress to the symfony application that you have checed out with this repo.
If you get stuck you can checkout the branch for solutions, but ask for help before doing that :)