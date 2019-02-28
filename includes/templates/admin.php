<div class="wrap">
  <H1>Club Records Plugin Required</H1>
  <?php settings_errors(); ?>

  <form method="post" action="options.php">
    <?php
      settings_fields('club_records_opt_group' );
      do_settings_sections( 'club_records' );
      submit_button();
    ?>
  </form>
</div>