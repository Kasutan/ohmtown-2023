if(!function(i){i(document).ready(function(){var e=i(window).width(),r=i(".volet-navigation .ouvrir-sous-menu"),s=(0<r.length&&r.click(function(e){var s=i(this).siblings(".sub-menu");i(this).hasClass("js-ouvert")?(i(this).removeClass("js-ouvert"),i(s).slideUp()):(r.removeClass("js-ouvert"),i(".volet-navigation .sub-menu").slideUp(),i(this).addClass("js-ouvert"),i(s).slideDown())}),960<=e&&i(".disable.menu-item-has-children > a").click(function(e){e.preventDefault()}),i(".site-header")),a=i(".site-main"),e=(e<960?(i(s).addClass("js-fixed"),a.css("margin-top",s.outerHeight())):i("#volet-navigation").removeAttr("aria-expanded"),i(".forminator-col.pleine-largeur"));0<e.length&&i(e).each(function(e){i(this).parent(".forminator-row").addClass("pleine-largeur")})})}(jQuery),"IntersectionObserver"in window){const k={},l=(observer=new IntersectionObserver(e=>{e.forEach(e=>{0<e.intersectionRatio?(e.target.classList.add("fade-in"),observer.unobserve(e.target)):e.target.classList.remove("fade-in")},k)}),document.querySelectorAll(".js-fade-in-on-visible")),m=(l.forEach(e=>{observer.observe(e)}),observer2=new IntersectionObserver(e=>{e.forEach(e=>{0<e.intersectionRatio&&(jQuery(e.target).children().addClass("cascade"),observer.unobserve(e.target))},k)}),document.querySelectorAll(".js-cascade-on-visible"));m.forEach(e=>{observer2.observe(e)})}else jQuery(".js-animate-on-visible-cascade").addClass("cascade"),jQuery(".js-animate-on-visible").addClass("fade-in");