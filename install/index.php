<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

class ilimurzin_typograf extends CModule
{
    public $MODULE_ID = 'ilimurzin.typograf';

    public function __construct()
    {
        Loc::loadMessages(__FILE__);

        $arModuleVersion = null;

        include __DIR__ . '/version.php';

        if (isset($arModuleVersion) && is_array($arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = Loc::getMessage('ILIMURZIN_TYPOGRAF_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('ILIMURZIN_TYPOGRAF_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('ILIMURZIN_TYPOGRAF_PARTNER_NAME');
        $this->PARTNER_URI = Loc::getMessage('ILIMURZIN_TYPOGRAF_PARTNER_URI');
    }

    public function DoInstall(): void
    {
        $this->InstallDB();
        $this->InstallFiles();
        $this->InstallEvents();
    }

    public function DoUninstall(): void
    {
        $this->UnInstallDB();
        $this->UnInstallFiles();
        $this->UnInstallEvents();
    }

    public function InstallDB(): void
    {
        ModuleManager::registerModule($this->MODULE_ID);
    }

    public function UnInstallDB(): void
    {
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function InstallFiles(): void
    {
        CopyDirFiles(__DIR__ . '/js', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/js/ilimurzin.typograf', true, true);
        CopyDirFiles(__DIR__ . '/images', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/images/ilimurzin.typograf', true, true);
    }

    public function UnInstallFiles(): void
    {
        DeleteDirFilesEx('bitrix/js/ilimurzin.typograf');
        DeleteDirFilesEx('bitrix/images/ilimurzin.typograf');
    }

    public function InstallEvents(): void
    {
        /** @see \Ilimurzin\Typograf\EventHandlers\HtmlEditorEventHandlers::onBeforeHTMLEditorScriptRuns() */
        EventManager::getInstance()->registerEventHandler(
            'fileman',
            'OnBeforeHTMLEditorScriptRuns',
            $this->MODULE_ID,
            'Ilimurzin\\Typograf\\EventHandlers\\HtmlEditorEventHandlers',
            'onBeforeHTMLEditorScriptRuns'
        );
    }

    public function UnInstallEvents(): void
    {
        EventManager::getInstance()->unRegisterEventHandler(
            'fileman',
            'OnBeforeHTMLEditorScriptRuns',
            $this->MODULE_ID,
            'Ilimurzin\\Typograf\\EventHandlers\\HtmlEditorEventHandlers',
            'onBeforeHTMLEditorScriptRuns'
        );
    }
}
