<?php
/**
* Plugin Name: ReAim Web Push
* Plugin URI: http://www.mywebsite.com/my-first-plugin
* Description: ReAim web push notifications for WordPress 
* Version: 1.0
* Author: Netboxify
* Author URI: https://netboxify.com
*/
?>

<style>
  <?php 
    include plugin_dir_path(__FILE__).'/style/settings/style.css';
  ?>
</style>


<?php
require_once plugin_dir_path(__FILE__).'settings.php';

define('REAIM_PUSH_API_KEY', get_option('reaim_push_api_key'));
define('REAIM_PLUGIN_URL', plugin_dir_url(__FILE__));

add_action('admin_menu', 'test_plugin_setup_menu');
add_action('wp_footer', 'reaim_script');
add_action('admin_notices', 'is_reaim_active');

// Checks if users inserted ReAim API key and shows/hide notification in the admin panel
function is_reaim_active () {
  if(!REAIM_PUSH_API_KEY || strlen(REAIM_PUSH_API_KEY) === 0) {
    echo '
      <div class="updated">
        <p>
          <strong>ReAim Push:</strong> In order to use ReAim Push you need to add API key. Update <a href="' . admin_url('admin.php?page=reaim-plugin') . '">' . __('settings', 'pushalert') . '</a> now!
        </p>
      </div>
    ';
  }
}

// Registers ReAim Settings page in WordPress side menu
function test_plugin_setup_menu(){
  add_menu_page( 'ReAim settings page', 'ReAim Settings', 'manage_options', 'reaim-plugin', 'reaim_dashboard', 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTQiIGhlaWdodD0iNTQiIHZpZXdCb3g9IjAgMCA1NCA1NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggb3BhY2l0eT0iMC4xIiBkPSJNMjcgNTNDNDEuMzU5NCA1MyA1MyA0MS4zNTk0IDUzIDI3QzUzIDEyLjY0MDYgNDEuMzU5NCAxIDI3IDFDMTIuNjQwNiAxIDEuMDAwMDEgMTIuNjQwNiAxLjAwMDAxIDI3QzEuMDAwMDEgNDEuMzU5NCAxMi42NDA2IDUzIDI3IDUzWiIgc3Ryb2tlPSIjMDIwRTE3IiBzdHJva2Utd2lkdGg9IjIiLz4KPHBhdGggb3BhY2l0eT0iMC4xNSIgZD0iTTI0IDQ2QzMyLjI4NDMgNDYgMzkgMzkuMjg0MyAzOSAzMUMzOSAyMi43MTU3IDMyLjI4NDMgMTYgMjQgMTZDMTUuNzE1NyAxNiA5LjAwMDAxIDIyLjcxNTcgOS4wMDAwMSAzMUM5LjAwMDAxIDM5LjI4NDMgMTUuNzE1NyA0NiAyNCA0NloiIHN0cm9rZT0iIzAyMEUxNyIgc3Ryb2tlLXdpZHRoPSIyIi8+CjxwYXRoIGQ9Ik0yNC41IDM4LjA0OEMyOC42Njg3IDM4LjA0OCAzMi4wNDggMzQuNjY4NiAzMi4wNDggMzAuNUMzMi4wNDggMjYuMzMxNCAyOC42Njg3IDIyLjk1MiAyNC41IDIyLjk1MkMyMC4zMzE0IDIyLjk1MiAxNi45NTIgMjYuMzMxNCAxNi45NTIgMzAuNUMxNi45NTIgMzQuNjY4NiAyMC4zMzE0IDM4LjA0OCAyNC41IDM4LjA0OFoiIGZpbGw9IiNERTMxMzkiIHN0cm9rZT0iI0Y0RjVGNyIgc3Ryb2tlLXdpZHRoPSI0LjA5NiIvPgo8cGF0aCBkPSJNMjcuNSAzMEMyOS40MzMgMzAgMzEgMjguNDMzIDMxIDI2LjVDMzEgMjQuNTY3IDI5LjQzMyAyMyAyNy41IDIzQzI1LjU2NyAyMyAyNCAyNC41NjcgMjQgMjYuNUMyNCAyOC40MzMgMjUuNTY3IDMwIDI3LjUgMzBaIiBzdHJva2U9IiMwMjBFMTciIHN0cm9rZS13aWR0aD0iMiIvPgo8L3N2Zz4K' );
}

// Inserts scripts into page if Reaim API key exists 
function reaim_script () {
  if(REAIM_PUSH_API_KEY) {
    ?>
      <script id="reaim-sw-script">
        window.REAIM_SW_PATH_GLOBAL = "<?php echo '/wp-content/plugins/reaim/sw/sw.js.php';?>"
      </script>
      <script src="http://localhost:4500/install.js"></script>
      <script>
        var push = new ReAimSDK(function() {
          // executed on Allow
        }, function() {
          // executed on Block
        });
        push.init(); 
      </script>
    <?php
  }
}
?>
