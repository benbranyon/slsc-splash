<?php
/**
 * Special options to style things!
 *
 *
 */








// load css option fields
foreach (glob(get_parent_theme_file_path("kohette-framework/modules/settings-creator/options-css/options/*"), GLOB_ONLYDIR) as $filename) {
            include('options/' . basename($filename) . '/' . basename($filename) . '.php') ;
};
