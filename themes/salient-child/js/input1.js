(function($) {
    function initialize_field($el) {}
    if (typeof acf.add_action !== 'undefined') {
        acf.add_action('ready append', function($el) {
            acf.get_fields({
                type: 'google_font_selector'
            }, $el).each(function() {
                initialize_field($(this));
                jQuery(document).on('change', '.acfgfs-font-family select', function() {
                    var new_font = $(this).val()
                    var container = $(this).parents('.acf-input:first');
                    var variants = container.find('.acfgfs-font-variants .acfgfs-list');
                    var subsets = container.find('.acfgfs-font-subsets .acfgfs-list');
                    var data = container.find('.acfgfs-font-data').val();
                    jQuery.ajax({
                        url: ajaxurl,
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function() {
                            container.find('.acfgfs-loader').show();
                        },
                        data: {
                            action: 'acfgfs_get_font_details',
                            font_family: new_font,
                            data: data
                        },
                        success: function(response) {
                            container.find('.acfgfs-loader').hide();
                            variants.html(response.variants);
                            subsets.html(response.subsets);
                            preview_text = jQuery('#acfgfs-preview div').html();
                            font = new_font.replace(' ', '+');
                            container.find('.acfgfs-preview').html('<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' + font + '"><div style="font-family:' + new_font + '"></div>')
                            jQuery('#acfgfs-preview div').html(preview_text)
                        }
                    });
                });
            });
        });
    } else {
        $(document).live('acf/setup_fields', function(e, postbox) {
            $(postbox).find('.field[data-field_type="google_font_selector"]').each(function() {
                initialize_field($(this));
                jQuery(document).on('change', '.acfgfs-font-family select', function() {
                    var new_font = $(this).val()
                    var container = $(this).parents('.acfgfs-font-selector:first');
                    var variants = container.find('.acfgfs-font-variants .acfgfs-list');
                    var subsets = container.find('.acfgfs-font-subsets .acfgfs-list');
                    var data = container.find('.acfgfs-font-data').val();
                    jQuery.ajax({
                        url: ajaxurl,
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function() {
                            container.find('.acfgfs-loader').show();
                        },
                        data: {
                            action: 'acfgfs_get_font_details',
                            font_family: new_font,
                            data: data
                        },
                        success: function(response) {
                            container.find('.acfgfs-loader').hide();
                            variants.html(response.variants);
                            subsets.html(response.subsets);
                            font = new_font.replace(' ', '+');
                            container.find('.acfgfs-preview').html('<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=' + font + '"><div style="font-family:' + font + '">This is new a preview of the selected font</div>')
                        }
                    });
                });
            });
        });
    }
})(jQuery);
