<?php
class TWRComplexCatalog extends CBitrixComponent{

    public function executeComponent(){
        $sectionCode = pathinfo($_SERVER['REDIRECT_URL'], PATHINFO_BASENAME);
        if (isset($sectionCode) && !empty($sectionCode)) {
            $componentPage = 'list';
        } else {
            $componentPage = 'tree';
        }
        $this->includeComponentTemplate($componentPage);
    }
}