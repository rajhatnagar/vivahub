# VivaHub - Wedding Invitation Platform

VivaHub is a modern Laravel-based platform for creating and managing wedding invitations (Web, Board, NFC).

## Features

- **Admin Panel**: Manage Users, Plans, Designs, and Settings.
- **User Dashboard**: Create and edit invitations.
- **Dynamic Designs**: Support for various event categories.
- **Payments**: Integrated transaction tracking.

## Technology Stack

- **Framework**: Laravel 11
- **Frontend**: Blade + Tailwind CSS + AlpineJS
- **Database**: MySQL

## Setup

1. Clone the repository.
2. Run `composer install`.
3. Copy `.env.example` to `.env` and configure DB.
4. Run `php artisan migrate --seed`.

## Authenticaiton

- **Google Login**: Enabled via Socialite.
- **Email/Password**: Standard Laravel Auth.


URL: https://vivahub.in/beta/
## Test Credentials

| Role        | Email                 | Password   |
| ----------- | --------------------- | ---------- |
| **Admin**   | `admin@vivahub.com`   | `admin123` |
| **User**    | `user@vivahub.com`    | `password` |
| **Partner** | `partner@vivahub.com` | `password` |

## Deployment

Ensure your `.env` has the correct `APP_URL` and database credentials before deploying.
