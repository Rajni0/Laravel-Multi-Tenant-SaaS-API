# Laravel Multi-Tenant SaaS API

A minimal backend API that allows users to register, create and manage multiple companies under their profile, and switch between active companies with full data scoping.

---

## Setup Instructions

```bash
git clone https://github.com/Rajni0/Laravel-Multi-Tenant-SaaS-API.git
cd Laravel-Multi-Tenant-SaaS-API
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

Ensure MySQL is running and database credentials are correctly set in .env

######  Authentication (Laravel Sanctum)

All endpoints require:
Authorization: Bearer <token>
Accept: application/json

### API Endpoints & Examples ##
/api/register  [POST]
{
  "name": "Rajni",
  "email": "rajni@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}

/api/login [POST]
{
  "email": "rajni@example.com",
  "password": "password123"
}

/api/logout [POST]

/api/companies  [POST]
{
  "name": "CompanyTest",
  "address": "Jaipur, Rajasthan",
  "industry": "Serivce-commerce"
}

/api/companies  [GET]

/api/companies/1   [PUT]
{
  "name": "Updated Company Name",
  "address": "Bangalore"
}

/api/companies/1  [DELETE]

/api/companies/2/set-active [POST]


####  Multi-Tenant Logic & Data Scoping
Key Concepts:
Each user can create/manage multiple companies.
One company is marked as the "active company" for each user.
Future modules (e.g., invoices, projects) will use the active_company_id from the user table to scope all data and actions.
All actions are scoped:
    A user can only access their own companies.
    All operations are bound to the active company context.


