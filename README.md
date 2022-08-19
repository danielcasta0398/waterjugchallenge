# Water Jug Challenge 🚀

## Requiremennts 📙
Use these any of these two servers to deploy the api local
* Make sure you have PHP 8.0 or higher installed.
* [WAMP](https://www.wampserver.com/en/): WAMP Server
* [XAMMP](https://www.apachefriends.org/es/index.html): XAMPP Server
Make sure you have PHP 8.0 or higher installed.

## Installation
Clone the repository 
```
git clone https://github.com/danielcasta0398/waterjugchallenge.git
```
# REST API
The REST API to the example app is described below.
### Request

Make a ``POST`` request to the following URL, and add a ``JSON`` object to the body of the request with the following objects.

`POST /get-calculation.php`

    http://localhost/waterjugchallenge/views/water/get-calculation.php

This is an example of the JSON object in the body of the request:

```json
{
    "x" : 10,
    "y" : 8,
    "z" : 2
}
```

### Response

* status: `200 Ok`

```json
{
    "1step": "Fill bucket X",
    "2step": "Transfer bucket X to bucket Y",
    "3step": "Dump bucket Y. Solved"
}
```
