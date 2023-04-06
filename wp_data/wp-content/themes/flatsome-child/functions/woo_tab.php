<?php
  add_filter("woocommerce_product_tabs", "woo_new_product_tab");
  function woo_new_product_tab($tabs)
  {
      // Adds the new tab
      $tabs["test_tab"] = [
          "title" => __("Hướng Dẫn Mua Hàng", "woocommerce"),
          "priority" => 50,
          "callback" => "woo_new_product_tab_content",
      ];
      return $tabs;
  }
  function woo_new_product_tab_content()
  {
      echo "<p>" . get_option("tab_options_content") . "</p>";
  }

  add_action("admin_menu", "my_plugin_menu");

  function my_plugin_menu()
  {
      add_options_page(
          "Tab Options Page", // page title
          "Tab Options Ecommerce", // menu title
          "manage_options", // capability
          "tab-options", // menu slug
          "my_plugin_options_page" // function to display the page
      );
  }
  function my_plugin_options_page()
  {
      // Check if the user has permission to manage options
      if (!current_user_can("manage_options")) {
          wp_die(
              __("You do not have sufficient permissions to access this page.")
          );
      }

      // If the form has been submitted, update the content
      if (isset($_POST["tab_options_content"])) {
          update_option(
              "tab_options_content",
              wp_kses_post($_POST["tab_options_content"])
          );
          $message = __("Content updated successfully.");
      }

      // Get the current content from the options table
      $content = get_option("tab_options_content");
      // Display the option page HTML
      ?>
    <div class="wrap">
      <h1><?php _e("My Options Page"); ?></h1>
      <?php if (isset($message)): ?>
        <div class="notice notice-success is-dismissible">
          <p><?php echo $message; ?></p>
        </div>
      <?php endif; ?>
      <form method="post">
        <label for="tab_options_content"><?php _e("Content:"); ?></label><br>
        <?php wp_editor($content, "tab_options_content", [
        "media_buttons" => false,
        "textarea_name" => "tab_options_content",
        "textarea_rows" => 10,
        "tabindex" => 1,
        "editor_css" => "",
        "editor_class" => "",
        "teeny" => false,
        "dfw" => false,
        "tinymce" => [
            "content_css" => "",
            "height" => 500,
        ],
    ]); ?>
        <p class="submit">
          <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e(
          "Save Changes"
      ); ?>">
        </p>
      </form>
    </div>
    <?php
  }

  // add_filter('wpcf7_autop_or_not', '__return_false');
  add_filter('wpcf7_autop_or_not', '__return_false');