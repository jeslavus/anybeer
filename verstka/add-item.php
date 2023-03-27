<?php require_once "templates/header.php";?>

<section class="add_item">
    <div class="container blocks_wrap blocks_wrap_pub">
        <?php require_once "templates/left_block.php";?>
        <div class="right_block">
            <h1>Добавить товар</h1>
            <form action="">
                <ul class="inputs_registration_wrap">
                    <li class="inputs_item">
                        <span>Название пива:</span>
                        <input class="input_registration" type="text" placeholder="Пивасик">
                    </li>
                    <li class="inputs_item">
                        <span>Тип пива:</span>
                        <div class="service_flex_item">
                            <input class="input_registration" type="text" placeholder="Лагер">
                            <?php //require "assets/svg/arrow_menu.php"; ?>
                        </div>
                        <div class="dropdown_menu_header">
                            <span>Test</span>
                        </div>
                    </li>
                    <li class="inputs_item">
                        <span>Прозрачность:</span>
                        <div class="service_flex_item">
                            <input class="input_registration" type="text" placeholder="Нефильтрованное">
                            <?php //require "assets/svg/arrow_menu.php"; ?>
                        </div>
                        <div class="dropdown_menu_header">
                            <span>Test</span>
                        </div>
                    </li>
                    <li class="inputs_item">
                        <span>Цвет:</span>
                        <div class="service_flex_item">
                            <input class="input_registration" type="text" placeholder="Красный эль">
                            <?php //require "assets/svg/arrow_menu.php"; ?>
                        </div>
                        <div class="dropdown_menu_header">
                            <span>Test</span>
                        </div>
                    </li>
                    <li class="inputs_item">
                        <span>Алкоголь</span>
                        <input class="input_registration" type="text" placeholder="5.44%">
                    </li>
                    <li class="inputs_item">
                        <span>IBU:</span>
                        <input class="input_registration" type="text" placeholder="60">
                    </li>
                    <li class="inputs_item">
                        <span>Добавить фотографии (не более 6 шт):</span>
                        <label>
                            <div class="add_file">
                                <div class="cross">
                                    <span></span>
                                    <span></span>
                                </div>
                                <?php //require "assets/svg/photo.php"; ?>
                            </div>
                            <input type="file">
                        </label>
                    </li>
                </ul>
                <button class="btn-standart">Продолжить</button>
            </form>
        </div>
        <div class="right_block">
            <h2>Утсановите цену и наличие товара</h2>
            <ul class="add_item_second_step">
                <li class="inputs_item">
                    <span>Тара:</span>
                    <div class="service_flex_item">
                        <input type="text" class="input_registration">
                        <?php require "assets/svg/arrow_menu.php"; ?>
                    </div>
                    <div class="dropdown_menu_header">
                        <span>Test</span>
                    </div>
                </li>
                <li class="inputs_item">
                    <span>Стоимость:</span>
                    <div class="service_flex_item">
                        <input type="text" class="input_registration">
                    </div>
                </li>
                <li class="inputs_item">
                    <span>Наличие:</span>
                    <div class="service_flex_item">
                        <input type="text" class="input_registration">
                        <?php require "assets/svg/arrow_menu.php"; ?>
                    </div>
                    <div class="dropdown_menu_header">
                        <span>Test</span>
                    </div>
                </li>
            </ul>
            <button class="btn-standart second_btn-standart">
                <div class="cross">
                    <span></span>
                    <span></span>
                </div>
                <span>Добавить тару</span>
            </button>
            <div class="second_step_btn_wrap">
                <button class="btn-standart">опубликовать пиво</button>
                <button class="btn-standart second_btn-standart">
                    <?php require "assets/svg/back-arr.php"; ?>
                    <span>Вернуться к прошлому шагу</span>
                </button>
            </div>
        </div>-->
    </div>
</section>

<?php require_once "templates/footer.php";?>