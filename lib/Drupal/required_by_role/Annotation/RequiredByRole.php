<?php

/**
 * @file
 * Contains \Drupal\required_by_role\Annotation\RequiredByRole.
 */

namespace Drupal\required_by_role\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines an image effect annotation object.
 *
 * @see hook_image_effect_info_alter()
 *
 * @Annotation
 */
class RequiredByRole extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the image effect.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $label;

  /**
   * A brief description of the image effect.
   *
   * This will be shown when adding or configuring this image effect.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation (optional)
   */
  public $description = '';

}
