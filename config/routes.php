<?php

return array(

    //Регистрация
    'registration/add' => 'registration/add', // actionAdd в RegistrationController
    'registration' => 'registration/index', // actionIndex в RegistrationController
    //Авторизация
    'authorization' => 'authorization/authoriz', // actionAuthoriz в AuthorizationController
    'logout' => 'authorization/logout', // actionLogout в AuthorizationController

    //Рынок продаж и покупок
    //Продажа
    'marketsale/add' => 'marketsale/add', // actionAdd в MarketSaleController
    'marketsale/page-([0-9]+)' => 'marketsale/index/$1', // actionIndex в MarketSaleController + page
    'marketsale' => 'marketsale/index', // actionIndex в MarketSaleController
    //Покупка
    'marketbuy/add' => 'marketbuy/add', // actionAdd в MarketBuyController
    'marketbuy/page-([0-9]+)' => 'marketbuy/index/$1', // actionIndex в MarketSaleController + page
    'marketbuy' => 'marketbuy/index', // actionIndex в MarketSaleController

    //Технологии покупка
    'technologybuy/add' => 'technologybuy/add', // actionAdd в TechnologyBuyController
    'technologybuy/page-([0-9]+)' => 'technologybuy/index/$1', // actionIndex в TechnologyBuyController + page
    'technologybuy' => 'technologybuy/index', // actionIndex в TechnologyBuyController

    //Технологии продажа
    'technologysale/add' => 'technologysale/add', // actionAdd в TechnologySaleController
    'technologysale/page-([0-9]+)' => 'technologysale/index/$1', // actionIndex в TechnologyBuyController + page
    'technologysale' => 'technologysale/index', // actionIndex в TechnologyBuyController

    //Технологии парнеры
    'partners/add' => 'partners/add', // actionAdd в PartnersController
    'partners/page-([0-9]+)' => 'partners/index/$1', // actionIndex в PartnersController + page
    'partners' => 'partners/index', // actionIndex в TechnologyBuyController

    //Технологии парнеры
    'investors/add' => 'investors/add', // actionAdd в InvestorsController
    'investors/page-([0-9]+)' => 'investors/index/$1', // actionIndex в InvestorsController + page
    'investors' => 'investors/index', // actionIndex в InvestorsController

    //Оборудование продажа
    'equipmentsale/add' => 'equipmentsale/add', // actionAdd в EquipmentSaleController
    'equipmentsale/page-([0-9]+)' => 'equipmentsale/index/$1', // actionIndex в EquipmentSaleController + page
    'equipmentsale' => 'equipmentsale/index', // actionIndex в EquipmentSaleController
    //Оборудование покупка
    'equipmentbuy/add' => 'equipmentbuy/add', // actionAdd в EquipmentBuyController
    'equipmentbuy/page-([0-9]+)' => 'equipmentbuy/index/$1', // actionIndex в EquipmentBuyController + page
    'equipmentbuy' => 'equipmentbuy/index', // actionIndex в EquipmentBuyController

    // Главная страница
    'page-([0-9]+)' => 'site/index/$1', // actionIndex в SiteController + page
    '' => 'site/index', // actionIndex в SiteController
);
