<?php require_once plugin_dir_path(__FILE__) . 'dashboard-logic.php'; ?>

<div class="wrap">
  <h1>Even Better WordPress</h1>
  <h2>Features</h2>
  <form method="post" action="options.php" novalidate="novalidate">
    <input type="hidden" name="option_page" value="general">
    <input type="hidden" name="action" value="update">
    <input type="hidden" id="_wpnonce" name="_wpnonce" value="3629ebf5d8">
    <input type="hidden" name="_wp_http_referer" value="/wordpress-stage/wp-admin/options-general.php">
    <table class="form-table" role="presentation">
      <tbody>
        <tr>
          <th scope="row">Custom Sticky Posts</th>
          <td>
            <fieldset>
              <legend class="screen-reader-text">Custom Sticky Posts</legend>
              <label for="users_can_register">
                <input name="users_can_register" type="checkbox" id="users_can_register" value="1">
                Activate sticky posts for all custom post types
              </label>
            </fieldset>
          </td>
        </tr>
      </tbody>
    </table>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
  </form>

  <h2>Custom Sticky Posts</h2>
  <p>This feature overwrites menu order to emulate sticky posts. If you use menu order, <strong>do not</strong> activate this feature because its effect cannot be undone.</p>
  <p>
    <button class="button" type="submit" name="unstick-all-posts">Print All Sticky Posts</button>
    <button class="button" type="submit" name="unstick-all-posts">Unstick All Posts</button>
  </p>
  <?php if(class_exists('ACF')): ?>

  <?php else: ?>
    <p><a href="<?php echo site_url(); ?>/wp-admin/plugin-install.php?s=acf&tab=search&type=term">Click here to install the plugin</a>.</p>
  <?php endif; ?>
</div>
