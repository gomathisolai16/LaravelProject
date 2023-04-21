# back-end

## Installation

* DEVELOPMENT
  * Copy .env.example to .env
  * Set your database configurations inside .env
  * From your terminal run ./install.sh file
* PRODUCTION
  * Copy .env.example to .env
  * Set all configurations inside .env file
  * Open ./install.sh file and comment mentioned lines
  * From your terminal run ./install.sh file

## CORS

Project has CORS configured to provide API access to a known list of origins, along with other configurations as well. Please check `config/cors.php` for more information.

To enable CORS for **development**, developers should define `LOCAL_CORS_ORIGIN` environment variable with the host of front-end server using API. Please check `.env.example`  for more information.

## Non CORS Requests

To properly authenticate against 'Non CORS' requests (accessing API from other services), it will be needed to provide extra header `X-News-Connect-Auth-Token` with secret value defined from `CUSTOM_AUTH_HEADER` environment variable. Please check `.env.example` for more information.

```bash
curl --location --request PUT 'https://api.mtnewswires.com/api/user/${USER_ID}/subscription' \
--header 'X-News-Connect-Auth-Token: ${SECRET}' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer ${TOKEN}' \
--header 'Content-Type: application/json' \
--data-raw '{
    "abbreviation": "mtx"
}'
```

## API Landing Page

[HTTP Basic Authentication](https://developer.mozilla.org/en-US/docs/Web/HTTP/Authentication) is implemented to protect access to landing page and it will grant access only to authenticated users with `admin` rights.

## Versioning

To keep track of different set of changes pushed to API repo, **version** configuration will be used (please check `config/app.php`). It will be updated manually on the configuration file or through `APP_VERSION` environment variable.

Most noticable usage of the **version** will be in API's landing page where it will be displayed for quick reference.

## Broken News Notification

When one of the XML files (from processing queue) will be classified as `broken` (in case Metadata field is missing), API will notify with an email the person whose email address is defined from `BROKEN_NEWS_NOTIFY_RECIPIENT` environment variable. Please check `.env.example` for more information.

## Usage

### Login

```javascript
  YourAPIService.post(apiURL + 'login',{
      email:"your@example.com",
      password:"your_password"
  }).then(
      // success response
      function(response){
          console.info(respons);
      },
      //error response
      function(error){
          console.error(error);
      }
  );
```

### Get dashboards

```javascript
  YourAPIService.get(apiURL + 'dashboards')
  .then(
      // success response
      function(response){
          console.info(respons);
      },
      //error response
      function(error){
          console.error(error);
      }
  );
```

### Get dashboards with modules

```javascript
  YourAPIService.get(apiURL + 'dashboards?with=modules')
  .then(
      // success response
      function(response){
          console.info(respons);
      },
      //error response
      function(error){
          console.error(error);
      }
  );
```

### Personal routes for auth user

* /
    * description: Will return authenticated user
    * usage: api/user    

* /settings
    * description: Will return all settings for authenticated user
    * usage: api/user/settings
    
* /modules
    * description: Will return all modules for authenticated user
    * usage: api/user/modules
    
* /dashboards
    * description: Will return all dashboards for authenticated user
    * usage: api/user/dashboards
    
* /roles
    * description: Will return all roles for authenticated user
    * usage: api/user/roles

### Allowed parameters for get requests

* perRequest
    * default: 25
    * usage api/modules?perRequest=15
    * required: false
    
* page
    * default: 1
    * usage api/modules?page=15
    * required: true (if you need results from other pages)
    
* fields    
    * default: * (change it if you want to get only custom files)
    * usage: api/modules?fields=column1|column2
    * required: false
    
* with
    * default: none (change it if you want to get items with relations)
    * usage: api/modules?with=relation1|relation2
    * required: false
    
* filters
    * default: none (change it if you want to get filtered items)
    * usage: api/modules?filters=filter1|filter2 (if filter is boolean like active you can use filters=active:1 or active:0 default where 1=>true and 0=>false)
    * required: false
        
* format
    * default: json (allowed [ xml, json ])
    * usage: api/modules?format=xml 
    * required: false
    
* order
    * default: desc (allowed [asc, desc]),
    * usage: api/news?order=asc,
    * required: false,    
    
* Special request parameters
    * news
        * keywords
            * default: none
            * usage: api/news?tickers=key1,key2
            * required: false
        * tickers
            * default: none
            * usage: api/news?tickers=2,3 where numbers separated by comma are IDes of tickers
            * required: false
        * categories
            * default: none
            * usage: api/news?categories=12,34,25,36 where numbers separated by comma are IDes of categories
            * required: false

## Relevant Tool Documentation Links

- [Laravel](https://laravel.com/docs/5.4)
- [Laravel Passport](https://laravel.com/docs/master/passport)
- [CORS](https://github.com/barryvdh/laravel-cors)
- [ROLES](https://github.com/Zizaco/entrust)