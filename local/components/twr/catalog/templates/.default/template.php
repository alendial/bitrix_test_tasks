<?php
function RecursiveMenu($sectionArray){?>
    <ul>
        <?php foreach ($sectionArray as $key => $section): ?>
            <li>
                <a href="<?=$section['SECTION_PAGE_URL']?>"><?=$section['NAME']?></a>
                <?php if ($section['CHILD']) RecursiveMenu($section['CHILD']);?>
            </li>
        <?php endforeach ?>
    </ul>
<?php } ?>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <?php RecursiveMenu($arResult['SECTION_TREE']);?>
        </div>
        <div class="col-sm-8">
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
        </div>
    </div>
</div>