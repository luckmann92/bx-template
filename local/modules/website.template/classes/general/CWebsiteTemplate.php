<?php
CModule::IncludeModule('iblock');
CModule::IncludeModule('highloadblock');

use Bitrix\Highloadblock as HL;

class CWebsiteTemplate {
    public  $module_id = 'website.template';
    private $HLBlockIdColors = 1;
    private $HLBlockIdFonts = 2;

    public $arColors = array();
    public $arFonts = array();
    public $arHomePage = array();
    public $arSetting = array();
    public $arFontSizes = array();

    public function __construct()
    {
        $this->arColors = $this->getElementsHLBlock($this->HLBlockIdColors);
        $this->arFonts = $this->getElementsHLBlock($this->HLBlockIdFonts);
        $this->arHomePage = $this->getViewTemplate('home_page');
        $this->arSetting = $this->getTemplateSetting();
        $this->arFontSizes = array(
            '13' => '13px',
            '15' => '15px',
            '17' => '17px',
        );
    }

    public function setTemplateSetting($arSetting)
    {
        if (empty($arSetting)) {
            return false;
        } else {
            $curSetting = $this->arSetting;
            foreach ($arSetting as $code => $value) {
                if (isset($curSetting[$code])) {
                    if (is_array($value)) {
                        foreach ($value as $k => $val) {
                            $curSetting[$code][$k] = $val;
                        }
                    } else {
                        $curSetting[$code] = $value;
                    }
                }

            }
        }
        $templateSettingsFile = $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/.settings.json';

        return file_put_contents($templateSettingsFile, json_encode($curSetting)) ? true : false;
    }

    private function getViewTemplate($type)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/views/modules/' . $type . '/';
        $arTemplates = array();

