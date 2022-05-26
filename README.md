# mini-CRM

## Install

```
php artisan key:generate

composer install

php artisan jwt:secret

php artisan migrate --seed
```

## Config

### .env

`QUEUE_CONNECTION=database`
`MAIL_ADDRESS=system@info.com`

### Run queues

`php artisan queue:work`

## REST API

**Make sure to have headers:**

```
"Content_Type": "application/json"
"Accept": "application/json"
```

# Prefix auth

## Authentication

**Request**

`POST /login`

**Body**

`email` **Required**

`password` **Required**

**Response**

```
{
    "access_token": "string",
    "token_type": "Bearer",
    "expires_at": 1653605394
}
```
**Login with**
```
email: "admin@admin.com,
password: "password"
```
# Prefix api

## Companies

### index

**Authorization**

none

**Request**

`GET /companies`

**Headers**

`"Authorization": "Bearer " + access_token`

**Description**

Returns companies, uses laravel default pagination. Paginations set to default 10 per page.

**Response**

```
"data": [
        {
            "id": 1,
            "name": "DuBuque, Johnson and Kertzmann",
            "email": "breitenberg.marjolaine@example.net",
            "logo": "628fe21aefe02pAtTyJdlQbxGaG1HC.png",
            "website": "https://macejkovic.com/et-aut-sequi-soluta-aspernatur-voluptatem-accusantium.html",
            "created_at": "2022-05-26T20:25:08.000000Z",
            "updated_at": "2022-05-26T20:25:08.000000Z"
        },
        ...
    ]
    "meta": {...}
    "links": {...}
]
```

### create

**Authorization**

admin

**Request**

`POST /companies`

**Body**

`name` - company name **Required**

`email`

`logo` - file img

`website`

**Headers**

`"Authorization": "Bearer " + access_token`

**Description**

Creates company. Sends email notification to record creator. 

**Response**

```
{
    "success": "Company \"company name\" was created successfuly"
}
```

### update

**Authorization**

admin

**Request**

`PUT /companies/{company_id}`

**Body**

`name` - company name **Required**

`email`

`logo` - file img

`website`

**Headers**

`"Authorization": "Bearer " + access_token`

**Response**

```
{
    "success": "Company updated successfuly"
}
```

### delete

**Authorization**

admin

**Request**

`DELETE /companies/{company_id}`

**Headers**

`"Authorization": "Bearer " + access_token`

**Response**

```
{
    "success": "Company \"Marianne Little\" deleted successfuly"
}
```

## Employees

### index

**Authorization**

none

**Request**

`GET /employees`

**Headers**

`"Authorization": "Bearer " + access_token`

**Description**

Returns employees, uses laravel default pagination. Paginations set to default 10 per page.

**Response**

```
"data": [
        {
            "id": 1,
            "first_name": "Marianne",
            "last_name": "Little",
            "email": "geovanny24@example.net",
            "phone": "279-825-8161",
            "company_id": 19,
            "company_name": "Kulas-Morissette"
        },
        ...
    ]
    "meta": {...}
    "links": {...}
]
```

### create

**Authorization**

admin

**Request**

`POST /employees`

**Body**

`first_name` **Required**

`last_name` **Required**

`email`

`phone`

`company_id`

**Headers**

`"Authorization": "Bearer " + access_token`

**Response**

```
{
    "success": "Employee \"HAHA HA muhahah\" successfuly created"
}
```

### update

**Authorization**

admin

**Request**

`PUT /employees/{employee_id}`

**Body**

`first_name` 

`last_name`

`email`

`phone`

`company_id`

**Headers**

`"Authorization": "Bearer " + access_token`

**Response**

```
{
    "success": "Employee updated successfuly"
}
```

### delete

**Authorization**

admin

**Request**

`DELETE /employees/{employee_id}`

**Headers**

`"Authorization": "Bearer " + access_token`

**Response**

```
{
    "success": "Employee \"Marianne Little\" deleted successfuly"
}
```
