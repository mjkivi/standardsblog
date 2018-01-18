<?php

namespace Drupal\geeklog\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for geeklog user accounts.
 *
 * @MigrateSource(
 *   id = "geeklog_user"
 * )
 */
class GeeklogUser extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    return $this->select('gl_users', 'glu')
      ->fields('glu', ['uid', 'status', 'regdate', 'username', 'fullname',
                            'passwd', 'email']);
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'uid' => $this->t('Account ID'),
      'status' => $this->t('Blocked/Allowed'),
      'regdate' => $this->t('Registered date'),
      'username' => $this->t('Account name (for login)'),
      'fullname' => $this->t('Account name (for display)'),
      'passwd' => $this->t('Account password (raw)'),
      'email' => $this->t('Account email'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'uid' => [
        'type' => 'integer',
        'alias' => 'glu',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    /**
     * prepareRow() is the most common place to perform custom run-time
     * processing that isn't handled by an existing process plugin. It is called
     * when the raw data has been pulled from the source, and provides the
     * opportunity to modify or add to that data, creating the canonical set of
     * source data that will be fed into the processing pipeline.
     *
     * In our particular case, the list of a user's favorite beers is a pipe-
     * separated list of beer IDs. The processing pipeline deals with arrays
     * representing multi-value fields naturally, so we want to explode that
     * string to an array of individual beer IDs.
     */
    // if ($value = $row->getSourceProperty('beers')) {
      // $row->setSourceProperty('beers', explode('|', $value));
    // }
    /**
     * Always call your parent! Essential processing is performed in the base
     * class. Be mindful that prepareRow() returns a boolean status - if FALSE
     * that indicates that the item being processed should be skipped. Unless
     * we're deciding to skip an item ourselves, let the parent class decide.
     */
    return parent::prepareRow($row);
  }

}
