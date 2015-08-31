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
                <li class="list__item breadcrumbs__item">
                    Покупка
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
                    <?if(empty($_SESSION['user_id'])):?>
                        <div class="join_us">
                            <h3>Хотите БЕСПЛАТНО оставлять свои объявления на нашем сайте - <a href="/registration/">регистрируйтесь</a></h3>
                        </div>
                    <?endif;?>
                    <?if(!empty($_SESSION['user_id'])):?>
                        <div class="add_obj">
                            <a href="#" id="add_market_buy" class="add_obj-item">
                                Добавить объявление о покупке<br>
                            </a>
                        </div>
                    <?endif;?>
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
<!-- Начало окна добавления продажи -->
<div class="popup_add_prog" id="modal_market_buy">
    <div class="popup_prog_header">
        <button type="button" class="close" id="close"></button>
        <div class="prog_header_text">
            Добавить объявление о покупке
        </div>
    </div>
    <div class="popup_prog_body">
        <div class="popup__msg-buy">
        </div>
        <form action="/marketbuy/add/" class="form"  id="market_buy_send"  method="post">
            <label for="company" class="prog_span">Компания:<?=Market::getCompanyNameById($_SESSION['user_id'])?> <b></b></label>
            <label class="prog_span">Категория объявления: <b>Рынок продаж и покупок - Покупка</b></label>
            <label for="company" class="prog_span">Категория продукции:</label>
            <select class="select catalog-style__select" name="category_prod" id="category_prod">
                <?=Common::getCategoryProduction();?>
            </select>
            <label for="country" class="prog_span">Страна происхождения:</label>
            <select class="select catalog-style__select" name="country_proish" id="country_proish">
                <?=Common::getCountry();?>
            </select>
            <label for="cena" class="prog_span">Цена</label>
            <input type="text" class="prog_input" placeholder="Введите цену" name="cena" id="cena" qtip-position="left" qtip-content="Вы не ввели цену">
            <label for="pass" class="prog_span">Количество</label>
            <input type="text" class="prog_input" placeholder="Введите количество" name="col_vo" id="col_vo" qtip-position="left" qtip-content="Вы не ввели количество">
            <input type="hidden" name="token" id="token" value="<?=Common::token()?>"/>
            <div class="prog_row">
                <button type="submit" class="btn">Добавить объявление о покупке</button>
            </div>
        </form>
    </div>
</div>
<!-- конец окна добавления продажи -->
<?php require_once(ROOT."/views/layouts/footer.php");?>
<script src="/template/js/add_market_buy.js"></script>
<script>
    $("#main").removeClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active").addClass("catalog-nav__trigger catalog-nav__link");
    $("#market").addClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active");
    $("#market_ul").addClass("catalog-nav__subnav_opened");
    $("#main_ul").removeClass("catalog-nav__subnav_opened");
</script>
