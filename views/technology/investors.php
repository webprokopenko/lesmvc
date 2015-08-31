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
                    Технологии
                </li>
                <li class="list__item breadcrumbs__item">
                    Найти инвестора
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
                            <a href="#" id="add_investors" class="add_obj-item">
                                Добавить объявление о поиске инвестора<br>
                            </a>
                        </div>
                    <?endif;?>
                    <ul class="catalog catalog_style_grid list">
                        <?php foreach($investors_all_list as $technology_list): ?>
                            <li class='list__item catalog-item'>
                                <div class='catalog-item__img-wrapper'>
                                    <img src='/template/img/investor.jpg' class='catalog-item__img' alt='Партнеры'>
                                </div>
                                <div class='catalog-item__body'>
                                    <div class='catalog-item__name'>
                                        <a href='#' class='catalog-item__link'><?=$technology_list['name_company'];?></a>
                                    </div>
                                    <div class='catalog-item__specs'>
                                        <div class='field'>
                                            <div class='field__name'>Дата</div>
                                            <div class='field__value'><?=$technology_list['data_actuality']?></div>
                                        </div>
                                        <div class='field'>
                                            <div class='field__name'>Телефон</div>
                                            <div class='field__value'><?=$technology_list['phone']?></div>
                                        </div>
                                        <div class='field'>
                                            <div class='field__name'>Описание партнерства</div>
                                            <div class='field__value'><?=$technology_list['opisanie_investor']?></div>
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
<?php if($_SESSION['user_id']):?>
    <div class="popup_add_prog" id="modal_technology_sale">
        <div class="popup_prog_header">
            <button type="button" class="close" id="close"></button>
            <div class="prog_header_text">
                Добавить объявление о поиске инветора
            </div>
        </div>
        <div class="popup_prog_body">
            <div class="popup__msg">
            </div>
            <form action="/investors/add/" class="form"  id="market_investors_send"  method="post" enctype="multipart/form-data">
                <label for="company" class="prog_span">Компания: <b><?=Market::getCompanyNameById($_SESSION['user_id']);?></b></label>
                <label class="prog_span">Категория объявления: <b>Технологии - поиск инвестора</b></label>
                <label for="nazvanie" class="prog_span">Описание:</label>
                <textarea name="opisanie"  id="opisanie" rows="4" class="input h_a" placeholder="Описание (кого вы ищете, для каких целей)" qtip-position="left" qtip-content="Вы не ввели описание"></textarea>
                <input type="hidden" name="token" id="token" value="<?=Common::token();?>"/>
                <div class="prog_row">
                    <button type="submit" class="btn">Добавить объявление о поиске инвестора</button>
                </div>
            </form>
        </div>
    </div>
    <!-- конец окна добавления продажи -->
<?php endif; ?>
<?php require_once(ROOT."/views/layouts/footer.php");?>
<script src="/template/js/add_investors.js"></script>
<script>
    $("#main").removeClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active").addClass("catalog-nav__trigger catalog-nav__link");
    $("#technology").addClass("catalog-nav__trigger_active catalog-nav__link catalog-nav__link_active");
    $("#technology_ul").addClass("catalog-nav__subnav_opened");
    $("#main_ul").removeClass("catalog-nav__subnav_opened");
</script>
