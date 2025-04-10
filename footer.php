</div>
<?php
$logo = get_field('header_logo', 'options');
$jarifooter = get_field('jarifooter', 'options');
$street = get_field('street', 'options');
$number = get_field('number', 'options');
$postal = get_field('postal', 'options');
$state = get_field('state', 'options');
$city = get_field('city', 'options');
$email = get_field('email', 'options');
$phonenumber = get_field('phonenumber', 'options');
$kvk = get_field('kvk', 'options');
$linkedin = get_field('linkedin', 'options');
$facebook = get_field('facebook', 'options');
$instagram = get_field('instagram', 'options');
$twitter = get_field('twitter', 'options');
$tiktok = get_field('tiktok', 'options');
$youtube = get_field('youtube', 'options');

?>
<footer>
    <section class="section-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                   <div class="col-logo">
                       <a href="<?php echo get_bloginfo('url'); ?>" rel="home">
                           <?php echo get_bloginfo('name'); ?>
                       </a>
                   </div>
                   <?php if($street && $number && $postal && $city && $email && $phonenumber): ?>
                       <div class="address">
                           <p><i class="fa-solid fa-location-dot"></i><?= $street ?> <?= $number ?></p>
                           <p><?= $postal ?> <?= $city ?>,</p>
                           <p><?= $state ?></p>
                       </div>
                       <div class="contact">
                           <p><i class="fa-solid fa-envelope"></i><a href="mailto:<?= $email ?>"><?= $email ?></a></p>
                           <p><i class="fa-solid fa-phone"></i><a href="tel:<?= $phonenumber ?>"><?= $phonenumber ?></a></p>
                           <p><i class="fa-solid fa-hashtag"></i>KVK:  <?= $kvk ?></p>
                       </div>
                    <?php endif ?>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <div class="flex flex-column align-items-center">
                  <div class="wrapper flex flex-column">
                      <p class="footer-menu-title">Snelle Links</p>
                      <div class="footer-menu">
                          <?php
                          wp_nav_menu( array(
                              'theme_location'  => 'footer', // Make sure 'primary' matches the identifier used in register_nav_menus
                              'container'       => 'nav',     // Wraps the menu in <nav> tags
                              'container_class' => 'primary-menu', // Class for the container
                              'menu_class'      => 'nav-items',     // Class for the <ul> element
                              'fallback_cb'     => false            // Do not fall back to wp_page_menu()
                          ) );
                          ?>
                      </div>
                  </div>
                </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                   <div class="flex flex-column align-items-end">
                       <p class="footer-menu-title">Vind ons op</p>
                       <div class="socials">
                           <?php if($linkedin): ?>
                               <a href="<?= $linkedin ?>" target="_blank"><i class="fa-brands fa-linkedin"></i>Linkedin</a>
                           <?php endif ?>
                           <?php if($facebook): ?>
                               <a href="<?= $facebook ?>" target="_blank"><i class="fa-brands fa-facebook"></i>FaceBook</a>
                           <?php endif ?>
                           <?php if($instagram): ?>
                               <a href="<?= $instagram ?>" target="_blank"><i class="fa-brands fa-instagram"></i>Instagram</a>
                           <?php endif ?>
                           <?php if($twitter): ?>
                               <a href="<?= $twitter ?>" target="_blank"><i class="fa-brands fa-twitter"></i>Twitter</a>
                           <?php endif ?>
                           <?php if($tiktok): ?>
                               <a href="<?= $tiktok ?>" target="_blank"><i class="fa-brands fa-tiktok"></i>TikTok</a>
                           <?php endif ?>
                           <?php if($youtube): ?>
                               <a href="<?= $youtube ?>" target="_blank"><i class="fa-brands fa-youtube"></i>YouTube</a>
                           <?php endif ?>
                       </div>
                   </div>

                </div>
            </div>

        </div>

    </section>
    <div class="section-bottom-footer">
       <div class="container">
           <div class="brand-footer footer flex align-items-center justify-content-center">
               <p>&copy;<?php echo get_bloginfo('name'); ?> - <?= date("Y"); ?></p><?php if($jarifooter): ?><div class="jarivankaamnl-footer footer flex align-items-center justify-content-center"><p> Ontwikkeld door: <a href="jarivankaam.nl">Jarivankaam.nl</a></p></div><?php endif; ?>
           </div>



       </div>
    </div>
</footer>

<?php edit_post_link('', '', '', get_the_ID(), 'edit-page-link'); ?>
<?php
wp_footer();
?>
</body>
