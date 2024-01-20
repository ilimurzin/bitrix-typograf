BX.addCustomEvent('OnEditorInitedBefore', function (editor) {
  editor.AddButton({
    id: 'ilimurzin-typograf-button',
    name: BX.message('ILIMURZIN_TYPOGRAF_BUTTON_NAME'),
    compact: true,
    toolbarSort: 135,
    src: '/bitrix/images/ilimurzin.typograf/icon.svg',
    handler: () => {
      const typograf = new Typograf({ locale: ['ru', 'en-US'] })

      typograf.addSafeTag('<\\?', '\\?>')
      typograf.addSafeTag('\\[code\\]', '\\[/code\\]')
      typograf.addSafeTag('\\[CODE\\]', '\\[/CODE\\]')
      typograf.addSafeTag('\\[quote\\]', '\\[/quote\\]')
      typograf.addSafeTag('\\[QUOTE\\]', '\\[/QUOTE\\]')

      const wait = BX.showWait(editor.dom.areaCont)

      const content = editor.GetContent()

      editor.SetContent(typograf.execute(content), true)
      editor.ReInitIframe()

      BX.closeWait(wait)
    }
  })
})
