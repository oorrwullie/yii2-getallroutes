Yii2-getAllRoutes
=================
Returns an array of all possible unique route controllers and actions for the application.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist oorrwullie/yii2-getallroutes "*"
```

or add

```
"oorrwullie/yii2-getallroutes": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by :

```php
use oorrwullie\components\getAllRoutes;

$list = new getAllRoutes();
print_r($list->routes);
```
