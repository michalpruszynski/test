<?php

namespace Drupal\Tests\block\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests block HTML ID validity.
 *
 * @group block
 */
class BlockHtmlTest extends BrowserTestBase {

  /**
   * Modules to install.
   *
   * @var array
   */
  protected static $modules = ['block', 'block_test'];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'classy';

  protected function setUp(): void {
    parent::setUp();

    $this->drupalLogin($this->rootUser);

    // Enable the test_html block, to test HTML ID and attributes.
    \Drupal::state()->set('block_test.attributes', ['data-custom-attribute' => 'foo']);
    \Drupal::state()->set('block_test.content', $this->randomMachineName());
    $this->drupalPlaceBlock('test_html', ['id' => 'test_html_block']);

    // Enable a menu block, to test more complicated HTML.
    $this->drupalPlaceBlock('system_menu_block:admin');
  }

  /**
   * Tests for valid HTML for a block.
   */
  public function testHtml() {
    $this->drupalGet('');

    // Ensure that a block's ID is converted to an HTML valid ID, and that
    // block-specific attributes are added to the same DOM element.
    $this->assertSession()->elementExists('xpath', '//div[@id="block-test-html-block" and @data-custom-attribute="foo"]');

    // Ensure expected markup for a menu block.
    $elements = $this->xpath('//nav[contains(@class, :nav-class)]/ul[contains(@class, :ul-class)]/li', [':nav-class' => 'block-menu', ':ul-class' => 'menu']);
    $this->assertNotEmpty($elements, 'The proper block markup was found.');
  }

}
