<?php
/**
 * Plugin class.
 */

class LinkitMMPagesPlugin extends LinkitSearchPlugin {
  /**
   * Overrides LinkitSearchPlugin::ui_title().
   */
  // function ui_title() {
    // return t('Monster Menus pages');
  // }
  
  /**
   * Overrides LinkitSearchPlugin::ui_description().
   */
  // function ui_description() {
    // return t('Extend Linkit with file support (Managed files).');
  // }
  /**
   * The autocomplete callback function for the Linkit Entity plugin.
   */
  public function fetchResults($search_string) {
    $matches = array();
    // Split up the search string on spaces, individually db_like() each chunk,
    // then glue back together with % to turn a string from "ab cd" to "ab%cd"
    // for use in our query building:
    $db_like = implode('%', array_map('db_like', (array) preg_split('/\s+/', $search_string, NULL, PREG_SPLIT_NO_EMPTY)));
    
    // Get page urls.
    $mm_content_get_query_params = array(
      // MM_GET_TREE_BIAS_ANON => FALSE,
      MM_GET_TREE_FILTER_BINS => FALSE,
      MM_GET_TREE_FILTER_DOTS => FALSE,
      MM_GET_TREE_FILTER_GROUPS => FALSE,
      MM_GET_TREE_FILTER_USERS => FALSE,
      MM_GET_TREE_FILTER_NORMAL => TRUE,
      MM_GET_TREE_MMTID => mm_home_mmtid(),
      MM_GET_TREE_DEPTH => -1,
      MM_GET_TREE_RETURN_PERMS => MM_PERMS_READ,
      MM_GET_TREE_SORT => FALSE,
      MM_GET_TREE_RETURN_TREE => TRUE,
      MM_GET_TREE_WHERE => 'name LIKE \'%' . $db_like . '%\'',
    );
    $query = mm_content_get_query($mm_content_get_query_params);
    // Apply the "read" permission:
    // As of writing, mm_content_get_query() always ends this requested query
    // with "ORDER BY NULL", but we're using the power of REGEX to allow some
    // flexibility.  Basically, the query can end with any ORDER statement within
    // 5 words of the end of the string, or no ORDER statement at all.
    $query = preg_replace('/(ORDER(\s+\w+){2,5}$|$)/', ' AND '.MM_PERMS_READ.' > 0 \\1', $query, 1, $count);
    $results = db_query($query);
      /**
   * Fetch search results based on the $search_string.
   *
   * @param $search_string
   *   A string that contains the text to search for.
   *
   * @return
   *   An associative array whose values are an
   *   associative array containing:
   *   - title: A string to use as the search result label.
   *   - description: (optional) A string with additional information about the
   *     result item.
   *   - path: The URL to the item.
   *   - group: (optional) A string with the group name for the result item.
   *     Best practice is to use the plugin name as group name.
   *   - addClass: (optional) A string with classes to add to the result row..
   */
    foreach ($results AS $page) {
      $url = mm_content_get_mmtid_url($page->mmtid);
      $display_url = preg_replace('|([^\/]{10}).+?\/|', '\\1.../', url($url));
      $matches[] = array(
        'title' => check_plain($page->name),
        'path' => $url,
        'description' => t('Path: @url', array('@url' => $display_url)),
        'group' => t('MM Pages'),
      );
    }
    return $matches;
  }
}