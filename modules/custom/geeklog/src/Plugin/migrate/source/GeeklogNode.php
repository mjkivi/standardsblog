<?php

namespace Drupal\geeklog\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for geeklog content.
 *
 * @MigrateSource(
 *   id = "geeklog_node"
 * )
 */
class GeeklogNode extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    /**
     * An important point to note is that your query *must* return a single row
     * for each item to be imported. Here we might be tempted to add a join to
     * migrate_example_beer_topic_node in our query, to pull in the
     * relationships to our categories. Doing this would cause the query to
     * return multiple rows for a given node, once per related value, thus
     * processing the same node multiple times, each time with only one of the
     * multiple values that should be imported. To avoid that, we simply query
     * the base node data here, and pull in the relationships in prepareRow()
     * below.
     */
    $query = $this->select('gl_stories', 'gls')
      ->fields('gls', array(
        'nid',
        //'sid',
        'uid',
        'tid',
        'date',
        'title',
        'introtext',
        'bodytext',
        'hits',
        'comments',
        'trackbacks',
        'related',
      ));
    return $query;
  }
  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'nid' => $this->t('Node ID'),
      //'sid' => $this->t('Story ID'),
      'uid' => $this->t('User ID'),
      'tid' => $this->t('Topic ID'),
      'date' => $this->t('Date Created'),
      'title' => $this->t('Title'),
      'introtext' => $this->t('Summary'),
      'bodytext' => $this->t('Body'),
      'hits' => $this->t('Number of Hits'),
      'comments' => $this->t('Number of Comments'),
      'trackbacks' => $this->t('Trackbacks'),
      'related' => $this->t('Related Stories'),
      // Note that this field is not part of the query above - it is populated
      // by prepareRow() below. You should document all source properties that
      // are available for mapping after prepareRow() is called.
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'nid' => [
        'type' => 'integer',
        'alias' => 'gls',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    /**
     * As explained above, we need to pull the style relationships into our
     * source row here, as an array of 'style' values (the unique ID for
     * the beer_term migration).
     */
    // $terms = $this->select('migrate_example_beer_topic_node', 'bt')
       //          ->fields('bt', ['style'])
      // ->condition('bid', $row->getSourceProperty('bid'))
      // ->execute()
      // ->fetchCol();
    // $row->setSourceProperty('terms', $terms);

    // As we did for favorite beers in the user migration, we need to explode
    // the multi-value country names.
    // if ($value = $row->getSourceProperty('countries')) {
      // $row->setSourceProperty('countries', explode('|', $value));
    // }
    return parent::prepareRow($row);
  }

}
