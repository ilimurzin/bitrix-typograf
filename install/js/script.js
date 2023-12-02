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
      const range = editor.selection.GetRange()

      let contentBefore
      let contentAfter
      let result

      if (range.startOffset === range.endOffset) {
        contentBefore = ''
        contentAfter = ''
        result = content
      } else {
        contentBefore = content.substring(0, range.startOffset)
        contentAfter = content.substring(range.endOffset)
        result = content.substring(range.startOffset, range.endOffset)

        typograf.disableRule('common/space/trimLeft')
        typograf.disableRule('common/space/trimRight')
      }

      result = typograf.execute(result)

      editor.SetContent(contentBefore + result + contentAfter, true)
      editor.ReInitIframe()

      BX.closeWait(wait)
    }
  })
})
