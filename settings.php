<?php
// ReAim Settings page UI
function reaim_push_dashboard() {
  ?>
    <img class="reaim_logo" src="<?php echo esc_url(REAIM_PLUGIN_URL."images/reaim.png") ?>" alt="">
    <div class="reaim_settings">
      <h3 class="title">ReAim Settings</h3>
      <p class="second_title">Follow steps below to add web push to your Wordpress Website</p>
      <ol>
        <li>Create your account on <a href="//reaim.me" target="_blank">reaim.me</a></li>
        <li>Obtain your API Key from Profile Settings page</li>
        <li>Paste your API Key bellow and click 'Save'</li>
      </ol>
    </div>

    <form class="reaim_settings_form" action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
      <p>In order to verify your website you need to enter API which you can obtain on ReAim platform under Profile settings.</p>
      <div class="reaim_push_api_key">
        <label for="reaim_push_api_key">API Key</label>
        <input type="text" id="reaim_push_api_key" name="reaim_push_api_key" placeholder="XXXXXXXXXXXXXXXXXXXXXX" value="<?php echo get_option('reaim_push_api_key'); ?>" required>
      </div>
      <button type="submit">Save</button>
    </form>
  <?php
}

if (isset($_POST['reaim_push_api_key'])) {
  $reaim_push_api_key = sanitize_text_field( $_POST['reaim_push_api_key'] );

  if (!empty(REAIM_PUSH_API_KEY) && !empty(REAIM_PUSH_API_KEY)) {
    update_option('reaim_push_api_key', $reaim_push_api_key);
  } else {
    add_option('reaim_push_api_key', $reaim_push_api_key);
  }
  header('Location: '.$_SERVER['HTTP_REFERER']);
}

?>