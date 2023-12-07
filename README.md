# MyKirito Proxy Interface

我的桐人遊戲代理介面。

## Quick Start

```bash
# Required: Go to `src` and run Laravel environment-independent initialization commands
cd src
cp .env.example .env

# Required: Go back to root and build Docker containers
cd ..
docker/build/up

# Required: Go into the main Docker container to install dependencies
docker exec -it MyKirito-Proxy-Interface-Main zsh
composer i
php artisan key:generate
npm ci

# Required: Generate ES256 certificates for JWT. If you are just cloning this project for studying, ignore this
php artisan jwt:generate-certs --force --algo=ec --curve=prime256v1 --sha=256

# Optional, but recommended, enhance your developement experience (esp. Visual Studio Code)
php artisan ide-helper:generate
php artisan ide-helper:models
php artisan ide-helper:meta

# Required: finally, you should build the frontend pages for displaying
npm run dev
```
