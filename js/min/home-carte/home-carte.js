!function(o){o(document).ready(function(){var s=o(window).width(),e=o(".acf.home-carte");s<960?setInterval(function(){o(e).toggleClass("js-toggle-slide")},8e3):(console.log("desktop"),o(".toggle-zones div").hover(function(){(o(this).hasClass("zone-0")&&o(e).hasClass("js-toggle-slide")||o(this).hasClass("zone-1")&&!o(e).hasClass("js-toggle-slide"))&&o(e).toggleClass("js-toggle-slide")},function(){}))})}(jQuery);