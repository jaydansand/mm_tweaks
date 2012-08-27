<?php
/**
 * @file
 * Linkit MM pages plugin.
 */

$plugin = array(
  'ui_title' => t('Monster Menus pages'),
  'ui_description' => t('Enables Linkit to search for Monster Menus pages.'),
  'handler' => array(
      'class' => 'LinkitMMPagesPlugin',
      'file' => 'linkit_mm_pages.class.php',
      'path' => drupal_get_path('module', 'linkit_mm_pages') . '/plugins/linkit_plugins',
  ),
);
