<?php

add_action('after_setup_theme', 'mytheme_theme_setup');

if ( ! function_exists( 'mytheme_theme_setup' ) ){
    function mytheme_theme_setup(){
        add_action( 'wp_enqueue_scripts', 'mytheme_scripts');
    }
}

if ( ! function_exists( 'mytheme_scripts' ) ){
    function mytheme_scripts() {
        // CSS
        wp_enqueue_style( 'theme_css', get_template_directory_uri().'/css/main.css' );
        wp_enqueue_style( 'slick_css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
        wp_enqueue_style( 'slick0theme_css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css' );
        wp_enqueue_style( 'custom_css', get_template_directory_uri().'/css/custom.css' );

        // Scripts
        wp_enqueue_script( 'theme_js', get_template_directory_uri().'/js/libs/jquery-3.6.0.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'theme_js_2', get_template_directory_uri().'/js/libs/jquery.scrollbar.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'theme_js_3', get_template_directory_uri().'/js/libs/ion.rangeSlider.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'theme_js_4', get_template_directory_uri().'/js/libs/jquery.magnific-popup.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'theme_js_5', get_template_directory_uri().'/js/libs/swiper-bundle.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery'), '1.0.0', true );
        wp_enqueue_script( 'main_js', get_template_directory_uri().'/js/main.js', array( 'jquery'), '1.0.0', true );

        wp_localize_script( 'custom_js', 'ajax_object', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'directory_uri' => get_template_directory_uri(),
            'bloginfo_url' => get_bloginfo('url'),
        ));
    }
}

//Add custom post type Sliders
add_action( 'init', 'register_post_types' );

