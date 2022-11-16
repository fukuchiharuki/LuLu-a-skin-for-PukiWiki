$(function () {

  /* alt mdl-js-layout: drawer-button */
  (function () {
    initializeDrawerButton();

    $('.mdl-layout__drawer-button').click(function () {
      if ($('.mdl-layout__obfuscator').length < 1) {
        $('<div />').addClass('mdl-layout__obfuscator').appendTo($('.mdl-layout'));
      }
      toggleVisibility();
    });

    $(document).on('click', '.mdl-layout__obfuscator', toggleVisibility);

    function initializeDrawerButton() {
      const icon = $('<i />').text('').addClass('material-icons');
      const button = $('<div />').attr({
        'aria-expanded': 'false',
        'role': 'button',
        'tabindex': '0',
        'class': 'mdl-layout__drawer-button'
      })
      icon.appendTo(button);
      button.appendTo($('.mdl-layout__header'));
    }

    function toggleVisibility() {
      $('.mdl-layout__obfuscator').toggleClass('is-visible');
      $('.mdl-layout__drawer').toggleClass('is-visible');
      const expanded = $('.mdl-layout__drawer').hasClass('is-visible');
      $('.mdl-layout__drawer').attr('aria-hidden', String(!expanded));
      $('.mdl-layout__drawer-button').attr('aria-expanded', String(expanded));
    }
  })();

  /* highlight.js */
  (function () {
    prepare();
    initialize();
    highlight();

    function initialize() {
      hljs.configure({
        useBR: false
      });
    }

    function prepare() {
      $('.full_hr + pre').addClass('nohighlight').css({ overflow: 'auto' });
    }

    function highlight() {
      $('.lulu-article > pre, .lulu-article li > pre, #preview > pre').each(function (i, block) {
        hljs.highlightBlock(block);
        $(block).css({ overflow: 'auto' });
      });
    }
  })();

  /* lulu-header__search */
  (function () {
    const searchForm = $('.lulu-header__search__form');
    const searchQuery = $('.lulu-header__search__form__query');

    searchQuery.blur(function () {
      const query = searchQuery.val();
      if (!query) return;
      searchForm.submit();
    });

    searchForm.submit(function () {
      const query = searchQuery.val();
      if (!query) return false;
      return true;
    });
  })();

});
