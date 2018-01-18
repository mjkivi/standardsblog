<?php
/**
 * @file
 * Contains \Drupal\geeklog\Plugin\migrate\process\CldpDate.
 */
namespace Drupal\geeklog\Plugin\migrate\process;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;
use Drupal\migrate\MigrateSkipRowException;
use Zend\Stdlib\DateTime;
/**
 * Process the date from db (YYYY-MM-DD H:i:s) into a D8 compatible timestamp.
 *
 * @MigrateProcessPlugin(
 *   id = "geeklog_date"
 * )
 */
class GeeklogDate extends ProcessPluginBase {
  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    // Transform the date using DateTime::createFromFormat().
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $value);
    if ($date) {
      return $date->getTimestamp();
    }
    return time();
  }
}