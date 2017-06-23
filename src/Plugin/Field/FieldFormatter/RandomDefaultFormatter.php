<?php

namespace Drupal\random\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'Random_default' formatter.
 *
 * @FieldFormatter(
 *   id = "Random_default",
 *   label = @Translation("Random text"),
 *   field_types = {
 *     "Random"
 *   }
 * )
 */
class RandomDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();
    $settings = $this->getSettings();

    $summary[] = t('Displays the random string.');

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = array();

    foreach ($items as $delta => $item) {
      // Render each element as markup.
      $element[$delta] = array(
        '#type' => 'markup',
        '#markup' => $item->value,
      );
    }

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Declare a setting named 'text_length', with
      // a default value of 'short'
      'text_length' => 'short',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['text_length'] = [
      '#title' => t('Text length'),
      '#type' => 'select',
      '#options' => [
        'short' => $this->t('Short'),
        'long' => $this->t('Long'),
      ],
      '#default_value' => $this->getSetting('text_length'),
    ];

    return $element;
  }

  /**
   * For Ajax
   */

  /*

  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['display_type'] = [
      '#title' => t('Display Type'),
      '#type' => 'select',
      '#options' => [
        'label' => $this->t('Label'),
        'entity' => $this->t('Entity'),
      ],
      '#default_value' => $this->getSetting('display_type'),
      '#ajax' => [
        'wrapper' => 'private_message_thread_member_formatter_settings_wrapper',
        'callback' => [$this, 'ajaxCallback'],
      ],
    ];

    $element['entity_display_mode'] = [
      '#prefix' => '<div id="private_message_thread_member_formatter_settings_wrapper">',
      '#suffix' => '</div>',
    ];

    // First, retrieve the field name for the current field]
    $field_name = $this->fieldDefinition->getItemDefinition()->getFieldDefinition()->getName();
    // Next, set the key for the setting for which a value is to be retrieved
    $setting_key = 'display_type';

    // Try to retrieve a value from the form state. This will not exist on initial page load
    if($value = $form_state->getValue(['fields', $field_name, 'settings_edit_form', 'settings', $setting_key])) {
      $display_type = $value;
    }
    // On initial page load, retrieve the default setting
    else {
      $display_type = $this->getSetting('display_type');
    }

    if($display_type == 'entity') {
      $element['entity_display_mode']['#type'] = 'select';
      $element['entity_display_mode']['#title'] = $this->t('View mode');
      $element['entity_display_mode']['#options'] = [
        'full' => $this->t('Full'),
        'teaser' => $this->t('Teaser'),
      ];
      $element['entity_display_mode']['#default_value'] = $this->getSetting('entity_display_mode');
    }
    else {
      // Force the element to render (so that the AJAX wrapper is rendered) even
      // When no value is selected
      $element['entity_display_mode']['#markup'] = '';
    }

    return $element;
  }

  public function ajaxCallback(array $form, FormStateInterface $form_state) {
    $field_name = $this->fieldDefinition->getItemDefinition()->getFieldDefinition()->getName();
    $element_to_return = 'entity_display_mode';

    return $form['fields'][$field_name]['plugin']['settings_edit_form']['settings'][$element_to_return];
  }

  */


}
