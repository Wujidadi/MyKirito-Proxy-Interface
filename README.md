# MyKirito Proxy Interface

我的桐人遊戲代理介面。

## Quick Start

```bash
# Go to src and run Laravel initial commands
cd src
composer i
npm ci
cp .env.example .env
php artisan key:generate

# Go back to root and build Docker containers
cd ..
docker/build/up

# Optional but recommended
cd src
php artisan ide-helper:generate
php artisan ide-helper:models
php artisan ide-helper:meta
```
