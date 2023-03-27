<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Список пивоваров");
?>

<!--<style>
    ul{
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }
    .brev_list_item {
        background: #fff;
        padding: 24px;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: space-between;
    }
</style>
<section class="brev_list_section"></section>
    <div class="container">
        <ul class="brev_list">
                <?php for($i=0; $i<8; $i++){ ?>
                <li class="brev_list_item">
                    <img src="../images/brev.png" alt="">
                    <h3>CHIBIS Brewery</h3>
                    <p>г. Санкт-Петербург</p>
                </li>
                <?php }; ?>
            </ul>
    </div>
</section>-->


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>