<header id="desktop">
  <div class="container">
    <div class="grid_institucinal">
      <div>
        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-horizontal.png"
          alt="logo cine B"
        />
      </div>
      <div>
        <?php get_template_part('components/Search/index'); ?>
      </div>
      <div>
        <nav>
          <?php 
            wp_nav_menu(array(
              'theme_location' => 'institucional',
              'menu_class' => 'menu-institucional',
              'container' => false
            )); ?>

            <ul class="user">
              <li>
                <?php if(is_user_logged_in()) {?>
                <a href="">
                  <span>login</span>
                  <i class="bi bi-person-circle"></i>
                </a>
                <?php } else {?>
                  <a href="/conta-da-assinatura/seu-perfil/">
                    <span>Minha conta</span>
                    <i class="bi bi-person-circle"></i>
                  </a>
                <?php }  ?>
              </li>
            </ul>
        </nav>
      </div>
    </div>
    <div class="grid_menu">
      <nav>
        <?php 
          wp_nav_menu(array(
            'menu' =>'principal', 
            'theme_location' => 'menu-principal', 
            'container' =>false
          )); ?>
      </nav>
    </div>
    </div>
  </div>
</header>