function register_post_types(){

	register_post_type( 'slider', [
		'label'  => null,
		'labels' => [
			'name'               => 'Slider', // основное название для типа записи
			'singular_name'      => 'Slide', // название для одной записи этого типа
			'add_new'            => 'Add slide', // для добавления новой записи
			'add_new_item'       => 'Adding slide', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Edit slide', // для редактирования типа записи
			'new_item'           => 'New slide', // текст новой записи
			'view_item'          => 'View slide', // для просмотра записи этого типа.
			'search_items'       => 'Search slide', // для поиска по этим типам записи
			'not_found'          => 'Not found', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Not found in trash', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Slider', // название меню
		],
		'description'            => 'Slider',
		'public'                 => true,
		'publicly_queryable'  => true, // зависит от public
		'exclude_from_search' => true, // зависит от public
		'show_ui'             => true, // зависит от public
		'show_in_nav_menus'   => true, // зависит от public
		'show_in_menu'           => true, // показывать ли в меню админки
		'show_in_admin_bar'   => true, // зависит от show_in_menu
		'show_in_rest'        => true, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => 4,
		'menu_icon'           => null,
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'author' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );

}

//Add custom fields for Sliders posts


class WP_Skills_MetaBox_Slider {
  private $screen = array(
    'slider',
  );

  private $meta_fields = array(
    array(
      'label' => 'Heading',
      'id' => 'heading_slide',
      'type' => 'text',
      'default' => '',
    ),
    array(
      'label' => 'Description',
      'id' => 'description_slide',
      'type' => 'textarea',
      'default' => '',
    ),
    array(
      'label' => 'Image',
      'id' => 'image_slide',
      'type' => 'media',
      'returnvalue' => 'ID',
    ),
  );

  public function __construct() {
    add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
    add_action('admin_footer', array($this, 'media_fields'));
    add_action('save_post', array($this, 'save_fields'));
  }

  public function add_meta_boxes() {
    foreach ($this->screen as $single_screen) {
      add_meta_box(
        'Slider',
        __('Slider', ''),
        array($this, 'meta_box_callback'),
        $single_screen,
        'normal',
        'default'
      );
    }
  }

  public function meta_box_callback($post) {
    wp_nonce_field('slider_data', 'slider_nonce');
    echo '';
    $this->field_generator($post);
  }

  public function media_fields() { ?>
    <script>
      jQuery(document).ready(function($) {
        if (typeof wp.media !== 'undefined') {
          var _custom_media = true,
            _orig_send_attachment = wp.media.editor.send.attachment;
          $('.new-media').click(function(e) {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            var id = button.attr('id').replace('_button', '');
            _custom_media = true;
            wp.media.editor.send.attachment = function(props, attachment) {
              if (_custom_media) {
                if ($('input#' + id).data('return') == 'url') {
                  $('input#' + id).val(attachment.url);
                } else {
                  $('input#' + id).val(attachment.id);
                }
                $('div#preview' + id).css('background-image', 'url(' + attachment.url + ')');
              } else {
                return _orig_send_attachment.apply(this, [props, attachment]);
              };
            }
            wp.media.editor.open(button);
            return false;
          });
          $('.add_media').on('click', function() {
            _custom_media = false;
          });
          $('.remove-media').on('click', function() {
            var parent = $(this).parents('td');
            parent.find('input[type="text"]').val('');
            parent.find('div').css('background-image', 'url()');
          });
        }
      });
    </script>
  <?php 
  }

  public function field_generator($post) {
    $output = '';
    foreach ($this->meta_fields as $meta_field) {
      $label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
      $meta_value = get_post_meta($post->ID, $meta_field['id'], true);
      if (empty($meta_value)) {
        if (isset($meta_field['default'])) {
          $meta_value = $meta_field['default'];
        }
      }
      switch ($meta_field['type']) {
        default:
          $input = sprintf(
            '<input %s id="%s" name="%s" type="%s" value="%s">',
            $meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
            $meta_field['id'],
            $meta_field['id'],
            $meta_field['type'],
            $meta_value
          );
          break;

        case 'media':
          $meta_type = '';
          if ($meta_value) {
            if ($meta_field['returnvalue'] == 'URL') {
              $meta_type = $meta_value;
            } else {
              $meta_type = wp_get_attachment_url($meta_value);
            }
          }
          $input = sprintf(
            '<input style="display:none;" id="%s" name="%s" type="text" value="%s"  data-return="%s"><div id="preview%s" style="margin-right:10px;border:1px solid #e2e4e7;background-color:#fafafa;display:inline-block;width: 100px;height:100px;background-image:url(%s);background-size:cover;background-repeat:no-repeat;background-position:center;"></div><input style="width: 19%%;margin-right:5px;" class="button new-media" id="%s_button" name="%s_button" type="button" value="Select" /><input style="width: 19%%;" class="button remove-media" id="%s_buttonremove" name="%s_buttonremove" type="button" value="Clear" />',
            $meta_field['id'],
            $meta_field['id'],
            $meta_value,
            $meta_field['returnvalue'],
            $meta_field['id'],
            $meta_type,
            $meta_field['id'],
            $meta_field['id'],
            $meta_field['id'],
            $meta_field['id']
          );
          break;

        case 'textarea':
          $input = sprintf(
            '<textarea style="" id="%s" name="%s" rows="5">%s</textarea>',
            $meta_field['id'],
            $meta_field['id'],
            $meta_value
          );
          break;
      }
      $output .= $this->format_rows($label, $input);
    }
    echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
  }

  public function format_rows($label, $input) {
    return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>';
  }

  public function save_fields($post_id) {
    if (!isset($_POST['slider_nonce']))
      return $post_id;
    $nonce = $_POST['slider_nonce'];
    if (!wp_verify_nonce($nonce, 'slider_data'))
      return $post_id;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
      return $post_id;
    foreach ($this->meta_fields as $meta_field) {
      if (isset($_POST[$meta_field['id']])) {
        switch ($meta_field['type']) {
          case 'email':
            $_POST[$meta_field['id']] = sanitize_email($_POST[$meta_field['id']]);
            break;
          case 'text':
            $_POST[$meta_field['id']] = sanitize_text_field($_POST[$meta_field['id']]);
            break;
        }
        update_post_meta($post_id, $meta_field['id'], $_POST[$meta_field['id']]);
      } else if ($meta_field['type'] === 'checkbox') {
        update_post_meta($post_id, $meta_field['id'], '0');
      }
    }
  }
}

if (class_exists('WP_Skills_MetaBox_Slider')) {
  new WP_Skills_MetaBox_Slider;
};

