 
jQuery( document ).ready(function() {
    

    var mySwiper = new Swiper ('.home-swiper-container', {
       // Optional parameters
       direction: 'horizontal',
       loop: true,
   
       // If we need pagination
       pagination: {
         el: '.swiper-pagination',
       },
   
       // Navigation arrows
       navigation: {
         nextEl: '.swiper-button-next',
         prevEl: '.swiper-button-prev',
       },
   
       // And if we need scrollbar
       scrollbar: {
         el: '.swiper-scrollbar',
       },
     });
    
    
    var swiper = new Swiper('.product-gallery-container', {
        slidesPerView: 'auto',
        paginationClickable: true,
        spaceBetween: 10,
      
    });
    
  
})
 