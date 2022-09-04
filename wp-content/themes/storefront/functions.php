<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 980; /* pixels */
}

$storefront = (object) array(
    'version'    => $storefront_version,

    /**
     * Initialize all the things.
     */
    'main'       => require 'inc/class-storefront.php',
    'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
    $storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
    $storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
    $storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

    require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

    require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
    require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
    require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
    $storefront->admin = require 'inc/admin/class-storefront-admin.php';

    require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
    require 'inc/nux/class-storefront-nux-admin.php';
    require 'inc/nux/class-storefront-nux-guided-tour.php';
    require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */



// Display Fields
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fieldss');

// Save Fields
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');


function woocommerce_product_custom_fieldss()
{
    global $woocommerce, $post;
    echo '<div class="product_custom_field">';
    // Custom Product Text Field
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_text_field',
            'placeholder' => 'Custom Product Text Field',
            'label' => __('Custom Product Text Field', 'woocommerce'),
            'desc_tip' => 'true'
        )
    );
    //Custom Product Number Field
    woocommerce_wp_text_input(
        array(
            'id' => '_custom_product_number_field',
            'placeholder' => 'Custom Product Number Field',
            'label' => __('Custom Product Number Field', 'woocommerce'),
            'type' => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )
    );
    //Custom Product  Textarea
    woocommerce_wp_textarea_input(
        array(
            'id' => '_custom_product_textarea',
            'placeholder' => 'Custom Product Textarea',
            'label' => __('Custom Product Textarea', 'woocommerce')
        )
    );
    echo '</div>';

}


























// Мой панел настроек
//add_filter('woocommerce_product_data_tabs', 'fields');
//function fields($tabs){
//    $tabs['General'] = array(
//        'label' => __('General', 'woocomerce'),
//        'target'=>'second_custom_fields',
//        'class' => array('second_custom_fields_panel', 'general_if')
//    );
//    return $tabs;
//}
//add_action('woocommerce_product_data_panels','general_custum_fields');
//
//function general_custum_fields(){
//    echo '<div id="second_custom_fields" class="panel woocommerce_options_panel"> </div>';
//    echo '<div class="options_group"></div>';
//
//    woocommerce_wp_text_input(
//        array(
//            'id'=>'options_group',
//            'label'=> __('Вторая цена', 'woocommerce'),
//            'wrapper_class' => 'second_custom_fields',
//            'placeholder' => 'Выберите вторую цену',
//            'desc_tip' => 'true',
//            'description' => __('Выберите вторую цену здесь.', 'woocommerce')
//        )
//    );
//}

// для добавления кнопки
//add_action( 'woocommerce_product_data_panels', 'add_button' );
//
//function add_button(){
//    global $product;
//    echo '<button type="submit" class="button alt">Change me please</button>';
//}







// Пример для разработки поля
add_filter( 'woocommerce_product_data_tabs', 'custom_product_tabs' );

function custom_product_tabs($tabs) {
    $tabs['custom_tabs'] = array(
        'label'		=> __( 'General', 'woocommerce' ),
        'target'	=> 'general_options',
        'class'		=> array( 'show_if_simple', 'show_if_variable'  ),
    );
    return $tabs;
}

function getCustumFields(){
    $select_options = array(
        '1'=>'rare',
        '2'=>'frequent',
        '3'=>'unusual'
    );
    $custum_fields = [];
    $custum_fields['price'] =
        array(
            'id' => 'second_price',
            'type'=> 'number',
            'label' => __('Вторая цена', 'woocommerce'),
            'wrapper_class' => 'show_if_simple',
            'custom_attributes'=> array(
                'min' =>'0',
            ),
            'placeholder' => 'Выберите вторую цену',
            'desc_tip' => 'true',
            'description' => __('Введите сюда вторую цену.', 'woocommerce')
        );
    $custum_fields['file_image'] = array(
        'id' => 'file_image',
        'type'=> 'file',
        'label' => __('Выберите фото продукта', 'woocommerce'),
        'wrapper_class' => 'show_if_simple',
        'placeholder' => 'Выберите вторую цену',
        'desc_tip' => 'true',
        'custom_attributes'=> 'accept="image/*"',
        'description' => __('Выберите фото продукта.', 'woocommerce')
    );
    $custum_fields['date'] =  array(
        'id' => 'date_field',
        'type'=> 'date',
        'label' => __('Время когда был создан продукт ', 'woocommerce'),
        'wrapper_class' => 'show_if_simple',
        'placeholder' => 'Выберите дату создания',
        'desc_tip' => 'true',
        'require'=>'true',
        'required'    => true,
        'description' => __('время создание продукта', 'woocommerce')
    );
    $custum_fields['select_field'] =  array(
        'id' => 'select_field',
        'label' => __('Выберите категорию ', 'woocommerce'),
        'wrapper_class' => 'show_if_simple',
        'options' => $select_options,
        'desc_tip' => 'true',
        'description' => __('Выберите категорию', 'woocommerce')
    );
    $custum_fields['clear'] = '<button type="button" name="clear_all" id="clear_all" style="background: #f046c5;margin: 0px 0px 30px 10px;padding: 8px; border-radius:3px;color:white;"> Удалить данные</button>';
    $custum_fields['remove'] = '<input type="button" name="remove_image" id="remove_image" value="удалить изображение" style="margin-left: 50px" >';
    $custum_fields['submit'] = '<input type="submit" id="publish" class="button button-primary button-large" name="publish" value="Обновить" style="margin-left: 50px;background: #0490ba; color:white;padding: 8px; border-radius: 3px;" >';
    return $custum_fields;
}
//
//function display_additional_product_fields(){
//    ?>
<!--    <span>Выбрать изображение</span>-->
<!--    <input type="file" name="image" value="Выбрать изображение" accept='image/*'>-->
<!--    --><?php
//}



