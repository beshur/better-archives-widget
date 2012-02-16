jQuery(document).ready(function($){
  $('.baw_widgetarchives_widget_class ul.baw-months').hide();
  //$('.baw_widgetarchives_widget_class li.baw-year').first().find('ul.baw-months').show();
  $('.baw_widgetarchives_widget_class').on('hover','li.baw-year > a', function(){
      console.log($(this).closest('li').find('ul.baw-months'));
      
      $(this).closest('li').find('ul.baw-months')
        .slideDown(300)
            .closest('li').siblings()
                .find('ul.baw-months').slideUp(300);
  });
});


