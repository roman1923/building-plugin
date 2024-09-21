<?php

// Register shortcode
function real_estate_filter_shortcode() {
    ob_start();
    ?>
    <div id="real-estate-filter">
        <form id="real-estate-filter-form">
            <label for="building_name">Назва будинку:</label>
            <input type="text" id="building_name" name="building_name">

            <label for="number_of_floors">Кількість поверхів:</label>
            <select id="number_of_floors" name="number_of_floors">
                <?php for ($i = 1; $i <= 20; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>

            <label for="building_type">Тип будівлі:</label>
            <select id="building_type" name="building_type">
                <option value="brick">Цегла</option>
                <option value="panel">Панель</option>
                <option value="foam_block">Піноблок</option>
            </select>

            <label for="environmental_rating">Екологічність:</label>
            <select id="environmental_rating" name="environmental_rating">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>

            <button type="submit">Фільтрувати</button>
        </form>

        <div id="real-estate-results"></div> <!-- AJAX results will display here -->
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('#real-estate-filter-form').submit(function(e) {
            e.preventDefault();

            var filterData = $(this).serialize();

            $.ajax({
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                type: "POST",
                data: {
                    action: "filter_real_estate",
                    filter: filterData
                },
                success: function(response) {
                    $('#real-estate-results').html(response);
                }
            });
        });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('real_estate_filter', 'real_estate_filter_shortcode');

