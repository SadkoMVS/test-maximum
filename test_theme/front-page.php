<?php get_header(); ?>
<main class="wrapper home_page"><span class="opacity-bg"></span>

    <section class="container ">

    <div class="slider_row">
		<div class="slider_cell">
			<h2 class="slider-heading">Explore by Room: Tailored Furniture Selections</h2>
		</div>
		<div class="slider_cell">
			<div class="testslider">
            <?php
                $args = array(
                    'post_type'      => 'slider',
                    'posts_per_page' => 10,
                    'order'          => 'DESC',
                    'orderby'        => 'date'
                );
                $query = new WP_Query($args);
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        // Отримання URL зображення з кастомного поля 'image_slide'
                        $image_id = get_post_meta(get_the_ID(), 'image_slide', true); 
                        $image_url = wp_get_attachment_image_url($image_id, 'full'); 
                        // Отримання тексту з кастомного поля 'heading_slide'
                        $heading_text = get_post_meta(get_the_ID(), 'heading_slide', true); 
                        $description_text = get_post_meta(get_the_ID(), 'description_slide', true);
                ?>
                        <div class="testslider_item-card">
                            <div class="testslider_item">
                                <!-- Виведення зображення -->
                                <img src="<?php echo esc_url($image_url); ?>" alt="" class="testslider_iten-img">
                                <!-- Виведення тексту з кастомного поля -->
                                <div class="testslider_item-head js-button-campaign"><?php echo esc_html($heading_text); ?></div>
                                 <!-- Зберігання опису у data-атрибуті для кожного посту -->
                                <div class="testslider_item-description" style="display: none;"><?php echo esc_html(get_post_meta(get_the_ID(), 'description_slide', true)); ?></div>
                            </div>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo 'No posts found';
                endif;
                ?>
				
			</div>
		</div>
	</div>
    <div class="overlay js-overlay-campaign">
		<div class="popup js-popup-campaign">
			<h2>Description</h2>
			<p class="js-description"></p>
			<div class="close-popup js-close-campaign"></div>
		</div>
	</div>
    </section>

</main>
<?php get_footer(); ?>
