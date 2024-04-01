<?php
/*
Plugin Name: WhatsApp Button
Description: Bu bir whatsapp eklentisi
Version: 1.0
Author: Görkem Efe
*/

// WhatsApp Butonu Fonksiyonları
function whatsapp_button_output() {
    $whatsapp_number = get_option('whatsapp_number');
    if (!empty($whatsapp_number)) {
        ?>
        <div class="whatsapp-button">
            <a href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp_number); ?>" target="_blank" rel="noopener noreferrer">WhatsApp</a>
        </div>
        <?php
    }
}

// WhatsApp Butonu Stil Dosyası Ekleme
function whatsapp_button_styles() {
    wp_enqueue_style('whatsapp-button-style', plugins_url('style.css', __FILE__));
}

// WordPress Footer Alanına WhatsApp Butonu Ekleme
add_action('wp_footer', 'whatsapp_button_output');
// Stil Dosyasını Ekleme
add_action('wp_enqueue_scripts', 'whatsapp_button_styles');

// Ayarlar Sayfası Oluşturma ve Kayıt Etme
add_action('admin_init', 'whatsapp_button_register_settings');
function whatsapp_button_register_settings() {
    register_setting('whatsapp_button_settings_group', 'whatsapp_number');
}

add_action('admin_menu', 'whatsapp_button_settings_menu');
function whatsapp_button_settings_menu() {
    add_options_page('WhatsApp Button Settings', 'WhatsApp Button', 'manage_options', 'whatsapp-button-settings', 'whatsapp_button_settings_page');
}

function whatsapp_button_settings_page() {
?>
    <div class="wrap">
        <h1>WhatsApp Button Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('whatsapp_button_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">WhatsApp Number</th>
                    <td><input type="text" name="whatsapp_number" value="<?php echo esc_attr(get_option('whatsapp_number')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
