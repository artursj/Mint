<?php if ( is_front_page() && is_home() ) {
    $footer_text = "footer-dark";
    $logo = "/wp-content/uploads/2017/09/logo-inverted.png";
}else{
    $footer_text = "";
    $logo = "/wp-content/uploads/2017/09/logo-light-living.png";
}?>
<footer class="<?php echo $footer_text; ?> section">
<?php $menu_items = get_menu_items('Footer'); ?>   
    <div class="container">
        <div class="row">
            <div class="footer-logo col-sm-3">
                <img alt="mint furniture shop sweden" src="<?php echo $logo; ?>">
            </div>
            <?php if ( has_nav_menu( 'Footer' ) ) : ?>
            <div class="footer-menu col-sm-7">
                <ul>
                    <?php
                        if(isset($menu_items)){
                                foreach ( (array) $menu_items as $key => $menu_item ) { ?>
                                    <li class="footer-nav-link">
                                        <a class="nav-link" href="<?php echo $menu_item->url; ?>"><?php echo $menu_item->title; ?></a>
                                    </li> 
                                <?php }
                        }
                    ?>
                </ul>
            </div>
            <?php endif; ?>
            <div class="footer-social col-sm-2">
                <p class="strong">Follow us at</p>
                <ul>
                    <li class=footer-nav-link">
                       <a class="nav-link" href="https://www.facebook.com/mintfurnitureshop.se/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                   </li>
                    <li class="nav-item">
                       <a class="nav-link" href="https://www.instagram.com/mintfurnituresweden/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                   </li>
                    <li class="nav-item">
                       <a class="nav-link" href="https://www.pinterest.com/mintfurniturese/"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                   </li>
                    <li class="nav-item">
                       <a class="nav-link" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></i></a>
                   </li>
               </ul>
            </div>
        </div>
    </div>
    
</footer>

</div><!-- End content-wrapper -->
</div><!-- End main-wrapper --><?php wp_footer(); ?>
</body>
</html>