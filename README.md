# Using this repository

1. clone this repository using https (you must provide username and password of github if using this method) or ssh (you must provide ssh keys if you using this method)
```bash
$ git clone https://github.com/digital-inovasi-bangsa/new-dupak.git
```
2. enter directory
```bash
$ cd new-dupak/
```
3. open your code editor based this directory

# Config - Using dotenv

Why using dotenv ? follow the [12 Factor](https://12factor.net/) that we must apply as developer.

How to use dotenv ?
1. instal [composer](https://getcomposer.org/download/) first, follow instruction in link.
2. install [phpdotenv](https://github.com/vlucas/phpdotenv)
```bash
php composer.phar require vlucas/phpdotenv
```
3. after success, you can see new folder called vendor
4. change copy `.env.example` and rename to `.env`
5. fill value of credential variable of `.env` (ask yogi to credential)

# Woring with git

You must provide what doyou work based on issues.

1. Open issue ("#23" for example)
2. Locally create branch from desired branch, as usual I name branch i{issue_number} (i23)
```bash
$ git checkout -b i23
```
3. Once, i've done fixes for issue, commit issue and push to branch i23
```bash
$ git commit -am "fixes #23"
$ git push
```
4. Once, i've done fixes for issue I create pull request and in the pull request body write "fixes #23"
5. This automatically closes "issue #23"

# Docker 

1. Build Docker
```bash
$ docker build -t dupak-basarnas:v1.0.0-dev .
```
2. Running Docker
```bash
$ docker run --name dupak-basarnas --rm -v "$(pwd)":/var/www/dupak-basarnas dupak-basarnas:v1.0.0-dev
```
3. Running Mysql On Docker
```bash
$ 
```
