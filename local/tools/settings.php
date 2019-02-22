<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$module_id = "website.template";
CModule::IncludeModule($module_id);

$wb = new CWebsiteTemplate();

$arSetting = $wb->arSetting;
