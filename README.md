# API to manage rules of corrections

Personal project developed to create rules of corrections.
Each user should have a login and access of each one of his rules.

## 🛠 Tools and Technologies
* PHP
* Symfony
* Composer
* MySQL
* Doctrine

## Current under construction
* Rules backend

## ⚙️ Features
## API documentation

#### Return all rules

```http
  GET /rule
```

#### Return one rule by id

```http
  GET /rule/${id}
```

| Parameter   | Type       | Description                           |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `string` | **Not null**. Rule id |

#### Create a new rule
```http
  POST /rule
```

| Parameter   | Type       | Description                           |
| :---------- | :--------- | :---------------------------------- |
| `name` | `string` | **Not null**. Rule name |

#### Update one rule
```http
  PUT /rule/${id}
```
| Parameter   | Type       | Description                           |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `string` | **Not null**. Rule id |
| `name`      | `string` | **Not null**. Rule name |

#### Delete a rule
```http
  DELETE /rule/${id}
```

| Parameter   | Type       | Description                           |
| :---------- | :--------- | :---------------------------------- |
| `id`      | `string` | **Not null**. Rule id |
