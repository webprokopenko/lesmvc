<?php

/**
 * Контроллер SiteController
 */
Class SiteController
{
    public function actionIndex($page=1)
    {
        $page = intval($page);
        $market_all_list = Market::getAllMarket($page);


        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Market::getTotalMarket();

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Market::SHOW_BY_DEFAULT, 'page-');

        //Подключаем вид
        require_once(ROOT.'/views/site/index.php');

        return true;
    }
}