add_action( 'woocommerce_product_data_panels', 'general_options_product_tab_content' );
/*
 * Функция для отображения кнопки основные в секции данные товара
 */
function general_options_product_tab_content()
{
    global $woocommerce, $post;
    echo '<div id="general_options" class="panel woocommerce_options_panel">';
    echo '<div class="options_group">';

    // Рисуем через кнопки выбирая через наш идентификатор, чтобы можно было в даьнейшем отключить ненужную.
    woocommerce_wp_text_input(getCustumFields()['price']);
    woocommerce_wp_text_input(getCustumFields()['file_image']);
    echo getCustumFields()['remove'];
    woocommerce_wp_text_input(getCustumFields()['date']);
    woocommerce_wp_select(getCustumFields()['select_field']);
    echo getCustumFields()['clear'];
    echo getCustumFields()['submit'];
    ?>
    <div class="form-row form-row-wide">
        <input type="file" id="misha_file" name="misha_file" />
        <input type="hidden" name="misha_file_field" />
        <label for="misha_file"><a>Select a cool image</a></label>
        <div id="misha_filelist"></div>
    </div>
    <?php
    echo '</div></div>';
}



add_action( 'woocommerce_process_product_meta', 'save_custom_field' );

function save_custom_field( $post_id ) {
    echo "<script>alert('$post_id')</script>";
    $second_price = isset( $_POST['second_price'] ) ? sanitize_text_field($_POST['second_price']) : '';
    $file_image = isset( $_POST['file_image'] ) ? sanitize_text_field($_POST['file_image']) : '';
    $date_field = isset( $_POST['date_field'] ) ? sanitize_text_field($_POST['date_field']) : '';
    $select_field = isset( $_POST['select_field'] ) ? sanitize_text_field($_POST['select_field']) : '';


    $product = wc_get_product( $post_id );
    $product->update_meta_data( $post_id,'second_price', esc_attr($second_price ));
    $product->update_meta_data( $post_id,'file_image', esc_attr($file_image ));
    $product->update_meta_data( $post_id,'date_field', esc_attr($date_field ));
    $product->update_meta_data( $post_id,'select_field', esc_attr($select_field));
    echo "<script>alert('$post_id')</script>";
    $product->save();

}
//function add_custom_assets(){
////    wp_enqueue_style('', get_stylesheet_directory_uri().'includes/js/my.js',array('jquery'), '1', true);
//    ?>
<!--    <script>-->
<!--        alert("I'm begin.");-->
<!--        jQuery( function( $ ) {-->
<!---->
<!--            $( '#misha_file' ).change( function() {-->
<!--                alert("Innnneerr.");-->
<!---->
<!--                if ( ! this.files.length ) {-->
<!--                    $( '#misha_filelist' ).empty();-->
<!--                } else {-->
<!---->
<!--                    // we need only the only one for now, right?-->
<!--                    const file = this.files[0];-->
<!---->
<!--                    $( '#misha_filelist' ).html( '<img src="' + URL.createObjectURL( file ) + '"><span>' + file.name + '</span>' );-->
<!---->
<!--                    const formData = new FormData();-->
<!--                    formData.append( 'misha_file', file );-->
<!---->
<!--                    $.ajax({-->
<!--                        url: wc_checkout_params.ajax_url + '?action=mishaupload',-->
<!--                        type: 'POST',-->
<!--                        data: formData,-->
<!--                        contentType: false,-->
<!--                        enctype: 'multipart/form-data',-->
<!--                        processData: false,-->
<!--                        success: function ( response ) {-->
<!--                            $( 'input[name="misha_file_field"]' ).val( response );-->
<!--                        }-->
<!--                    });-->
<!---->
<!--                }-->
<!---->
<!--            } );-->
<!---->
<!--        } );-->
<!--    </script>-->
<!--    --><?php
//}
//add_action('admin_enqueue_scripts', 'add_custom_assets');


add_filter( 'woocommerce_get_stock_html', 'my_restock_notice_display', 10, 2 );
function my_restock_notice_display( $html, $product ) {
    $notice = get_post_meta( $product->get_ID(), 'my_restock_notice', true );
    $stock_status = $product->get_stock_status();

    if ( empty( $notice ) || 0 < $product->get_stock_quantity() || 'outofstock' !== $stock_status ) {
        return $html;
    }

    $html .= '<p class="my-restock-notice">' . esc_html( $notice ) . '</p>';

    return $html;
}



