(function() {
  jQuery('.baw_widgetarchives_widget_class ul.baw-months').hide();
  jQuery('.baw_widgetarchives_widget_class').on('hover','li.baw-year > a', function(){      
      jQuery(this).closest('li').find('ul.baw-months')
        .slideDown(300)
            .closest('li').siblings()
                .find('ul.baw-months').slideUp(300);
  });
})();