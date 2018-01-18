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

	$query = $db->select('items', 'itm');
	$query->fields('itm', ['blog', 'author', 'postdate', 'headline', 'its', 'source', 'date1', 'date2', 'link1', 'story']);
	$query->isNotNull('itm.headline');
	$query->where('date2<=curdate()');
	$query->orderBy('date2', 'DESC'); 
	$query->range(0, 10);
	
	$stories = $query->execute()->fetchAll();

	$oldchars = array(chr(149), chr(145), chr(146), chr(147), chr(148), chr(150), chr(151), chr(174), chr(153), chr(169));
	$newchars = array("&bull;", "'", "'", "\"", "\"", "&ndash;", "&mdash;", "&reg;", "&trade;", "&copy;");

	$markup = "";
	for ($i = 0; $i < count($stories); $i++) {
	  	$headline = $stories[$i]->headline;
	  	$headlineclean = str_replace($oldchars, $newchars, $headline);
	  	$story = $stories[$i]->story;
	  	$storyclean = str_replace($oldchars, $newchars, $story);
	  	$markup .= "<a href='".$stories[$i]->link1."' target='_blank' class='title'>".$headlineclean."</a><b class='author'>".$stories[$i]->author."</b><p><b>".$stories[$i]->source." &ndash;</b>".$stories[$i]->date1." - ".$storyclean." <a href='".$stories[$i]->link1."' class='full'> Full Story</a></p>";
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
