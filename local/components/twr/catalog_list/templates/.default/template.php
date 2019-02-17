Количество товаров: <?=count($arResult['ITEMS'])?>
<br><br>
<div class="product-list row">
    <?php foreach ($arResult['ITEMS'] as $item):?>
        <div class="col-sm-3">
            <div class="item">
                <div class="title"><?=$item['NAME']?></div>
                <?php if($item['MIN_PRODUCT_PRICE']):?>
                    <div class="price">от <?=$item['MIN_PRODUCT_PRICE']['PRICE']?> <?=$item['MIN_PRODUCT_PRICE']['CURRENCY']?></div>
                <?php endif?>
            </div>
        </div>
    <?php endforeach ?>
</div>