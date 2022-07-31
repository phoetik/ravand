<h1> <?php echo __("Appearance","ravand"); ?> </h1>
<br>
<div class="wrap">

    
    <form action="options.php" method="post">
        <?php $appearanceSettings->render(); ?>
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