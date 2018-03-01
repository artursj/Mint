/*
 Sticky-kit v1.1.2 | WTFPL | Leaf Corcoran 2015 | http://leafo.net
*/
(function(){var b,f;b=this.jQuery||window.jQuery;f=b(window);b.fn.stick_in_parent=function(d){var A,w,J,n,B,K,p,q,k,E,t;null==d&&(d={});t=d.sticky_class;B=d.inner_scrolling;E=d.recalc_every;k=d.parent;q=d.offset_top;p=d.spacer;w=d.bottoming;null==q&&(q=0);null==k&&(k=void 0);null==B&&(B=!0);null==t&&(t="is_stuck");A=b(document);null==w&&(w=!0);J=function(a,d,n,C,F,u,r,G){var v,H,m,D,I,c,g,x,y,z,h,l;if(!a.data("sticky_kit")){a.data("sticky_kit",!0);I=A.height();g=a.parent();null!=k&&(g=g.closest(k));
if(!g.length)throw"failed to find stick parent";v=m=!1;(h=null!=p?p&&a.closest(p):b("<div />"))&&h.css("position",a.css("position"));x=function(){var c,f,e;if(!G&&(I=A.height(),c=parseInt(g.css("border-top-width"),10),f=parseInt(g.css("padding-top"),10),d=parseInt(g.css("padding-bottom"),10),n=g.offset().top+c+f,C=g.height(),m&&(v=m=!1,null==p&&(a.insertAfter(h),h.detach()),a.css({position:"",top:"",width:"",bottom:""}).removeClass(t),e=!0),F=a.offset().top-(parseInt(a.css("margin-top"),10)||0)-q,
u=a.outerHeight(!0),r=a.css("float"),h&&h.css({width:a.outerWidth(!0),height:u,display:a.css("display"),"vertical-align":a.css("vertical-align"),"float":r}),e))return l()};x();if(u!==C)return D=void 0,c=q,z=E,l=function(){var b,l,e,k;if(!G&&(e=!1,null!=z&&(--z,0>=z&&(z=E,x(),e=!0)),e||A.height()===I||x(),e=f.scrollTop(),null!=D&&(l=e-D),D=e,m?(w&&(k=e+u+c>C+n,v&&!k&&(v=!1,a.css({position:"fixed",bottom:"",top:c}).trigger("sticky_kit:unbottom"))),e<F&&(m=!1,c=q,null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),
h.detach()),b={position:"",width:"",top:""},a.css(b).removeClass(t).trigger("sticky_kit:unstick")),B&&(b=f.height(),u+q>b&&!v&&(c-=l,c=Math.max(b-u,c),c=Math.min(q,c),m&&a.css({top:c+"px"})))):e>F&&(m=!0,b={position:"fixed",top:c},b.width="border-box"===a.css("box-sizing")?a.outerWidth()+"px":a.width()+"px",a.css(b).addClass(t),null==p&&(a.after(h),"left"!==r&&"right"!==r||h.append(a)),a.trigger("sticky_kit:stick")),m&&w&&(null==k&&(k=e+u+c>C+n),!v&&k)))return v=!0,"static"===g.css("position")&&g.css({position:"relative"}),
a.css({position:"absolute",bottom:d,top:"auto"}).trigger("sticky_kit:bottom")},y=function(){x();return l()},H=function(){G=!0;f.off("touchmove",l);f.off("scroll",l);f.off("resize",y);b(document.body).off("sticky_kit:recalc",y);a.off("sticky_kit:detach",H);a.removeData("sticky_kit");a.css({position:"",bottom:"",top:"",width:""});g.position("position","");if(m)return null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.remove()),a.removeClass(t)},f.on("touchmove",l),f.on("scroll",l),f.on("resize",
y),b(document.body).on("sticky_kit:recalc",y),a.on("sticky_kit:detach",H),setTimeout(l,0)}};n=0;for(K=this.length;n<K;n++)d=this[n],J(b(d));return this}}).call(this);

