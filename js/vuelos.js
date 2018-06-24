var instance = M.Tabs.init(el, options);
var instance = M.Tabs.getInstance(elem);
  // Or with jQuery

  $(document).ready(function(){
    $('.tabs').tabs();
    instance = M.Tabs.getInstance(elem);
    instance.select('tab_id');
  });