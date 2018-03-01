<?php
/*
 * Template Name: Home page
 * Description: Home page
 */
get_header(); ?>
<div class="wrapper">
    <div class="bg">
        <div class="white-bg"></div>
        <div class="dark-bg"></div>
    </div>
    <div class="container section">
             <div class="gallery-annotation">
                <div class="swiper-wrapper">
                    <!-- Change gallery image anotation goes in the same order as images -->
                    <div class="swiper-slide">
                        <div class="annotation-container">
                           <h1>Porslin för dukning och prydnad</h1>
                           <p class="p">Handgjort bordsporslin från Laine Berina ceramics med läckra föremål för dukning till vardag & fest och som fina presenter. En sammanhållen exklusiv design där varje föremål är unikt.</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="annotation-container">
                           <h1>Möbler för barnkammaren</h1>
                           <p class="p">Omsorgsfullt formgivna barnmöbler där estetiken går hand i hand med funktion, säkerhet och städbarhet. Designen omfattar också miljöhänsyn vid tillverkning och återvinning.</p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="annotation-container">
                           <h1>Möbler för vardagsrummet.</h1>
                           <p class="p"> Inred praktiskt och trivsamt med en mediabänk mot vägg och en skön soffa mittemot, med plats för ett soffbord i en höjd som man trivs med däremellan. Bara att välja!</p>
                        </div>
                    </div>
                </div>
             </div>
             
        </div>
    <div class="container-fluid section-home-gallery">
        
        <div class="swiper-button-prev"><i class="fa fa-chevron-left" aria-hidden="true"></i><br><p>Previous</p></div>
        <div class="swiper-button-next"><i class="fa fa-chevron-right" aria-hidden="true"></i><br><p>Next</p></div>
        <div class="swiper-container container home-swiper-container">
            <div class="swiper-pagination"></div>
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide"><img alt="Dining room" src="/wp-content/uploads/2017/10/porsilin.jpg"></div>
                <div class="swiper-slide"><img alt="Dining room" src="/wp-content/uploads/2017/10/IMG_2948v2.jpg"></div>
                <div class="swiper-slide"><img alt="Dining room" src="/wp-content/uploads/2017/10/mintint_1024x1024.jpg"></div>
                ...
            </div>
            <!-- If we need pagination -->
            
        </div>
    </div>
    <div class="container section light-text">
        <?php do_action( 'getProducts', array(3, "dark")); ?>
        
    </div>
    <div class="container section">
        <div class="white-section"></div>
        <?php do_action( 'getProducts', array(4, "light")); ?>
    </div>
<?php get_footer(); ?>