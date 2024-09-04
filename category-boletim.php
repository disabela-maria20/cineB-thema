<?php
// Template Name:  Categoria Boletim
get_header();
?>

<?php
$current_page_slug = basename(get_permalink());
$category_slug = str_replace('boletim/', '', $current_page_slug);
$banner_id = "184";

$args = array(
  'post_type' => 'banner-post',
  'posts_per_page' => 1,
);

$query = new WP_Query($args);

if ($query->have_posts()) :
  while ($query->have_posts()) : $query->the_post();

    $banner_superior = CFS()->get('banner_moldura', $banner_id);
    $banner_inferior = CFS()->get('mega_banner', $banner_id);
    $full_banner = CFS()->get('full_banner', $banner_id);
    $skyscraper = CFS()->get('skyscraper', $banner_id);
    $super_banner = CFS()->get('super_banner', $banner_id);

?>
    <img src="<?php echo esc_url($banner_superior); ?>" class="img-banner bannerMobile" alt="banner">

    <div class="container bannerDesktop">
      <div class="grid-banner-superior">
        <img src="<?php echo esc_url($banner_superior); ?>" class="img-banner" alt="banner">
        <img src="<?php echo esc_url($banner_inferior); ?>" class="img-banner" alt="banner">
      </div>
    </div>

    <?php get_template_part('components/MenuMobile/index'); ?>
    <?php get_template_part('components/MenuDesktop/index'); ?>

<?php
  endwhile;
  wp_reset_postdata();
endif;
?>

<section class="bg-gray padding-banner">
  <div class="container bannerMobile">
    <div class="grid-banner-superior">
      <img src="<?php echo esc_url($banner_superior); ?>" class="img-banner bannerDesktop" alt="banner">
      <img src="<?php echo esc_url($banner_inferior); ?>" class="img-banner" alt="banner">
    </div>
  </div>
</section>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="container">
      <div class="grid-list-post gap-124">
        <div>
          <img src="<?php echo esc_url($full_banner); ?>" class="img-banner" alt="banner">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-boletim-filme-b-horizontal.png" class="logo" alt="cine B" />

          <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
          } ?>

          <?php
          $boletim_query = new WP_Query(array(
            'category_name'  => $category_slug, // Usa a slug da categoria da URL
            'posts_per_page' => 3,
          ));

          if ($boletim_query->have_posts()) : ?>
            <div class="posts">
              <?php while ($boletim_query->have_posts()) : $boletim_query->the_post(); ?>
                <div class="post">
                  <img src="<?php echo esc_url(CFS()->get('imagem')); ?>" alt="<?php echo esc_attr(CFS()->get('titulo') ?: get_the_title()); ?>" />
                  <span><?php echo get_the_category_list(', '); ?></span>
                  <a href="<?php the_permalink(); ?>" class="read-more">
                    <h2><?php the_title(); ?></h2>
                  </a>
                  <p><?php echo esc_html(CFS()->get('descricao') ?: get_the_excerpt()); ?></p>
                </div>
              <?php endwhile; ?>
            </div>
          <?php else : ?>
            <p>Nenhum boletim encontrado.</p>
          <?php
          endif;
          wp_reset_postdata();
          ?>

          <img src="<?php echo esc_url($super_banner); ?>" class="img-banner" alt="banner">

          <h3 class="titulo">Rapidinha</h3>

          <!-- Carousel Mobile -->
          <section class="home_lista_rapinhas bannerMobile">
            <div class="owl-carousel rapidinhas">
              <?php display_rapidinhas(); ?>
            </div>
          </section>

          <!-- Grid Desktop -->
          <section class="home_lista_rapinhas bannerDesktop">
            <div class="grid gap-32">
              <?php display_rapidinhas(); ?>
            </div>
          </section>
        </div>
        <?php get_template_part('components/Aside/index'); ?>
      </div>
    </div>
<?php endwhile;
endif; ?>
<?php get_template_part('components/Footer/index'); ?>
<?php get_footer(); ?>

<?php
// Função para exibir rapidinhas
function display_rapidinhas()
{
  $rapidinhas_id = get_cat_ID('Rapidinhas');
  $rapidinhas_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 9,
    'orderby' => 'date',
    'order' => 'DESC',
    'category__in' => array($rapidinhas_id),
  ));

  if ($rapidinhas_query->have_posts()) {
    $post_count = 0;

    while ($rapidinhas_query->have_posts()) {
      $rapidinhas_query->the_post();

      if ($post_count % 3 == 0) {
        if ($post_count > 0) {
          echo '</div></div>';
        }
        echo '<div class="item"><div class="grid grid-1-lg gap-32">';
      }
?>
      <div class="item-rapidinha">
        <img src="<?php echo esc_url(CFS()->get('imagem')); ?>" alt="<?php echo esc_attr(CFS()->get('titulo') ?: get_the_title()); ?>" />
        <div>
          <span class="data"><?php echo date_i18n('j \d\e F \d\e Y', strtotime(get_the_date())); ?></span>
          <h3><?php echo esc_html(CFS()->get('titulo') ?: get_the_title()); ?></h3>
          <a href="<?php the_permalink(); ?>">Leia mais</a>
        </div>
      </div>
    <?php
      $post_count++;
    }
    echo '</div></div>';
  } else {
    echo '<p>Nenhum post encontrado.</p>';
  }
  wp_reset_postdata();
}

function display_aside_rapidinhas()
{
  $rapidinhas_id = get_cat_ID('Rapidinhas');
  $aside_query = new WP_Query(array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
    'category__in' => array($rapidinhas_id),
  ));

  if ($aside_query->have_posts()) {
    while ($aside_query->have_posts()) {
      $aside_query->the_post();
    ?>
      <div class="item-aside">
        <img src="<?php echo esc_url(CFS()->get('imagem')); ?>" alt="<?php echo esc_attr(CFS()->get('titulo') ?: get_the_title()); ?>" />
        <a href="<?php the_permalink(); ?>">
          <h3><?php echo esc_html(CFS()->get('titulo') ?: get_the_title()); ?></h3>
        </a>
      </div>
<?php
    }
  } else {
    echo '<p>Nenhum post encontrado.</p>';
  }
  wp_reset_postdata();
}
?>