        if (is_dir($path)) {
            foreach (scandir($path) as $value) {
                if ($value !== '.' && $value !== '..') {
                    $tpl_path = $path . $value . '/';
                    if (is_dir($tpl_path)) {
                        $tpl = scandir($tpl_path);
                        $template['ID'] = $value;
                        foreach ($tpl as $file) {
                            if ($file !== '.' && $file !== '..') {
                                if (file_exists($tpl_path . 'template.php')) {
                                    if (file_exists($tpl_path . '.description.php')) {
                                        $desc = file_get_contents($tpl_path . '.description.php');
                                        $template['NAME'] = $desc ?: $value;
                                    }
                                    if (file_exists($tpl_path . 'preview.png')) {
                                        $template['PICTURE'] = SITE_TEMPLATE_PATH .'/views/modules/' . $type . '/' . $value . '/preview.png';
                                    }
                                }
                            }
                        }
                        $arTemplates[] = $template;
                        unset($template);
                    }
                }
            }
        }
        return $arTemplates;
    }

    public function getElementsHLBlock($id)
    {
        if(($entityDataClass = $this->getEntityDataClass($id)) != false){
            $rsData = $entityDataClass::getList(array('select' => array('*')));
            $elements = array();
            while ($arFields = $rsData->fetch()) {
                foreach ($arFields as $code => $field) {
                    if (strpos($code, 'UF') === false) {
                        $elements[$arFields['ID']][$code] = $field;
                    } else {
                        $elements[$arFields['ID']][str_replace('UF_', '', $code)] = $field;
                    }
                }
            }
            return $elements;
        } else {
            return false;
        }
    }

    private function getEntityDataClass($id)
    {
        $hlblock = HL\HighloadBlockTable::getById($id)->fetch();
        if($hlblock['ID'] > 0){
            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $result = $entity->getDataClass();
        } else {
            $result = false;
        }
        return $result;
    }

    public function getCssFonts($font_type, $font_code = 'default')
    {
        if (empty($font_type)) {
            return false;
        }
        $key = $this->recursive_array_search($font_code, $this->arFonts);
        if ($key && !empty($this->arFonts[$key])) {
            if ($this->arFonts[$key]['FONT_SRC']) {
                \Bitrix\Main\Page\Asset::getInstance()->addCss($this->arFonts[$key]['FONT_SRC']);
            }
            $css = SITE_TEMPLATE_PATH . '/public/css/fonts/' . $font_type . '_' . $font_code . '.css';
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $css)) {
                $path = $_SERVER['DOCUMENT_ROOT'] . '/local/tools/fonts/' . $font_type . '.css';
                $content = file_get_contents($path);
                $content = str_replace($font_type, $this->arFonts[$key]['FONT_NAME'], $content);
                //return $css;
                if (file_put_contents($_SERVER['DOCUMENT_ROOT'] . $css, $content)) {
                    \Bitrix\Main\Page\Asset::getInstance()->addCss($css);
                    return true;
                } else {
                    return false;
                }
            } else {
                \Bitrix\Main\Page\Asset::getInstance()->addCss($css);
                return true;
            }
        }
    }

    public function getCssSizeFonts($size)
    {
        if (empty($size)) {
            return false;
        }
        $css = SITE_TEMPLATE_PATH . '/public/css/fonts/size' . $size . '.css';
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $css)) {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/local/tools/fonts/FONT_SIZE.css';
            $content = file_get_contents($path);
            $content = str_replace('SIZE', $size, $content);
            if (file_put_contents($_SERVER['DOCUMENT_ROOT'] . $css, $content)) {
                \Bitrix\Main\Page\Asset::getInstance()->addCss($css);
                return true;
            } else {
                return false;
            }
        } else {
            \Bitrix\Main\Page\Asset::getInstance()->addCss($css);
            return true;
        }
    }

    public function getCssColorTheme($color_type, $color_code = 'default')
    {
        if (empty($color_type)) {
            return false;
        }
        $key = $this->recursive_array_search($color_code, $this->arColors);
        if ($key && !empty($this->arColors[$key])) {
            $css = SITE_TEMPLATE_PATH . '/public/css/theme/' . $color_type . '_' . $color_code . '.css';
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $css)) {
                $path = $_SERVER['DOCUMENT_ROOT'] . '/local/tools/themes/' . $color_type . '.css';
                $content = file_get_contents($path);
                $content = str_replace($color_type, '#' . $this->arColors[$key]['COLOR_HEX'], $content);
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . $css, $content);
            }
            \Bitrix\Main\Page\Asset::getInstance()->addCss($css);
            return true;
        } else {
            return false;
        }
    }

    function recursive_array_search($needle, $haystack)
    {
        foreach ($haystack as $key => $value) {
            $current_key = $key;
            if ($needle === $value || (is_array($value) && $this->recursive_array_search($needle, $value) !== false)) {
                return $current_key;
            }
        }
        return false;
    }

    public function getTemplateSetting()
    {
        $templateSettingsFile = $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/.settings.json';
        $defaultSetting = array(
            'SHOW_PANEL' => COption::GetOptionString($this->module_id, 'WEBSITE_TEMPLATE_SETTING_VIEW_PANEL', 'Y', SITE_ID),
            'TEMPLATE_TYPE' => 'CATALOG',
            'HEADER' => 'default',
            'HOME_PAGE' => 'default',
            'FAST_ORDER' => 'Y',
            'COLORS' => array(
                'MAIN' => 'default',
                'ACTION' => 'default',
            ),
            'FONT_SIZE' => 'middle',
            'FONT' => array(
                'SIMPLE' => 'default',
                'TITLE' => 'default'
            ),
            'LOGO' => 'default'
        );
        return file_exists($templateSettingsFile) ? $this->object_to_array(json_decode(file_get_contents($templateSettingsFile)))
            : $defaultSetting;
    }
    
    static function onBeforeElementUpdateHandler($arFields){
        // чтение параметров модуля
        // $iblock_id = COption::GetOptionString(self::$MODULE_ID, "iblock_id");

        // Активная деятельность

        // Результат
        return true;
    }

    function object_to_array($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = $this->object_to_array($value);
            }
            return $result;
        }
        return $data;
    }

    public function result()
    {
        return array(
            'TEMPLATE_TYPE' => array('COMPANY' => 'Сайт компании', 'CATALOG' => 'Сайт с каталогом/услугами', 'SHOP' => 'Интернет-магазин'),
            'FONTS' => $this->arFonts,
            'COLORS' => $this->arColors,
            'HOME_PAGE' => $this->arHomePage,
            'FONT_SIZE' => $this->arFontSizes,
        );
    }
}