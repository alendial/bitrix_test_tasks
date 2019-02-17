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

<?php RecursiveMenu($arResult['SECTION_TREE']);?>