<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$module_id = "website.template";
CModule::IncludeModule($module_id);

$CWb = new CWebsiteTemplate('session');
$CWb->load();

$arSetting = $CWb->settings;
$CWb->loadCss();


