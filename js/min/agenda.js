!function(c){c(document).ready(function(){var a=c("#toggle-events"),l=c("#toggle-events-wrap"),e=c("#past-events"),t=(c(a).click(function(){l.hasClass("toggled")?(c(a).attr("aria-expanded","false"),c(e).attr("aria-expanded","false")):(c(a).attr("aria-expanded","true"),c(e).attr("aria-expanded","true")),c(e).slideToggle(),c(l).toggleClass("toggled")}),c("#date-filter")),i=c("ul.events"),n=c(".acf.agenda");flatpickr.localize(flatpickr.l10ns.fr),c("#date-filter").flatpickr({altInput:!0,altFormat:"d.m.Y",dateFormat:"Y-m-d",disableMobile:!0}),c(t).change(function(e){var t=c(this).val();setTimeout(function(){c(n).css("opacity",.2),c(i).find(".event").hide(),c(i).find(".event."+t).show(),c("#date-filter-clear").fadeIn(),l.hasClass("toggled")||c(a).click(),setTimeout(function(){c(n).css("opacity",1)},800)},500)}),c("#date-filter-clear").click(function(e){e.preventDefault(),setTimeout(function(){c(n).css("opacity",.2),c(i).find(".event").show(),c(t).val(""),c(".acf.agenda .form-control").val(""),l.hasClass("toggled")||c(a).click(),c("#date-filter-clear").fadeOut(),setTimeout(function(){c(n).css("opacity",1)},800)},500)})})}(jQuery);