<?php
/**
 * @file
 * API documentation.
 */

/**
 * Alter the whitelist of allowed (unmodified) access callback functions.
 *
 * @param &$whitelist
 *   Array of whitelisted functions.
 *
 * @see mm_ensure_node_access_check_mm_menu_alter()
 */
function hook_mm_ensure_node_access_check_whitelist_alter(&$whitelist) {
  // Remove a function from the default list that no longer complies (does not
  // invoke node_access or a suitable Monster Menus node access check).
  unset($whitelist['mm_content_node_access']);
  // Add a custom module's function to the whitelist, since it implements
  // suitable MM node accesss checks.
  $whitelist[] = 'mymodule_node_access';
}

/**
 * Alter the MM permission required for a given path. Defaults to MM_PERMS_READ.
 *
 * @param &$permission
 *   Empty, or one of the MM permission constants:
 *    - MM_PERMS_READ
 *    - MM_PERMS_WRITE
 *    - MM_PERMS_SUB
 *    - MM_PERMS_APPLY
 *   If set to an empty value, MM permissions will not be checked for this path.
 *   @see mm_constants.inc
 *
 * @param $item
 *   Single-item associative array($path => $item) from the original hook_menu()
 *   definition.
 *   @see hook_menu()
 *
 * @see mm_ensure_node_access_check_mm_menu_alter()
 */
function hook_mm_ensure_node_access_check_perm_alter(&$permission, $item) {
  $path = key($item);
  switch ($path) {
    // Require elevated permissions for some path.
    case 'node/%/foo/bar':
      $permission = MM_PERMS_WRITE;
      break;
    // Remove the MM permission check for some other path.
    case 'node/%/baz/foo':
      $permission = '';
      break;
  }
}
