!function(r){r(document).ready(function(){var i,e=new List("archive-filtrable",{valueNames:["categorie"],page:9,pagination:!0}),a=r(".list, .pagination"),t=(r(".filtre-archive").change(function(){r(a).animate({opacity:0},400,"linear",function(){var t=r("input[name='filtre-categorie']:checked").val();"toutes"==t?(e.filter(),localStorage.removeItem("filtreBlog"),o("")):(e.filter(function(e){return 0<=e.values().categorie.indexOf(t)}),localStorage.setItem("filtreBlog",t),o(t)),r(a).animate({opacity:1},1e3,"linear")})}),window.location.search);console.log(t);const n=new URLSearchParams(t);function c(){r(".pagination li").click(function(e){r("html, body").animate({scrollTop:r("#filtre-liste").offset().top-150},500)})}function o(e){var t=new URL(window.location.href),e=(e?n.set("filtre_cat",encodeURI(e)):n.delete("filtre_cat"),t.search=n.toString(),t.toString());history.pushState({pageID:"Lagache"},"Lagache",e)}n.has("filtre_cat")?r(".filtre-archive input").each(function(e,t){r(t).val()===n.get("filtre_cat")&&(r(t).prop("checked",!0),r(".filtre-archive").trigger("change"))}):(i=localStorage.getItem("filtreBlog"))&&r(".filtre-archive input").each(function(e,t){r(t).val()===i&&(r(t).prop("checked",!0),r(".filtre-archive").trigger("change"))}),c(),e.on("updated",function(e){setTimeout(c,1e3)})})}(jQuery);