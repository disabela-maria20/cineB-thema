<section class="home_lista_rapinhas bannerDesktop">
  <h2>Rapidinhas</h2>
  <div class="grid grid-2-lg gap-32">
    <?php 
      $rapidinhas_id = get_cat_ID('Rapidinhas');

      $recent_posts_query = new WP_Query(array(
              'post_type'      => 'post',
              'posts_per_page' => 10,
              'orderby'        => 'date',
              'order'          => 'DESC',
              'category__in' => array($rapidinhas_id),
      ));

      if ($recent_posts_query->have_posts()) {
        while ($recent_posts_query->have_posts()) { $recent_posts_query->the_post(); ?>
    <div class="item-rapidinha">
      <img src="<?php echo esc_url(CFS()->get('imagem')); ?>"
        alt="<?php echo esc_attr(CFS()->get('titulo') ?: get_the_title()); ?>" />
      <div>
        <span class="data"><?php echo date_i18n('j \d\e F \d\e Y', strtotime(get_the_date())); ?></span>
        <h3><?php echo esc_html(CFS()->get('titulo') ?: get_the_title()); ?></h3>
        <a href="<?php the_permalink();?>">Leia mais</a>
      </div>
    </div>
    <?php
          }
            wp_reset_postdata();
          } else {
              echo '<p>Nenhum post encontrado.</p>';
          }
        ?>

  </div>
</section>