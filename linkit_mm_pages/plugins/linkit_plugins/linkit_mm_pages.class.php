<?php
/**
 * Plugin class.
 */


class LinkitMMPagesPlugin  extends LinkitPlugin {
  /**
   * The autocomplete callback function for the Linkit Entity plugin.
   */
  function autocomplete_callback() {
    $matches = array();
    // There is a huge typo in the Linkit API, so until a patch is committed the
    // search string is actually stored as "serach_string".  This check gives us
    // future compatibility:
    $search_string = (isset($this->serach_string)) ? $this->serach_string : $this->search_string;
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
      // MM_GET_TREE_SORT => TRUE,
      MM_GET_TREE_RETURN_TREE => TRUE,
      MM_GET_TREE_WHERE => 'name LIKE \'%' . $db_like . '%\'',
    );
    $query = mm_content_get_query($mm_content_get_query_params);
    // Apply the "read" permission:
    // As of writing, mm_content_get_query() always ends this requested query
    // with "ORDER BY NULL", but we're using the power of REGEX to allow some
    // flexibility.  Basically, the query can end with any ORDER statement within
    // 5 words of the end of the string, or no ORDER statement at all.
    $query = preg_replace('/(ORDER(\s+\w+){2,5}$|$)/', ' AND '.MM_PERMS_READ.' > 0 \\1', $query, 1);
    $results = db_query($query);
    
    foreach ($results AS $page) {
      $url = mm_content_get_mmtid_url($page->mmtid);
      $display_url = preg_replace('|([^\/]{5}).+?\/|', '\\1.../', url($url));
      $matches[] = array(
        'title' => $this->buildLabel($page->name) . ' (' . $display_url . ')',
        'path' => $this->buildPath($url),
        'group' => $this->buildGroup('Pages'),
      );
    }
    return $matches;
  }
}