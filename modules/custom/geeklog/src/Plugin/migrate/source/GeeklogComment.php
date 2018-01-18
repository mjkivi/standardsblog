<?php

namespace Drupal\geeklog\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 * Source plugin for geeklog comments.
 *
 * @MigrateSource(
 *   id = "geeklog_comment"
 * )
 */
class GeeklogComment extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    $query = $this->select('gl_comments', 'glc')
                 ->fields('glc', ['cid', 'pid', 'title', 'uid',
                   'comment', 'nid'])
                 ->orderBy('cid', 'ASC');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = [
      'cid' => $this->t('Comment ID'),
      'pid' => $this->t('Parent comment ID in case of comment replies'),
      'title' => $this->t('Comment Title/Subject'),
      'uid' => $this->t('Account ID (if any)'),
      'nid' => $this->t('Node ID being commented upon'),
      'subject' => $this->t('Comment subject'),
      'comment' => $this->t('Comment Body'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'cid' => [
        'type' => 'integer',
        'alias' => 'glc',
      ],
    ];
  }

}
