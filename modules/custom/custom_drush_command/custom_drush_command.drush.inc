<?php
/**
 * @file Contains the code to generate the custom drush commands.
 */
/**
 * Implements hook_drush_command().
 */
function custom_drush_command_drush_command() {
  $items = array();
  // each item is custom drush command with a callback below - drush_{module_name}_{item_name}
  $items['say-hello'] = [
    'description' => 'Say hello.',
    'arguments' => [
      'name' => 'The name for saying hello',
    ],
    'drupal dependencies' => ['custom_drush_command'],
    'aliases' => ['say:hello'],
  ];
  $items['save-all'] = [
    'description' => 'Load and save all articles',
    'arguments' => [
      'name' => 'All Articles',
    ],
    'drupal dependencies' => ['custom_drush_command'],
    'aliases' => ['save:all'],
  ];

  return $items;
}
/**
 * Call back function drush_custom_drush_command_say_hello()
 * The call back function name in the  following format
 *   drush_{module_name}_{item_id_for_command}()
 */
function drush_custom_drush_command_say_hello($name = '') {
  drush_print('Hello ' . $name . '!!! What is going down chieftain?');
}

function drush_custom_drush_command_save_all($name = '') {
  //drush_print('Hello ' . $name . '!!! You really want me to load and save all Articles?');
  $node = \Drupal\node\Entity\Node::load($nid);
  $node->save();
}