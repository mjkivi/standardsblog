<?php

namespace Drupal\consorblocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Database;

/**
 * Provides a 'Latest News' block.
 *
 * @Block(
 *   id = "latest_news",
 *   admin_label = @Translation("Latest News")
 * )
 */
class LatestNews extends BlockBase {

 /**
   * {@inheritdoc}
   */
  public function build() {

	// Get a connection to the external database
	$db = \Drupal\Core\Database\Database::getConnection('default', 'external');

	$now = date("Y-m-d H:i:s");

	$query = $db->select('items', 'itm');
	$query->fields('itm', ['blog', 'author', 'postdate', 'headline', 'its', 'source', 'date1', 'date2', 'link1', 'story']);
	$query->isNotNull('itm.headline');
	$query->where('date2<=curdate()');
	$query->orderBy('date2', 'DESC'); 
	$query->range(0, 10);

	$stories = $query->execute()->fetchAll();
	
	$markup = "";
	for ($i = 0; $i < count($stories); $i++) {
	  $markup .= "<p><em>".$stories[$i]->its."</em></p><a href='".$stories[$i]->link1."' target='_blank' class='title'>".$stories[$i]->headline."</a><b class='author'>".$stories[$i]->author."</b><p><b>".$stories[$i]->source." &ndash;</b>".$stories[$i]->date1." - ".$stories[$i]->story." <a href='".$stories[$i]->link1."' class='full'> Full Story</a></p>";
	}

	return array (
	  '#markup' => $markup,
	);

  }

}
