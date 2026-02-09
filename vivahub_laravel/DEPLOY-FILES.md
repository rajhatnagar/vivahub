# VivaHub Beta Deployment - File List

# Use this list to manually upload files via cPanel File Manager or FTP

Last Updated: 2026-02-08

## Server Details

- Host: 103.191.208.202
- User: whlmstql
- Path: public_html/beta/
- URL: http://103.191.208.202/beta/public/ (or updated domain)

---

## Modified Files to Upload

Upload each file to the corresponding path on the server:

### Controllers (Admin)

| Local File                                               | Upload To (Server Path)                        |
| -------------------------------------------------------- | ---------------------------------------------- |
| `app/Http/Controllers/Admin/AdminTemplateController.php` | `public_html/beta/app/Http/Controllers/Admin/` |
| `app/Http/Controllers/Admin/DashboardController.php`     | `public_html/beta/app/Http/Controllers/Admin/` |
| `app/Http/Controllers/Admin/TransactionController.php`   | `public_html/beta/app/Http/Controllers/Admin/` |

### Controllers (Main)

| Local File                                      | Upload To (Server Path)                  |
| ----------------------------------------------- | ---------------------------------------- |
| `app/Http/Controllers/UserPanelController.php`  | `public_html/beta/app/Http/Controllers/` |
| `app/Http/Controllers/PartnerController.php`    | `public_html/beta/app/Http/Controllers/` |
| `app/Http/Controllers/PaymentController.php`    | `public_html/beta/app/Http/Controllers/` |
| `app/Http/Controllers/GoogleAuthController.php` | `public_html/beta/app/Http/Controllers/` |

### Models

| Local File                   | Upload To (Server Path)        |
| ---------------------------- | ------------------------------ |
| `app/Models/Transaction.php` | `public_html/beta/app/Models/` |

### Routes

| Local File       | Upload To (Server Path)    |
| ---------------- | -------------------------- |
| `routes/web.php` | `public_html/beta/routes/` |

### Views

| Local File                                        | Upload To (Server Path)                             |
| ------------------------------------------------- | --------------------------------------------------- |
| `resources/views/layouts/admin.blade.php`         | `public_html/beta/resources/views/layouts/`         |
| `resources/views/admin/templates/index.blade.php` | `public_html/beta/resources/views/admin/templates/` |

---

## After Upload - Clear Cache

Run these commands via SSH or cPanel Terminal:

```bash
cd ~/public_html/beta
/usr/local/bin/ea-php81 artisan cache:clear
/usr/local/bin/ea-php81 artisan config:clear
/usr/local/bin/ea-php81 artisan view:clear
```

---

## Changes Summary

1. **Template Toggle Fix** - AdminTemplateController now correctly persists toggle state
2. **Template Filtering** - UserPanelController & PartnerController filter disabled templates
3. **Preview Button** - Improved visibility in admin templates view
4. **Coupon Delete** - PartnerController returns JSON for AJAX compatibility
5. **Transaction Model** - New model for payment transactions
6. **Admin Layout** - Removed "Designs" navigation item
7. **Routes** - Added template toggle route
