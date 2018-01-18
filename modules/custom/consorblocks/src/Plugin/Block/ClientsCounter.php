<?php

namespace Drupal\consorblocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Database;


/**
 * Provides a 'Example: configurable text string' block.
 *
 * Drupal\Core\Block\BlockBase gives us a very useful set of basic functionality
 * for this configurable block. We can just fill in a few of the blanks with
 * defaultConfiguration(), blockForm(), blockSubmit(), and build().
 *
 * @Block(
 *   id = "quotes",
 *   admin_label = @Translation("Quote of the Day")
 * )
 */
class ClientsCounter extends BlockBase {

 /**
   * {@inheritdoc}
   */
  public function build() {

    // Get a connection going
    $db = \Drupal\Core\Database\Database::getConnection('default', 'clients');

    //SELECT COUNT(*) AS numrows FROM consortia_clients

    $query = $db->select('consortia_clients', 'clients');
    $query->fields('clients', ['name']);
    $num_rows = $query->countQuery()->execute()->fetchField();

    
    $markup = "";
    //$markup .= "<p>Clients:<b>\"".$num_rows"\"</b></p><p class='quote-source'></p>";
    $markup .= "test";

    return array (
      '#markup' => $markup,
    );

    //  for a twig template
    //return array(
      //'#theme' => 'item_list',
      //'#items' => $stories,
      //'#type' => 'inline_template',
    //);

  }

}
