jQuery(document).ready(function($){
  $('.baw_widgetarchives_widget_class ul > li ul')
    .click(function(e){
      e.stopPropagation();
    })
    .filter(':not(:first)')
    .hide();
    
  $('.baw_widgetarchives_widget_class ul > li, .baw_widgetarchives_widget_class ul > li > ul > li').click(function(){
    var selfClick = $(this).find('ul:first').is(':visible');
    if(!selfClick) {
      $(this)
        .parent()
        .find('> li ul:visible')
        .slideToggle();
    }
    
    $(this)
      .find('ul:first')
      .stop(true, true)
      .slideToggle();
  });
});