jQuery(document).ready(function($) {
     console.log("ready");
     $("#psummary").stick_in_parent({ offset_top: 60});
    $('.read-more').click(function(){
        if($('.term-description-wrapper').hasClass('tdc-collapsed')){
            $('.term-description-wrapper').removeClass('tdc-collapsed');
            $('.term-description-wrapper').addClass('tdc-opened');
            $('.read-more span').empty();
            $('.read-more span').append("Read Less ");
        }else{
            $('.term-description-wrapper').addClass('tdc-collapsed');
            $('.term-description-wrapper').removeClass('tdc-opened');
            $('.read-more span').empty();
            $('.read-more span').append("Read More ");
        }
    });
    
    var mySwiper = new Swiper('.home-swiper-container', {
        speed: 400,
        spaceBetween: 100,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        pagination: '.swiper-pagination',
        paginationClickable: true
    });
    
    var galleryAn = new Swiper('.gallery-annotation', {
        spaceBetween: 10,
        slidesPerView: 1,
        touchRatio: 0.2,

    });
     
    
    mySwiper.params.control = galleryAn;
    galleryAn.params.control = mySwiper;
    
     var swiper = new Swiper('.swiper-top-single', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        slidesPerView: 'auto',
        paginationClickable: true,
        spaceBetween: 10,
    });
     
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        centeredSlides: true,
        slidesPerView: 'auto',
        touchRatio: 0.2,
        slideToClickedSlide: true
    });
    swiper.params.control = galleryThumbs;
    galleryThumbs.params.control = swiper;
   

   $('.cart-button').click(function(event){
        event.stopPropagation();
        if($('#cart-sidebar').hasClass('cart-closed')){
            $('#cart-sidebar').removeClass('cart-closed');
            $('#cart-sidebar').addClass('cart-open');
            $(".content-wrapper").toggleClass('content-wrapper-cart');
        }else{
            $('#cart-sidebar').removeClass('cart-open');
            $('#cart-sidebar').addClass('cart-closed');
            $(".content-wrapper").toggleClass('content-wrapper-cart');
        }
    });
   $('#nav-icon').click(function(){
		$(this).toggleClass('open');
        $(".content-wrapper").toggleClass('content-wrapper-menu');
        $(".mobile-menu").toggleClass('mobile-menu-closed');
	});
    $('#cart-sidebar').click(function(event){
            event.stopPropagation();
        });
    $(document).click(function(){
          $('#cart-sidebar').removeClass('cart-open');
          $('#cart-sidebar').addClass('cart-closed');
          $(".content-wrapper").removeClass('content-wrapper-cart');

        
    });
    
jQuery('.single_add_to_cart_button').click(function(e) {
	e.preventDefault();
	jQuery(this).addClass('adding-cart');
	var product_id = jQuery(this).val();
	var variation_id = jQuery('input[name="variation_id"]').val();
	var quantity = jQuery('input[name="quantity"]').val();
	
	jQuery('.cart-dropdown-inner').empty();
	if (variation_id != '') {
     
		jQuery.ajax ({
			url: cart_ajax.ajax_url,
			type:'POST',
			data:'action=crispshop_add_cart_single&product_id=' + product_id + '&variation_id=' + variation_id + '&quantity=' + quantity,

			success:function(results) {
               jQuery('.cart-customlocation').empty();
				jQuery('.cart-customlocation').append(results);
				var cartcount = jQuery('.item-count').html();
				jQuery('.cart_totals .icount').html(cartcount);
				jQuery('.single_add_to_cart_button').removeClass('adding-cart');
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('.cart-dropdown').addClass('show-dropdown');
                setTimeout(function () { 
                    jQuery('.cart-dropdown').removeClass('show-dropdown');
                }, 3000);
			}
		});
	} else {
		jQuery.ajax ({
			url: cart_ajax.ajax_url,  
			type:'POST',
			data:'action=crispshop_add_cart_single&product_id=' + product_id + '&quantity=' + quantity,

			success:function(results) {
				jQuery('.cart-dropdown-inner').append(results);
				var cartcount = jQuery('.item-count').html();
				jQuery('.cart-totals .icount').html(cartcount);
				jQuery('.single_add_to_cart_button').removeClass('adding-cart');
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('.cart-dropdown').addClass('show-dropdown');
                setTimeout(function () { 
                    jQuery('.cart-dropdown').removeClass('show-dropdown');
                }, 3000);
			}
		});
	}
});
   

});

