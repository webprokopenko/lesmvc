<?php

require_once(ROOT."/views/layouts/header.php");?>
<div class="page__wrapper">
        <div class="page__container">
            <div class="page__row clearfix">
                <ul class="breadcrumbs list">
                    <li class="list__item breadcrumbs__item">
                        <a href="/" class="breadcrumbs__link">Главная</a>
                    </li>
                    <li class="list__item breadcrumbs__item">
                        Рынок продаж и покупок
                    </li>
                </ul>
                <div class="pagination">
                    <ul class="pagination__list list">
                        <?php echo $pagination->get(); ?>
                    </ul>
                </div>
            </div>
            <div class="page__row page__middle clearfix">
                <main class="content page__region">
                    <section class="content__block">
                            <div class="join_us">
                                <h3>Хотите БЕСПЛАТНО оставлять свои объявления на нашем сайте - <a href="/registration/">регистрируйтесь</a></h3>
                            </div>
                            <div class="add_obj">
                            </div>
                        <ul class="catalog catalog_style_grid list">
                            <?php foreach($market_all_list as $market_list): ?>
                                <li class='list__item catalog-item'>
                                    <div class='catalog-item__img-wrapper'>
                                        <?php if($market_list['id_prod_category']==1):?>
                                            <img src='/template/img/krugluak.jpg' class='catalog-item__img' alt='Кругляк(Круглый лес)'>
                                            <?php elseif($market_list['id_prod_category']==2):?>
                                            <img src='/template/img/doska.jpg' class='catalog-item__img' alt='Доска'>
                                            <?php elseif($market_list['id_prod_category']==3):?>
                                            <img src='/template/img/furnitura.jpg' class='catalog-item__img' alt='Фурнитура'>
                                            <?php endif?>
                                    </div>
                                    <div class='catalog-item__body'>
                                        <div class='catalog-item__name'>
                                            <a href='#' class='catalog-item__link'><?=$market_list['name_company'];?></a>
                                        </div>
                                        <div class='catalog-item__specs'>
                                            <div class='field'>
                                                <div class='field__name'>
                                                    Тип объявления
                                                </div>
                                                <div class='field__value'>
                                                    <?if($market_list['id_type_action']==1):?>
                                                        Купит
                                                    <?endif;?>
                                                    <?if($market_list['id_type_action']==2):?>
                                                        Продаст
                                                    <?endif;?>
                                                </div>
                                            </div>
                                            <div class='field'>
                                                <div class='field__name'>Категория</div>
                                                <div class='field__value'><?=$market_list['name_prod_category']?></div>
                                            </div>
                                            <div class='field'>
                                                <div class='field__name'>Цена</div>
                                                <div class='field__value'><?=$market_list['cena']?> грн.</div>
                                            </div>
                                            <div class='field'>
                                                <div class='field__name'>Количество</div>
                                                <div class='field__value'><?=$market_list['col_vo']?></div>
                                            </div>
                                            <div class='field'>
                                                <div class='field__name'>Происхождение</div>
                                                <div class='field__value'><?=$market_list['name_country']?></div>
                                            </div>
                                            <div class='field'>
                                                <div class='field__name'>Дата</div>
                                                <div class='field__value'><?=$market_list['data_actuality']?></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach;?>
                        </ul>
                        <?php echo $pagination->get(); ?>
                    </section>
                    <section class="content__block page-description">
                        <h2 class="content__block__header page-description__header">Пара слов о компании ForestTrade</h2>
                        <div class="page-description__body">
                            <p>Мы с 2001 года занимаемся экспортом леса. У нас в команде работают только профессионалы. Мы лучшие на рынке леснической продукции включая такие страны как Украина,Китай.</p>
                            <p>На данном сайте вы можете ознакомиться с нашей продукцией, а также оставить свои объявления. Присоединяйтесь к команде профессионалов. Будьте вместе с лучшими</p>
                        </div>
                    </section>
                </main>
                <? require_once("/views/layouts/menu.php") ?>
            </div>
        </div>
    <div class="to-top" id="to-top">Наверх</div>
</div>
<?php require_once(ROOT."/views/layouts/footer.php");?>
