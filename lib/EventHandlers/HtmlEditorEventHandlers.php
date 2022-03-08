<?php

declare(strict_types=1);

namespace Ilimurzin\Typograf\EventHandlers;

final class HtmlEditorEventHandlers
{
    public static function onBeforeHTMLEditorScriptRuns(): void
    {
        self::initTypograf();
    }

    private static function initTypograf(): void
    {
        $moduleFolder = getLocalPath('modules/ilimurzin.typograf');

        \CJSCore::RegisterExt('ilimurzin_typograf', [
            'js' => [
                '/bitrix/js/ilimurzin.typograf/script.js',
                'https://cdn.jsdelivr.net/npm/typograf@6.14.1/dist/typograf.min.js',
            ],
            'lang' => $moduleFolder . '/lang/' . LANGUAGE_ID . '/js.php'
        ]);

        \CJSCore::Init(['ilimurzin_typograf']);
    }
}
