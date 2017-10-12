<?php
/**
 *    module: DeliveryAuto API 3.2
 *    author: Evgen Kitonin
 *    version: 1.0
 *    create: 08.10.2017
 **/
namespace DeliveryAuto;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Auto
{
    /**
     *    API KEY
     *
     *    @var string
     *
     **/
    private $api_key = null;
    /**
     *    LANGUAGE DATA
     *
     *    @var string
     *
     **/
    private $culture = 'ru';
    /**
     *
     *
     *
     *
     **/
    private $country = 1;
    /**
     *    VERSION API
     *
     *    @var string
     *
     **/
    private $version = 'v4';
    /**
     *    URL API
     *
     *    @var string
     *
     **/
    private $api = 'http://www.delivery-auto.com/api/';
    /**
     *
     *
     *
     **/
    public function __construct($key = '', $lang = 'ru', $country = 1)
    {
        return $this
            ->setKey($key)
            ->setCulture($lang)
            ->setCountry($country);
    }
    /**
     *
     *
     *
     **/
    public function __destruct()
    {
    }
    /**
     *
     *
     *
     **/
    private function setKey($key)
    {
        $this->api_key = $key;
        return $this;
    }
    /**
     *
     *
     *
     **/
    private function setCulture($lang)
    {
        if ($lang == 'ru') {

            $lang = 'ru-RU&';

        } else if ($lang == 'ua') {

            $lang = 'uk-UA&';

        } else {

            $lang = 'en-US&';

        }
        $this->culture = $lang;
        return $this;
    }
    /****/
    private function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }
    /****/
    private function prepare($data, $type = 'get')
    {
        if ($type == 'post') {

            return json_encode($data, JSON_UNESCAPED_UNICODE);

        } else {

            return http_build_query($data);

        }

    }
    /**
     *
     *
     *
     *
     **/
    private function requestData($method, $param = '', $type = 'get')
    {
        $this->api = $this->api . $this->version . '/Public/' . $method;

        $client = new Client(array(
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
        ));

        try {

            switch ($type) {

                case 'get':
                    $this->api = $this->api . '?culture=' . $this->culture . $param;
                    $response  = $client->get($this->api);
                    break;
                case 'post':
                    $response = $client->post($this->api, array(
                        'body' => $param,
                    ));
                    break;
            }

            return $response->getBody()->getContents();

        } catch (RequestException $e) {

            return $e->getResponse()->getBody()->getContents();

        }
    }
    /**
     *  ПЕРЕВІРКА КРАЇНИ
     *  ПРОВЕРКА СТРАНЫ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return array
     *
     **/
    private function checkCountry($data = array())
    {
        if (!isset($data['country'])) {
            $data['country'] = $this->country;
        }
        return $data;
    }
    /**
     *  ВСТАНОВЛЮЄМО ВАЛЮТУ КРАЇНИ
     *  УСТАНАВЛИВАЕМ ВАЛЮТУ СТРАНЫ
     *
     *  @param  string  $curr   STRING CURRENCY ua || ru - гривна || рубль
     **/
    private function getCurrency($curr = '')
    {
        if ($this->country == 1 && empty($curr) ? true : $curr == 'ua') {

            $curr = 100000000;

        } elseif ($this->country == 2 && empty($curr) ? true : $curr == 'ru') {

            $curr = 100000001;

        }
        return $curr;
    }
    private function setCurrency($data = array())
    {
        $data['currency'] = $this->getCurrency($data['currency']);

        return $data;
    }
    /**
     *    ОТРИМАТИ ПЕРЕЛІК ОБЛАСТЕЙ
     *    ПОЛУЧИТЬ СПИСОК ОБЛАСТЕЙ
     *
     *    @return string
     **/
    public function regionList()
    {
        return $this->requestData('GetRegionList');
    }
    /**
     *    ОТРИМАТИ ПЕРЕЛІК МІСТ
     *    ПОЛУЧИТЬ СПИСОК ГОРОДОВ
     *
     *    @param boolean    $fl_all      EXISTS COMPANY IN AREAS
     *    @param int        $regionId    REGION ID
     *
     *    @return string
     *
     **/
    public function areasList($data = array())
    {
        return $this->requestData('GetAreasList', $this->prepare($this->checkCountry($data)));
    }
    /**
     *  ОТРИМАННЯ СПИСКУ ПРЕДСТАВНИЦТВ
     *  ПОЛУЧЕНИЕ СПИСКА ПРЕДСТАВИТЕЛЬСТВ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function warehousesList($data = array())
    {
        return $this->requestData('GetWarehousesList', $this->prepare($this->checkCountry($data)));
    }
    /**
     *  ОТРИМАННЯ ДОКЛАДНОЇ ІНФОРМАЦІЇ ПРО ПРЕДСТАВНИЦТВО
     *  ПОЛУЧЕНИЕ ПОДРОБНОЙ ИНФОРМАЦИИ О ПРЕДСТАВИТЕЛЬСТВЕ
     *
     *  @param  string  $id     ID WAREHOUSE
     *
     *  @return json
     *
     **/
    public function getWarehouse($id)
    {
        return $this->requestData('GetWarehousesInfo', '&WarehousesId=' . $id);
    }
    /**
     *  ПОШУК ПРЕДСТАВНИЦТВ
     *  ПОИСК ПРЕДСТАВИТЕЛЬСТВ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function findWarehouse($data = array())
    {
        return $this->requestData('GetFindWarehouses', $this->prepare($data));
    }
    /**
     *  ОТРИМАННЯ СПИСКУ ПРЕДСТАВНИЦТВ ПО ID МІСТА
     *  ПОЛУЧЕНИЕ СПИСКА ПРЕДСТАВИТЕЛЬСТВ ПО ID ГОРОДА
     *
     *  @param array    $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function getWarehouseCity($data = array())
    {
        return $this->requestData('GetWarehousesListInDetail', $this->prepare($this->checkCountry($data)));
    }
    /**
     *  ПОШУК КВИТАНЦІЇ
     *  ПОИСК КВИТАНЦИИ
     *
     *  @param  string  $number     NUMBER TTH
     *
     *  @return json
     *
     **/
    public function getReceipt($number)
    {
        return $this->requestData('GetReceiptDetails', '&number=' . $number);
    }
    /**
     *  РОЗРАХУНОК ЧАСУ ДОСТАВКИ
     *  РАСЧЕТ ВРЕМЕНИ ДОСТАВКИ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function timeDelivery($data = array())
    {
        return $this->requestData('GetDateArrival', $this->prepare($this->setCurrency($data)));
    }
    /**
     *  ПОКАЗАТИ СПИСОК ДОП. ПОСЛУГ
     *  ПОКАЗАТЬ СПИСОК ДОП. УСЛУГ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function getDopUslugi($data = array())
    {
        return $this->requestData('GetDopUslugiClassification', $this->prepare($this->setCurrency($data)));
    }
    /**
     *  ПОКАЗАТИ СПИСОК ТАРИФІВ
     *  ПОКАЗАТЬ СПИСОК ТАРИФОВ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function getTariffList($data = array())
    {
        return $this->requestData('GetTariffCategory', $this->prepare($data));
    }
    /**
     *  ПОКАЗАТИ СПИСОК СХЕМ ДОСТАВОК
     *  ПОКАЗАТЬ СПИСОК СХЕМ ДОСТАВОК
     *
     *  @param  array   $data   DATA ARRAY_A
     *
     *  @return json
     *
     **/
    public function deliveryScheme($data = array())
    {
        return $this->requestData('GetDeliveryScheme', $this->prepare($data));
    }
    /**
     *  РОЗРАХУНОК ВАРТОСТІ ПЕРЕВЕЗЕННЯ
     *  РАСЧЕТ СТОИМОСТИ ПЕРЕВОЗКИ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function costDelivery($data = array())
    {
        return $this->requestData('PostReceiptCalculate', $this->prepare($data, 'post'), 'post');
    }
    /**
     *  ПОКАЗАТИ НОВИНИ КОМПАНІЇ
     *  ПОКАЗАТЬ НОВОСТИ КОМПАНИИ
     *
     *  @param  int     $count  COUNT PAGE
     *  @param  int     $page   PAGE NUMBER
     *
     *  @return json
     *
     **/
    public function newsCompany($count = 5, $page = 1)
    {
        return $this->requestData('GetNews', '&count=' . $count . '&page=' . $page);
    }
    /**
     *  ПОКАЗАТИ ТЕМИ ПОВІДОМЛЕНЬ
     *  ПОКАЗАТЬ ТЕМЫ СООБЩЕНИЙ
     *
     *  @return json
     *
     **/
    public function themeMessages()
    {
        return $this->requestData('GetMessagesTheme');
    }
    /**
     *  ВІДПРАВЛЕННЯ ПОВІДОМЛЕННЯ
     *  ОТПРАВЛЕНИЕ СООБЩЕНИЯ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function sendMessage($data = array())
    {
        return $this->requestData('PostContactsMessage', $this->prepare($data, 'post'), 'post');
    }
    /**
     *  ВІДПРАВЛЕННЯ ОЦІНКИ ВІДДІЛЕННЯ
     *  ОТПРАВЛЕНИЕ ОЦЕНКИ ОТДЕЛЕНИЯ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function rateOffice($data = array())
    {
        return $this->requestData('PostServiceRate', $this->prepare($tdata, 'post'), 'post');
    }
    /**
     *  ВІДПРАВЛЕННЯ ОЦІНКИ ПЕРЕВЕЗЕННЯ
     *  ОТПРАВЛЕНИЕ ОЦЕНКИ ПЕРЕВОЗКИ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function rateCargo($data = array())
    {
        return $this->requestData('PostPickUpCargo', $this->prepare($data, 'post'), 'post');
    }
    /**
     *  АВТОРИЗАЦІЯ
     *  АВТОРИЗАЦИЯ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function auth($data = array())
    {
        return $this->requestData('PostLogin', $this->prepare($data, 'post'), 'post');
    }
    /**
     *  ВИЙТИ З ПРОФІЛЮ
     *  ВЫЙТИ С ПРОФИЛЯ
     *
     *  @return json
     *
     **/
    public function exitAuth()
    {
        return $this->requestData('PostLogoff', '', 'post');
    }
    /**
     *  ОТРИМАТИ ІНФОРМАЦІЮ ПРО КОРИСТУВАЧА
     *  ПОЛУЧИТЬ ИНФОРМАЦИЮ О ПОЛЬЗОВАТЕЛЕ
     *
     *  @return json
     *
     **/
    public function getUser()
    {
        return $this->requestData('GetUserInfo');
    }
    /**
     *  ОТРИМАТИ КВИТАНЦІЮ КОРИСТУВАЧА
     *  ПОЛУЧИТЬ КВИТАНЦИЮ ПОЛЬЗОВАТЕЛЯ
     *
     *  @param  array   $data   DATA ARRAY
     *
     *  @return json
     *
     **/
    public function userReceipt($data)
    {
        return $this->requestData('GetUserReceipt', $this->prepare($data));
    }
}
