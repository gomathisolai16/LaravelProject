---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## api/login

> Example request:

```bash
curl -X POST "http://localhost/api/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_2ea88ff35aa222f5582e50f39a2b35fd -->
## Will return authenticated user with roles and permissions as response

> Example request:

```bash
curl -X GET "http://localhost/api/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/user",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/user`

`HEAD api/user`


<!-- END_2ea88ff35aa222f5582e50f39a2b35fd -->

<!-- START_451ea6811cf31c8fadd3fdcf7ab7fcbd -->
## api/user/{id}/toggle-role

> Example request:

```bash
curl -X PUT "http://localhost/api/user/{id}/toggle-role" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/user/{id}/toggle-role",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/user/{id}/toggle-role`


<!-- END_451ea6811cf31c8fadd3fdcf7ab7fcbd -->

<!-- START_136660ecd841bcd53d3c53a42f2cc5da -->
## api/user/watch-list

> Example request:

```bash
curl -X POST "http://localhost/api/user/watch-list" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/user/watch-list",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/user/watch-list`


<!-- END_136660ecd841bcd53d3c53a42f2cc5da -->

<!-- START_c946d91ecfc75606a2f4608e224f55da -->
## api/user/watch-list

> Example request:

```bash
curl -X GET "http://localhost/api/user/watch-list" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/user/watch-list",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/user/watch-list`

`HEAD api/user/watch-list`


<!-- END_c946d91ecfc75606a2f4608e224f55da -->

<!-- START_a9a92f71c665c16aa785a6c01ef74bb3 -->
## api/user/watch-list/{id}

> Example request:

```bash
curl -X DELETE "http://localhost/api/user/watch-list/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/user/watch-list/{id}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/user/watch-list/{id}`


<!-- END_a9a92f71c665c16aa785a6c01ef74bb3 -->

<!-- START_26918bb022bf16c1ac792ca5cd29ae3b -->
## api/user/{item}

> Example request:

```bash
curl -X GET "http://localhost/api/user/{item}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/user/{item}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/user/{item}`

`HEAD api/user/{item}`


<!-- END_26918bb022bf16c1ac792ca5cd29ae3b -->

<!-- START_7ec0e13f01e22fb12992f3b5dda11140 -->
## Will return tree of categories as response

> Example request:

```bash
curl -X GET "http://localhost/api/categories/tree" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/categories/tree",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/categories/tree`

`HEAD api/categories/tree`


<!-- END_7ec0e13f01e22fb12992f3b5dda11140 -->

<!-- START_c37ef7f5bc4ea78e433f6031721801b9 -->
## Will return tree of categories as response

> Example request:

```bash
curl -X GET "http://localhost/api/categories/{id}/tree" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/categories/{id}/tree",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/categories/{id}/tree`

`HEAD api/categories/{id}/tree`


<!-- END_c37ef7f5bc4ea78e433f6031721801b9 -->

<!-- START_af67e8c8abce8e878c13a482203ee9c2 -->
## api/news/tickers

> Example request:

```bash
curl -X GET "http://localhost/api/news/tickers" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/news/tickers",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/news/tickers`

`HEAD api/news/tickers`


<!-- END_af67e8c8abce8e878c13a482203ee9c2 -->

<!-- START_cf84a5ebaab79b75870986f8a7eb2f81 -->
## api/news/{id}/toggle-parked

> Example request:

```bash
curl -X PUT "http://localhost/api/news/{id}/toggle-parked" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/news/{id}/toggle-parked",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/news/{id}/toggle-parked`


<!-- END_cf84a5ebaab79b75870986f8a7eb2f81 -->

<!-- START_2304bcde166c7d35655140a778345cff -->
## api/modules/{id}/update-coordinates

> Example request:

```bash
curl -X POST "http://localhost/api/modules/{id}/update-coordinates" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/modules/{id}/update-coordinates",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/modules/{id}/update-coordinates`


<!-- END_2304bcde166c7d35655140a778345cff -->

<!-- START_b7f80556b08ecb82d17e244bc0151ce2 -->
## api/dashboards/{id}/change-module-state

> Example request:

```bash
curl -X POST "http://localhost/api/dashboards/{id}/change-module-state" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/dashboards/{id}/change-module-state",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/dashboards/{id}/change-module-state`


<!-- END_b7f80556b08ecb82d17e244bc0151ce2 -->

<!-- START_2970a396628ab6cf2b3cca79c67511c1 -->
## api/dashboards/active

> Example request:

```bash
curl -X GET "http://localhost/api/dashboards/active" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/dashboards/active",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/dashboards/active`

`HEAD api/dashboards/active`


<!-- END_2970a396628ab6cf2b3cca79c67511c1 -->

