Hosted-solr.com PHP Api Client
---------

With this php library you can list, created and delete solr cores on hosted-solr.com with your PHP Application.

The API-Client comes with some PHP Classes that are usefull to communicate with the api

HostedSolr\ApiClient\Domain\Api\Client\Solr\CoreRepository:

Used to create, retrieve and delete cores.

HostedSolr\ApiClient\Domain\Api\Client\Solr\Core:

The object representation of a core, you can use it to visualize all information that is retrieved by the api.

HostedSolr\ApiClient\Service:

Toplevel service object that can be used to do the most common tasks.

You can use all Classes of the ApiClient in your Application but it's recommended to use the service class only.


Example:
---------

Install all composer dependencies:

    curl -sS https://getcomposer.org/installer | php
    php composer.php install
    touch test.php


Explorer the api service an execute your operations (Add the following to your test.php file):

```php
    require_once 'vendor/autoload.php';

    $service    = \HostedSolr\ApiClient\Factory::getApiService('<your-api-token>','<your-secret-token>');
    $allCores   = $service->getAllCores();
```
