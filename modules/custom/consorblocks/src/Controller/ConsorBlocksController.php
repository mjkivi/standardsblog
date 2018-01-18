<?php

namespace Drupal\consorblocks\Controller;

use Drupal\examples\Utility\DescriptionTemplateTrait;
/**
 * Controller routines for block example routes.
 */
class ConsorBlocksController {
  use DescriptionTemplateTrait;

  /**
   * {@inheritdoc}
   */
  protected function getModuleName() {
    return 'consorblocks';
  }

}
