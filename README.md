# Описание

PHP класс для работы с API DeliveryAuto

# Документация

[API по работе интернет магазинов с Delivery v3.2 (Оформление)](http://www.delivery-auto.com.ua/userfs/LocalizableFiles/ru-RU/delivery-api/6ce6e819-7ed6-42d8-8392-e5ee22d10091_API%20%D0%BF%D0%BE%20%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%B5%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%BD%D0%B5%D1%82%20%D0%BC%D0%B0%D0%B3%D0%B0%D0%B7%D0%B8%D0%BD%D0%BE%D0%B2%20%D1%81%20Delivery%20v3%202%20(%D0%9E%D1%84%D0%BE%D1%80%D0%BC%D0%BB%D0%B5%D0%BD%D0%B8%D0%B5).pdf)

# Требование

* PHP 5.6 или выше
* Composer

# Composer
```bash
composer require jackmartin/deliveryauto dev-master
```

# Библиотеки 

1. [Guzzle](https://github.com/guzzle/guzzle)

# Методы API

1. Подключение класса
	* [Подключение](https://github.com/martinjack/deliveryAuto#Подключение-класса)
2. Получить список областей
	* [regionList](https://github.com/martinjack/deliveryAuto#regionlist)
3. Получить список городов
	* [areasList](https://github.com/martinjack/deliveryAuto#areaslistdata--array)
4. Получение списка представительств
	* [warehousesList](https://github.com/martinjack/deliveryAuto#warehouseslistdata--array)
5. Получение подробной информации о представительстве
	* [getWarehouse](https://github.com/martinjack/deliveryAuto#getwarehouseid)
6. Поиск представительств
	* [findWarehouse](https://github.com/martinjack/deliveryAuto#findwarehousedata--array)
7. Получение списка представительств по ID города
	* [getWarehouseCity](https://github.com/martinjack/deliveryAuto#getwarehousecitydata--array)
8. Поиск квитанции
	* [getReceipt](https://github.com/martinjack/deliveryAuto#getreceiptnumber)
9. Расчет времени доставки
	* [timeDelivery](https://github.com/martinjack/deliveryAuto#timedeliverydata--array)
10. Показать список доп. услуг
	* [getDopUslugi](https://github.com/martinjack/deliveryAuto#getdopuslugidata--array)
11. Показать список тарифов
	* [getTariffList](https://github.com/martinjack/deliveryAuto#gettarifflistdata--array)
12. Показать список схем доставок
	* [deliveryScheme](https://github.com/martinjack/deliveryAuto#deliveryschemedata--array)
13. Расчет стоимости перевозки
	* [costDelivery](https://github.com/martinjack/deliveryAuto#costdeliverydata--array)
14. Показать новости компании
	* [newsCompany](https://github.com/martinjack/deliveryAuto#newscompanycount--5-page--1)
15. Показать темы сообщений
	* [themeMessages](https://github.com/martinjack/deliveryAuto#thememessages)
16. Отправление сообщения
	* [sendMessage](https://github.com/martinjack/deliveryAuto#sendmessagedata--array)
17. Отправление оценки отделения
	* [rateOffice](https://github.com/martinjack/deliveryAuto#rateofficedata--array)
18. Отправление оценки компании
	* [rateCargo](https://github.com/martinjack/deliveryAuto#ratecargodata--array)
19. Авторизация
	* [auth](https://github.com/martinjack/deliveryAuto#authdata--array)
20. Выйти с профиля
	* [exitAuth](https://github.com/martinjack/deliveryAuto#exitauth)
21. Получить информацию о пользователе
	* [getUser](https://github.com/martinjack/deliveryAuto#getuser)
22. Получить квитанцию пользователя
	* [userReceipt](https://github.com/martinjack/deliveryAuto#userreceiptdata--array)
23. Получить список платежных карт клиента
	* [cardClient](https://github.com/martinjack/deliveryAuto#cardclient)
24. Получить список расчетных счетов клиента
	* [invoiceClient](https://github.com/martinjack/deliveryAuto#invoiceclient)
25. Получить список категорий отправляемого груза
	* [cargoCategory](https://github.com/martinjack/deliveryAuto#cargocategory)

# Примеры

### Подключение класса ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

//$devAuto = new Auto();
//$devAuto = new Auto('KEY_AUTH', 'KEY_SECRET', 'ua', 1); 
//$devAuto = new Auto('KEY_AUTH', 'KEY_SECRET', 'ru', 2);
//Auto(Ваш ключ API, Язык информации, Код страны(1 - Украина, 2 - Россия))
```

### regionList() ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->regionList());
```

### areasList($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->areasList(array(
    'fl_all'   => 0,
    'regionId' => 3898,
)));
```

### warehousesList($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->warehousesList(array(
    'includeRegionalCenters' => false,
    'CityId'                 => null,
    'RegionId'               => 3898,
)));
```

### getWarehouse($id) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->getWarehouse('2711ddd1-da49-e211-9515-00155d012d0d'));
```

### findWarehouse($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->findWarehouse(array(

    'Longitude'              => '49.2386',
    'Latitude'               => '10.5194',
    'count'                  => 10,
    'includeRegionalCenters' => false,
    'CityId'                 => null,
)));
```

### getWarehouseCity($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->getWarehouseCity(array(

    'CityId'         => '75491888-1429-e311-8b0d-00155d037960',
    'onlyWarehouses' => false,

)));
```

### timeDelivery($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->timeDelivery(array(

    'areasSendId'   => '1e8e7257-a82a-e311-8b0d-00155d037960',
    'areasResiveId' => 'b3db16a5-832a-e311-8b0d-00155d037960',
    'dateSend'      => '11.10.2017',
    'currency'      => 'ua',

)));
```

```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->timeDelivery(array(

    'areasSendId'       => '1e8e7257-a82a-e311-8b0d-00155d037960',
    'areasResiveId'     => 'b3db16a5-832a-e311-8b0d-00155d037960',
    'dateSend'          => '12.10.2017',
    'currency'          => 'ua',
    'warehouseSendId'   => 'fa156dd9-9630-e511-9ea9-000d3a200160',
    'warehouseResiveId' => '37548925-0ad3-e411-8a3a-000d3a200160',
)));
```

### getReceipt($number) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->getReceipt('2130009668'));
```

### getDopUslugi($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->getDopUslugi(array(

    'CitySendId'    => '569983ea-2e2b-e311-8b0d-00155d037960',
    'CityReceiveId' => '47178398-442b-e311-8b0d-00155d037960',
    'currency'      => 'ua',

)));
```

### getTariffList($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->getTariffList(array(

    'CitySendId'         => '569983ea-2e2b-e311-8b0d-00155d037960',
    'CityReceiveId'      => '47178398-442b-e311-8b0d-00155d037960',
    'WarehouseReceiveId' => '6bbee295-9575-e611-8104-000d3a204dce',

)));
```

### deliveryScheme($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->deliveryScheme(array(

    'CitySendId'         => '569983ea-2e2b-e311-8b0d-00155d037960',
    'CityReceiveId'      => '47178398-442b-e311-8b0d-00155d037960',
    'WarehouseReceiveId' => '6bbee295-9575-e611-8104-000d3a204dce',

)));
```

### costDelivery($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->costDelivery(array(

    'areasSendId'            => '4fc948a7-3729-e311-8b0d-00155d037960',
    'areasResiveId'          => 'e3ac6f68-3529-e311-8b0d-00155d037960',
    'warehouseSendId'        => '1c828aa6-70c8-e211-9902-00155d037919',
    'warehouseResiveId'      => 'd908c5e1-b36b-e211-81e9-00155d012a15',
    'InsuranceValue'         => 1000000,
    'CashOnDeliveryValue'    => 5000,
    'dateSend'               => '11.10.2017',
    'deliveryScheme'         => 2,
    'category'               => array(
        'categoryId' => '00000000-0000-0000-0000-000000000000',
        'countPlace' => 1,
        'helf'       => 2,
        'size'       => 1,
    ),
    'dopUslugaClassificator' => array(
        'dopUsluga' => array(
            array(
                'uslugaId' => '2b4247c9-be8c-e211-be60-00155d037919',
                'count'    => 1,
            ),
            array(
                'uslugaId' => '3e9cde5d-bf8c-e211-be60-00155d037919',
                'count'    => 5,
            ),
        ),
    ),

)));
```

### newsCompany($count = 5, $page = 1) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->newsCompany());
```

### themeMessages() ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->themeMessages());
```

### sendMessage($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->sendMessage(array(

    'ReceiptNumber' => '123',
    'Name'          => 'Name',
    'Phone'         => '123456',
    'Email'         => 'name@name.com',
    'Subject'       => 'Text',
    'Message'       => 'message text',

)));
```

### rateOffice($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->rateCargo(array(

    'OfficeId'               => '1c828aa6-70c8-e211-9902-00155d037919',
    'WarehosePlacing'        => 3,
    'CargoReceiveSpeed'      => 4,
    'CargoOutputSpeed'       => 5,
    'DocumentsIssuanceSpeed' => 6,
    'DeliverySpeed'          => 7,
    'TarrifsRate'            => 8,
    'CargoLoadTarrifs'       => 9,
    'WorkersCulture'         => 10,
    'QualityInGeneral'       => 11,
    'YourRecomendations'     => 'text',
    'ClientNumber'           => '1234567890',
    'Name'                   => 'name',
    'LastName'               => 'last name',
    'SecondName'             => 'second name',
    'Phone'                  => '123456',
    'Email'                  => 'name@name.com',
    'CompanyName'            => 'text',

)));
```

### rateCargo($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->rateCargo(array(

    'ContactName' => 'contact name',
    'Name'        => 'name',
    'PhoneNumber' => '123456',
    'Email'       => 'name@name.com',
    'Area'        => 'text',
    'City'        => 'text',
    'Address'     => 'text',
    'AccessMode'  => '1',
    'Weight'      => 1,
    'Size'        => 2,
    'Quantity'    => 3,
    'Date'        => '01.10.2017',
    'Time'        => '09:30',
    'Note'        => 'text',
    'IsFloor'     => true,
    'Floor'       => 10,
    'ToCity'      => 'qwe',

)));
```

### auth($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->rateCargo(array(

    'UserName'	=>	'name@name.com',
    'Password'	=>	'password',
    'RememberMe'	=>	true

)));
```

### exitAuth() ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAutho->exitAuth());
```

### getUser() ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAutho->getUser());
```

### userReceipt($data = array()) ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->userReceipt(array(

    'page' => 1,
    'rows' => 2,
    'type' => 1, //0 - Отправки , 1 - Получения

)));
```

### cardClient() ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto('KEY_AUTH', 'KEY_SECRET');

print_r($devAuto->cardClient());
```

### invoiceClient() ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto('KEY_AUTH', 'KEY_SECRET');

print_r($devAuto->invoiceClient());
```

### cargoCategory() ###
```php
<?php

use DeliveryAuto\Auto;

include_once __DIR__ . '/vendor/autoload.php';

$devAuto = new Auto();

print_r($devAuto->cargoCategory());
```