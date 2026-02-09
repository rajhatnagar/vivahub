---
description: Deploy Laravel project to beta server (vivahub.in/beta)
---

# Deploy to Beta Server

## Server Details

- **URL**: https://vivahub.in/beta/
- **Server IP**: 103.191.208.202
- **Username**: whlmstql
- **FTP Port**: 21
- **SSH Port**: 22
- **Remote Path**: /beta

## Pre-Deployment Steps

// turbo

1. Clear Laravel caches:

```powershell
php artisan config:clear; php artisan cache:clear; php artisan view:clear; php artisan route:clear
```

// turbo 2. Optimize for production:

```powershell
composer install --optimize-autoloader --no-dev
```

## Deployment Options

### Option A: Using WinSCP (Recommended)

1. Download WinSCP from https://winscp.net/
2. Connect with SFTP:
    - Host: 103.191.208.202
    - Port: 22
    - User: whlmstql
    - Pass: (stored securely)
3. Navigate to `/beta` folder on server
4. Upload all files from `c:\wamp64\www\vivahub\vivahub_laravel\`
5. Exclude: `node_modules`, `.git`, `storage/logs/*`
6. After upload, rename `.env.production` to `.env` on server

### Option B: Using FileZilla

1. Connect via SFTP (port 22) or FTP (port 21)
2. Same steps as WinSCP

### Option C: Command Line with SSH Key

If you have SSH key setup:

```powershell
scp -r -P 22 . whlmstql@103.191.208.202:/beta/
```

## Post-Deployment (via SSH)

1. SSH into server:

```bash
ssh whlmstql@103.191.208.202 -p 22
```

2. Run these commands on server:

```bash
cd /beta
mv .env.production .env
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Verify Deployment

- Visit: https://vivahub.in/beta/