<!-- START_5ae40203e578b4ae2aa24e654badf91e -->
## api/dashboards/{id}/update-dashboards-list

> Example request:

```bash
curl -X PUT "http://localhost/api/dashboards/{id}/update-dashboards-list" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/dashboards/{id}/update-dashboards-list",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/dashboards/{id}/update-dashboards-list`


<!-- END_5ae40203e578b4ae2aa24e654badf91e -->

<!-- START_01c8b3a78424b4b08759800960c2aa8c -->
## api/settings

> Example request:

```bash
curl -X PUT "http://localhost/api/settings" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/settings",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/settings`


<!-- END_01c8b3a78424b4b08759800960c2aa8c -->

<!-- START_6b0dfcf2fd0e1d8b73fd377a544713a2 -->
## api/settings/change-theme

> Example request:

```bash
curl -X POST "http://localhost/api/settings/change-theme" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/settings/change-theme",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/settings/change-theme`


<!-- END_6b0dfcf2fd0e1d8b73fd377a544713a2 -->

<!-- START_b7e7bcc8013aeb3e40e7b662d4d06201 -->
## api/dashboards

> Example request:

```bash
curl -X GET "http://localhost/api/dashboards" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/dashboards",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/dashboards`

`HEAD api/dashboards`


<!-- END_b7e7bcc8013aeb3e40e7b662d4d06201 -->

<!-- START_65a0aa0f579a1ac8992d6b992fd2f7da -->
## Override store method of parent class
Make additional changes and return parent store method

> Example request:

```bash
curl -X POST "http://localhost/api/dashboards" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/dashboards",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/dashboards`


<!-- END_65a0aa0f579a1ac8992d6b992fd2f7da -->

<!-- START_2526ecc8ea27da3f899e62f14cfb97e6 -->
## api/dashboards/{dashboard}

> Example request:

```bash
curl -X GET "http://localhost/api/dashboards/{dashboard}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/dashboards/{dashboard}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/dashboards/{dashboard}`

`HEAD api/dashboards/{dashboard}`


<!-- END_2526ecc8ea27da3f899e62f14cfb97e6 -->

<!-- START_dee7b559acd69fa57060243ab52ba371 -->
## api/dashboards/{dashboard}

> Example request:

```bash
curl -X PUT "http://localhost/api/dashboards/{dashboard}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/dashboards/{dashboard}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/dashboards/{dashboard}`

`PATCH api/dashboards/{dashboard}`


<!-- END_dee7b559acd69fa57060243ab52ba371 -->

<!-- START_5a7b3c9eeb9f97d7523f8d6f0b2fbaa0 -->
## Override destroy method of parent class
Make additional changes and return parent destroy method

> Example request:

```bash
curl -X DELETE "http://localhost/api/dashboards/{dashboard}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/dashboards/{dashboard}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/dashboards/{dashboard}`


<!-- END_5a7b3c9eeb9f97d7523f8d6f0b2fbaa0 -->

<!-- START_33c7e80b577570798c60c6aaaa112ac1 -->
## api/modules

> Example request:

```bash
curl -X GET "http://localhost/api/modules" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/modules",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/modules`

`HEAD api/modules`


<!-- END_33c7e80b577570798c60c6aaaa112ac1 -->

<!-- START_02a9084a815c8b5386324ae172ab700b -->
## Override store method of parent class
Make additional changes and return parent store method

> Example request:

```bash
curl -X POST "http://localhost/api/modules" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/modules",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/modules`


<!-- END_02a9084a815c8b5386324ae172ab700b -->

<!-- START_b81e041714fb7045199cd032fb4fe7e6 -->
## api/modules/{module}

> Example request:

```bash
curl -X GET "http://localhost/api/modules/{module}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/modules/{module}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/modules/{module}`

`HEAD api/modules/{module}`


<!-- END_b81e041714fb7045199cd032fb4fe7e6 -->

<!-- START_a412c980d3eedd7e728e2aed0c7156fa -->
## Override update method of parent class
Make additional changes and return parent update method

> Example request:

```bash
curl -X PUT "http://localhost/api/modules/{module}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/modules/{module}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/modules/{module}`

`PATCH api/modules/{module}`


<!-- END_a412c980d3eedd7e728e2aed0c7156fa -->

<!-- START_e85112b0ac03a240eb2880c88d7b0de3 -->
## Override destroy method of parent class
Make additional changes and return parent destroy method

> Example request:

```bash
curl -X DELETE "http://localhost/api/modules/{module}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/modules/{module}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/modules/{module}`


<!-- END_e85112b0ac03a240eb2880c88d7b0de3 -->

<!-- START_da5727be600e4865c1b632f7745c8e91 -->
## api/users

> Example request:

```bash
curl -X GET "http://localhost/api/users" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/users",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/users`

