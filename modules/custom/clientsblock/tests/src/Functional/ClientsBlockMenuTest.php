<?php

namespace Drupal\Tests\consorblocks\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test the user-facing menus in Block Example.
 *
 * @ingroup consorblocks
 *
 * @group consorblocks
 * @group examples
 */
class ConsorBlocksMenuTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('block', 'consorblocks');

  /**
   * The installation profile to use with this test.
   *
   * This test class requires the "Tools" block.
   *
   * @var string
   */
  protected $profile = 'minimal';

  /**
   * Test for a link to the block example in the Tools menu.
   */
  public function testConsorBlocksLink() {
    $this->drupalGet('');
    $this->assertLinkByHref('examples/block-example');
  }

  /**
   * Tests block_example menus.
   */
  public function testBlockExampleMenu() {
    $this->drupalGet('examples/block-example');
    $this->assertResponse(200, 'Description page exists.');
  }

}
