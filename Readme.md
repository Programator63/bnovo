
# Microservice for interaction with the guest

The microservice will allow you to create, receive, modify and delete guests.

## Requirement
- docker
- composer
- php
- straight arms

## Installation


- Copy project in folder
- Use the command ```docker-compose build```
- Then use the command ```cd src``` and command ```cp .env.example .env```
- configure the .env file
- now use the command ```php artisan migrate```

## API Reference

#### Get all Guests

```
  GET /api/guests
```



<details>
<summary>Return</summary>

```json
[
  {
      "id": 1,
      "first_name": "name",
      "last_name": "lastname",
      "email": "email@example.com",
      "phone": "+1234567890",
      "country": "country"
  },
  {
      "id": 2,
      "first_name": "name",
      "last_name": "lastname",
      "email": "email2@example.com",
      "phone": "+1234567899",
      "country": "country"
  }
]
```
</details>



----

#### Get Guest

```
  GET /api/guests/${id}
```

| Parameter | Type     | Description                      |
| :-------- | :------- | :------------------------------- |
| `id`      | `integer` | **Required**. Id of guest |


<details>
<summary>Return</summary>

```json
{
      "id": 1,
      "first_name": "name",
      "last_name": "lastname",
      "email": "email@example.com",
      "phone": "+1234567890",
      "country": "country"
}
```
</details>

----

#### Create Guest

```
  POST /api/gusts
```

| Parameter   | Type      | Required |
|:------------|:----------|:---------|
| `first_name` | `string`  | &check;  |
| `last_name` | `string`  | &check;  |
| `email` | `string`  | &check;  |
| `phone` | `integer` | &check;  |
| `country` | `string`  | &cross;  |

<details>
<summary>Return</summary>

```json
{
      "first_name": "name",
      "last_name": "lastname",
      "email": "email@example.com",
      "phone": "+1234567890",
      "country": "country",
      "id": 1
}
```
</details>

#### Create Guest

```
  PUT /api/gusts/${id}
```

| Parameter | Type     | Description               |
| :-------- | :------- |:--------------------------|
| `id`      | `integer` | **Required**. Id of guest |

| Parameter form | Type      |
|:---------------|:----------|
| `first_name`   | `string`  | 
| `last_name`    | `string`  |
| `email`        | `string`  | 
| `phone`        | `integer` | 
| `country`      | `string`  |

<details>
<summary>Return</summary>

```json
{
      "id": 1,
      "first_name": "name",
      "last_name": "lastname",
      "email": "email@example.com",
      "phone": "+1234567890",
      "country": "country"
}
```
</details>


#### Delete Guest

```
  DELETE /api/gusts/${id}
```

| Parameter | Type     | Description               |
| :-------- | :------- |:--------------------------|
| `id`      | `integer` | **Required**. Id of guest |

<details>
<summary>Return</summary>

```json
{
  "message":"The guest has been successfully deleted"
}
```
</details>