`HEAD api/users`


<!-- END_da5727be600e4865c1b632f7745c8e91 -->

<!-- START_12e37982cc5398c7100e59625ebb5514 -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost/api/users" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/users",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/users`


<!-- END_12e37982cc5398c7100e59625ebb5514 -->

<!-- START_8f99b42746e451f8dc43742e118cb47b -->
## api/users/{user}

> Example request:

```bash
curl -X GET "http://localhost/api/users/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/users/{user}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/users/{user}`

`HEAD api/users/{user}`


<!-- END_8f99b42746e451f8dc43742e118cb47b -->

<!-- START_48a3115be98493a3c866eb0e23347262 -->
## api/users/{user}

> Example request:

```bash
curl -X PUT "http://localhost/api/users/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/users/{user}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/users/{user}`

`PATCH api/users/{user}`


<!-- END_48a3115be98493a3c866eb0e23347262 -->

<!-- START_d2db7a9fe3abd141d5adbc367a88e969 -->
## api/users/{user}

> Example request:

```bash
curl -X DELETE "http://localhost/api/users/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/users/{user}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/users/{user}`


<!-- END_d2db7a9fe3abd141d5adbc367a88e969 -->

<!-- START_51e581cc9a1f9ee73cc207ec4e67e8d4 -->
## api/categories

> Example request:

```bash
curl -X GET "http://localhost/api/categories" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/categories",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/categories`

`HEAD api/categories`


<!-- END_51e581cc9a1f9ee73cc207ec4e67e8d4 -->

<!-- START_2335abbed7f782ea7d7dd6df9c738d74 -->
## Override store method of parent class
Make additional changes and return parent store method

> Example request:

```bash
curl -X POST "http://localhost/api/categories" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/categories",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/categories`


<!-- END_2335abbed7f782ea7d7dd6df9c738d74 -->

<!-- START_c3e1c84c6b0ff14496d71900bd82f60c -->
## api/categories/{category}

> Example request:

```bash
curl -X GET "http://localhost/api/categories/{category}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/categories/{category}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/categories/{category}`

`HEAD api/categories/{category}`


<!-- END_c3e1c84c6b0ff14496d71900bd82f60c -->

<!-- START_549109b98c9f25ebff47fb4dc23423b6 -->
## api/categories/{category}

> Example request:

```bash
curl -X PUT "http://localhost/api/categories/{category}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/categories/{category}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/categories/{category}`

`PATCH api/categories/{category}`


<!-- END_549109b98c9f25ebff47fb4dc23423b6 -->

<!-- START_7513823f87b59040507bd5ab26f9ceb5 -->
## api/categories/{category}

> Example request:

```bash
curl -X DELETE "http://localhost/api/categories/{category}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/categories/{category}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/categories/{category}`


<!-- END_7513823f87b59040507bd5ab26f9ceb5 -->

<!-- START_5a6599f3ecfca4d9787e34f0f3e9212d -->
## api/news

> Example request:

```bash
curl -X GET "http://localhost/api/news" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/news",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/news`

`HEAD api/news`


<!-- END_5a6599f3ecfca4d9787e34f0f3e9212d -->

<!-- START_aeceef8aaaac3f0954bf7253ecfdb38a -->
## Override store method of parent class
Make additional changes and return parent store method

> Example request:

```bash
curl -X POST "http://localhost/api/news" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/news",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/news`


<!-- END_aeceef8aaaac3f0954bf7253ecfdb38a -->

<!-- START_ae268a25480380e2a0d316c2fd903963 -->
## api/news/{news}

> Example request:

```bash
curl -X GET "http://localhost/api/news/{news}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/news/{news}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": false,
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/news/{news}`

`HEAD api/news/{news}`


<!-- END_ae268a25480380e2a0d316c2fd903963 -->

<!-- START_9366fbdef8dea9738966cdfd7daba9f7 -->
## api/news/{news}

> Example request:

```bash
curl -X PUT "http://localhost/api/news/{news}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/news/{news}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/news/{news}`

`PATCH api/news/{news}`


<!-- END_9366fbdef8dea9738966cdfd7daba9f7 -->

<!-- START_bb2ed2300538ecd019d36ca11b3af3fe -->
## Override destroy method of parent class
Make additional changes and return parent destroy method

> Example request:

```bash
curl -X DELETE "http://localhost/api/news/{news}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/news/{news}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/news/{news}`


<!-- END_bb2ed2300538ecd019d36ca11b3af3fe -->

<!-- START_61739f3220a224b34228600649230ad1 -->
## api/logout

> Example request:

```bash
curl -X POST "http://localhost/api/logout" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/logout",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/logout`


<!-- END_61739f3220a224b34228600649230ad1 -->

