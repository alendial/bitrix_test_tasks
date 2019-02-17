<?php
require 'iblock_helper_trait.php';

class TWRCatalogList extends CBitrixComponent{
    use IBlockHelperTrait;

    public function executeComponent(){
        $iblockId = $this->arParams['IBLOCK_ID'];
        $cacheTime = $this->arParams['CACHE_TIME'];
        $sectionCode = pathinfo($_SERVER['REDIRECT_URL'], PATHINFO_BASENAME);

        $cacheObj = Bitrix\Main\Data\Cache::createInstance();
        if ($cacheObj->initCache($cacheTime, 'elements_' . $sectionCode, '/twrcatalog_' . $iblockId)) {
            $this->arResult['ITEMS'] = $cacheObj->getVars();
        }elseif($cacheObj->startDataCache()) {
            $this->arResult['ITEMS'] = $this->GetCurrentSectionProductList($iblockId, $sectionCode);

            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache('/twrcatalog_' . $iblockId);
            foreach ($this->arResult['ITEMS'] as $element) {
                /* на изменение элемента каталога*/
                $CACHE_MANAGER->RegisterTag('iblock_id_' . $element['ID']);
                foreach ($element['OFFERS'] as $offer) {
                    /* на изменение торгового предложения*/
                    $CACHE_MANAGER->RegisterTag('iblock_id_' . $offer['ID']);
                }
            }
            $CACHE_MANAGER->RegisterTag("iblock_id_new");

            $CACHE_MANAGER->EndTagCache();
            $cacheObj->endDataCache($this->arResult['ITEMS']);
        }

        $this->includeComponentTemplate();
    }

    /*постобработка товаров, добавление цен предложений*/
    function ProcessProductList($productList = false){
        if ($productList) {
            $productIdList = array_map(function($item){return $item['ID'];}, $productList);
            $offerList = CCatalogSKU::getOffersList($productIdList);
            $offerIdList = array();
            foreach ($offerList as $productKey => $offers) {
                $offerIdList = array_merge(array_keys($offers), $offerIdList);
            }

            $dbProductPrice = CPrice::GetListEx(
                array(),
                array("PRODUCT_ID" => array_merge($productIdList, $offerIdList)),
                false,
                false,
                array()
            );

            $priceList = array();
            while ($price = $dbProductPrice->fetch()) {
                $priceList[$price['PRODUCT_ID']] = $price;
            }

            foreach ($productList as &$product) {
                $product['PRODUCT_PRICE'] = $priceList[$product['ID']];
                $product['PRODUCT_PRICE_LIST'][0] = $product['PRODUCT_PRICE'];
                $product['OFFERS'] = $offerList[$product['ID']];
                foreach ($product['OFFERS'] as $offerKey => $offer) {
                    $product['OFFERS'][$offerKey]['OFFER_PRICE'] = $priceList[$offerKey];
                    $product['PRODUCT_PRICE_LIST'][$offerKey] = $priceList[$offerKey];
                }
                usort($product['PRODUCT_PRICE_LIST'], function($a,$b){return ($a['PRICE']-$b['PRICE']);});
                $product['MIN_PRODUCT_PRICE'] = current($product['PRODUCT_PRICE_LIST']);
                $product['MAX_PRODUCT_PRICE'] = end($product['PRODUCT_PRICE_LIST']);
                reset($product['MIN_PRODUCT_PRICE']);
            }
        }
        return $productList;
    }

    function GetCurrentSectionProductList($iblockId = false, $sectionCode = false){
        if ($iblockId) {
            $products = $this->GetElementList($iblockId, !$sectionCode ? array() : array('SECTION_CODE'=> $sectionCode, 'INCLUDE_SUBSECTIONS' => 'Y'));
            if (CModule::IncludeModule("catalog") && CCatalog::GetByID($iblockId)){
                $products = $this->ProcessProductList($products);
            }
            return $products;
        }
        return array();
    }
}