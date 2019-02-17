<?php
if (!CModule::IncludeModule("iblock")){die();}

trait IBlockHelperTrait{
    /* получить элемент по id*/
    function GetElementById($elementId){
        if ($elementId) {
            if (is_array($elementId)) {
                $resultArray = array();
                foreach ($elementId as $_elementId) {
                    $resultArray[] = $this->GetElementById($_elementId);
                }
                return $resultArray;
            }else{
                $elementResult = CIBlockElement::GetByID($elementId);
                $elementObject = $elementResult->GetNextElement();
                if ($elementObject) {
                    $element = $elementObject->GetFields();
                    $element['PROPERTIES'] = $elementObject->GetProperties();
                    return $element;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }

    /* список элементов инфоблока*/
    function GetElementList($iblockId = 1, $filter = array('ACTIVE' => 'Y'), $sort = array('SORT' => 'ASC')) {
        $filter['IBLOCK_ID'] = $iblockId;
        $elementResult = CIBlockElement::GetList(
            $sort,
            $filter,
            false,
            false,
            array()
        );
        $elementList = array();
        while ($element = $elementResult->GetNext()) {
            $elementList[] = $this->GetElementById($element['ID']);
        }
        return $elementList;
    }

    /* список разделов инфоблока*/
    function GetSectionList($iblockId = 1, $filter = array('ACTIVE' => 'Y'), $sort = array('SORT' => 'ASC')){
        $filter['IBLOCK_ID'] = $iblockId;
        $sectionResult = CIBlockSection::GetList(
            $sort,
            $filter,
            false,
            array(),
            false
        );
        $sectionList = array();
        while ($section = $sectionResult->GetNext()) {
            $sectionList[] = $section;
        }
        return $sectionList;
    }

    /* получить каталог по id каталога и инфоблока */
    function GetSectionById($sectionId = false, $iblockId = false) {
        if ($sectionId && $iblockId) {
            $tempList = CGetSectionList($iblockId, array('ID'=> $sectionId));
            return $tempList[0];
        }else{
            return false;
        }
    }

    /* получить дерево каталогов инфоблока*/
    function GetSectionTree($IBLOCK_ID = false) {
        $arFilter         = array(
            'ACTIVE'        => 'Y',
            'IBLOCK_ID'     => $IBLOCK_ID,
            'GLOBAL_ACTIVE' => 'Y', // GLOBAL_ACTIVE - фильтр по активности, учитывая активность вышележащих разделов (Y|N);
        );
        $arSelect         = array('IBLOCK_ID', 'ID', 'NAME', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL');
        $arOrder          = array('DEPTH_LEVEL' => 'ASC', 'SORT' => 'ASC');
        $rsSections       = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
        $sectionLinc      = array();
        $arResult['ROOT'] = array();
        $sectionLinc[0]   = &$arResult['ROOT'];
        while ($arSection = $rsSections->GetNext()) {
            $sectionLinc[(int)$arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']] = $arSection;
            $sectionLinc[$arSection['ID']]                                                = &$sectionLinc[(int)$arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']];
        }

        unset( $sectionLinc );
        $arResult['ROOT'] = $arResult['ROOT']['CHILD'];
        return $arResult['ROOT'];
    }
}