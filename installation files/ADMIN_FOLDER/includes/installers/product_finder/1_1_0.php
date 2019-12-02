<?php
/* Product Finder module
 * ADMIN/includes/installers/product_finder/1_1_0.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: 1_1_0.php 2019-05-25
 */
// use $configuration_group_id where needed
// For Admin Pages

$admin_page = 'configProductFinder';
// delete configuration menu
$db->Execute("DELETE FROM " . TABLE_ADMIN_PAGES . " WHERE page_key = '" . $admin_page . "' LIMIT 1;");
// add configuration menu
if (!zen_page_key_exists($admin_page)) {
    if ((int)$configuration_group_id > 0) {
        zen_register_admin_page($admin_page,
            'BOX_CONFIGURATION_PRODUCT_FINDER',
            'FILENAME_CONFIGURATION',
            'gID=' . $configuration_group_id,
            'configuration',
            'Y',
            $configuration_group_id);

        $messageStack->add('Added Product Finder configuration menu', 'success');
    }
}

/* If you're checking for a field
 * global $sniffer;
 * if (!$sniffer->field_exists(TABLE_SOMETHING, 'column'))  $db->Execute("ALTER TABLE " . TABLE_SOMETHING . " ADD column varchar(32) NOT NULL DEFAULT 'both';");
 */
/*
 * For adding a configuration value
 */
$db->Execute("INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_group_id, configuration_key, configuration_title, configuration_value, configuration_description, sort_order, set_function)
              VALUES (" . (int)$configuration_group_id . ", 'PRODUCT_FINDER_TEMPLATE_ENABLE', 'Show the Product Finder template block', 'true', 'The Product Finder page <strong>template</strong> block and  Product Finder <strong>sidebox</strong> cannot be used on the same page as they share the module code (same ids and javascript). If you enable the Product Finder sidebox, you must also disable this Product Finder template block.<br><br>Show the Product Finder template block.', 1, 'zen_cfg_select_option(array(\'true\', \'false\'),'),
                     (" . (int)$configuration_group_id . ", 'PRODUCT_FINDER_PARENT_ID', 'Parent Category ID', '', 'The ID of the parent category that contains the drop-down sub-categories.', 2, NULL),
                     (" . (int)$configuration_group_id . ", 'PRODUCT_FINDER_CATEGORY_DEPTH', 'Category Depth', '3', 'Number of drop-downs.<br>Note that the code must be manually modified to support more than three drop-downs.', 3, NULL);");
