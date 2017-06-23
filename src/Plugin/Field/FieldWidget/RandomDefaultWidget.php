<?php

namespace \Drupal\random\Plugin\Field\FieldWidget;

/**
 * A widget bar.
 *
 * @FieldWidget(
 *   id = "random",
 *   label = @Translation("Bar widget"),
 *   field_types = {
 *     "baz",
 *     "string"
 *   }
 * )
 */

class RandomWidget extends WidgetBase implements WidgetInterface {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = [];
    // Build the element render array.
    return $element;
  }

  /*
  For Using settings from
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = $element + array(
      '#type' => 'textfield',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
      '#size' => $this->getSetting('size'),
    );

    return $element;
  }

   */

  /**
   * {@inheritdoc}
   */
   public static function defaultSettings() {
    return array(
      // Create a default setting 'size', and
      // assign a default value of 60
      'size' => 60,
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['size'] = array(
      '#type' => 'number',
      '#title' => t('Size of textfield'),
      '#default_value' => $this->getSetting('size'),
      '#required' => TRUE,
      '#min' => 1,
    );

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $summary[] = t('Textfield size: @size', array('@size' => $this->getSetting('size')));

    return $summary;
  }

}


 ?>
