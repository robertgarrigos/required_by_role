<?php
/**
 * @file
 * Contains \Drupal\required_by_role\Plugin\RequiredByRole\DefaultRequiredByRole.
 */

namespace Drupal\required_by_role\Plugin\RequiredByRole;

use Drupal\Core\Annotation\Translation;
use Drupal\Core\Image\ImageInterface;
use Drupal\image\Annotation\RequiredByRole;

/**
 * Checks required by role in textfields.
 *
 * @RequiredByRole(
 *   id = "default",
 *   label = @Translation("Default"),
 *   description = @Translation("Implements default required by role.")
 * )
 */
class DefaultRequiredByRole extends RequiredByRoleBase {

  /**
   * {@inheritdoc}
   */
  public function applyEffect(ImageInterface $image) {
    list($x, $y) = explode('-', $this->configuration['anchor']);
    $x = image_filter_keyword($x, $image->getWidth(), $this->configuration['width']);
    $y = image_filter_keyword($y, $image->getHeight(), $this->configuration['height']);
    if (!$image->crop($x, $y, $this->configuration['width'], $this->configuration['height'])) {
      watchdog('image', 'Image crop failed using the %toolkit toolkit on %path (%mimetype, %dimensions)', array('%toolkit' => $image->getToolkitId(), '%path' => $image->getSource(), '%mimetype' => $image->getMimeType(), '%dimensions' => $image->getWidth() . 'x' . $image->getHeight()), WATCHDOG_ERROR);
      return FALSE;
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function getSummary() {
    return array(
      '#theme' => 'image_crop_summary',
      '#data' => $this->configuration,
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + array(
      'anchor' => 'center-center',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getForm() {
    $form = parent::getForm();
    $form['anchor'] = array(
      '#type' => 'radios',
      '#title' => t('Anchor'),
      '#options' => array(
        'left-top' => t('Top') . ' ' . t('Left'),
        'center-top' => t('Top') . ' ' . t('Center'),
        'right-top' => t('Top') . ' ' . t('Right'),
        'left-center' => t('Center') . ' ' . t('Left'),
        'center-center' => t('Center'),
        'right-center' => t('Center') . ' ' . t('Right'),
        'left-bottom' => t('Bottom') . ' ' . t('Left'),
        'center-bottom' => t('Bottom') . ' ' . t('Center'),
        'right-bottom' => t('Bottom') . ' ' . t('Right'),
      ),
      '#theme' => 'image_anchor',
      '#default_value' => $this->configuration['anchor'],
      '#description' => t('The part of the image that will be retained during the crop.'),
    );
    return $form;
  }

}
