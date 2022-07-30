<h1> <?php echo __("Appearance","ravand"); ?> </h1>
<br>
<div class="wrap">

    
    <form action="options.php" method="post">
    <?php
            // output security fields for the registered setting "wporg"
            // settings_fields( $appearanceSettings["page"] );
            // // output setting sections and their fields
            // // (sections are registered for "wporg", each field is registered to a specific section)
            // do_settings_sections( $appearanceSettings["page"] );
            // // output save settings button
            // submit_button(  );

            $appearanceSettings->render();
            ?>
            </form>
</div>

<script>
    (function ($) {

        // Add Color Picker to all inputs that have 'color-field' class
        $(function () {
            $('.color-picker').wpColorPicker();
        });

    })(jQuery);
</script>