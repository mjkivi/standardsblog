<?php

namespace Drupal\consorblocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Datetime\DrupalDateTime;

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
class Quotes extends BlockBase {

 /**
   * {@inheritdoc}
   */
  public function build() {

    // Get a connection going
    $db = \Drupal\Core\Database\Database::getConnection('default', 'external');

    $now = new DrupalDateTime('now');

    $query = $db->select('items', 'itm');
    $query->fields('itm', ['quote', 'qsource', 'link1', 'date2', 'ID']);
    //$query->isNotNull('itm.quote');
    $query->condition('itm.quote', '', '<>');
    $query->condition('itm.date2', $now->format(DATETIME_DATETIME_STORAGE_FORMAT), '<=');
    $query->orderBy('ID', 'DESC'); 
    $query->range(0, 1);

    $quotes = $query->execute()->fetchAll();
    
    $markup = "";
    for ($i = 0; $i < count($quotes); $i++) {
      $markup .= "<p><b>\"".$quotes[$i]->quote."\"</b></p><p class='quote-source'><em> - ".$quotes[$i]->qsource."</em><a class='all' href='http://www.consortiuminfo.org/news/quote.php'>See all Quotes</a></p>";
    }

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
