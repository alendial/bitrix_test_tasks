<?php
require 'iblock_helper_trait.php';

class TWRCatalogTree extends CBitrixComponent{
    use IBlockHelperTrait;

    public function executeComponent(){
        $iblockId = $this->arParams['IBLOCK_ID'];
        $cacheTime = $this->arParams['CACHE_TIME'];
        $baseUrl = pathinfo($_SERVER['REAL_FILE_PATH'] ? $_SERVER['REAL_FILE_PATH'] : $_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME).'/';

        $cacheObj = Bitrix\Main\Data\Cache::createInstance();

        if ($cacheObj->initCache($cacheTime, 'section_tree', '/twrcatalogtree_' . $iblockId)){
            $this->arResult['SECTION_TREE'] = $cacheObj->getVars();
        }elseif($cacheObj->startDataCache()) {
            $cacheObj->startDataCache();
            $this->arResult['SECTION_TREE'] = $this->GetCatalogSectionTree($iblockId, $baseUrl);
            $cacheObj->endDataCache($this->arResult['SECTION_TREE']);
        }

        $this->includeComponentTemplate();
    }

    function GetCatalogSectionTree($iblockId = false, $baseUrl = false) {
        if ($iblockId && $baseUrl) {
            $sectionTree = $this->GetSectionTree($iblockId);
            function ProcessSectionPageUrl(&$array, $baseUrl){
                foreach ($array as &$section) {
                    $section['SECTION_PAGE_URL'] = $baseUrl . $section['CODE'] . '/';
                    if ($section['CHILD']) {
                        ProcessSectionPageUrl($section['CHILD'], $baseUrl);
                    }
                }
            }
            ProcessSectionPageUrl($sectionTree, $baseUrl);
            return $sectionTree;
        }
        return array();
    }
}