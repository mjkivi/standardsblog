<?php

namespace Drupal\clientsblock\Controller;

use Drupal\examples\Utility\DescriptionTemplateTrait;
/**
 * Controller routines for block example routes.
 */
class ClientsBlockController {
  use DescriptionTemplateTrait;

  /**
   * {@inheritdoc}
   */
  protected function getModuleName() {
    return 'clientsblock';
  }

}
