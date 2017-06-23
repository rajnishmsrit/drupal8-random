<?php
namespace \Drupal\random\Plugin\Field\FieldType;

/**
 * Provides a field type of baz.
 *
 * @FieldType(
 *   id = "random",
 *   label = @Translation("Random field"),
 *   default_formatter = "random_formatter",
 *   default_widget = "random_widget",
 * )
 */

class RandomItem extends FieldItemBase implements FieldItemInterface {

}

/**
 * {@inheritdoc}
 */
public static function schema(FieldStorageDefinitionInterface $field_definition) {
  return array(
    // columns contains the values that the field will store
    'columns' => array(
      // List the values that the field will save. This
      // field will only save a single value, 'value'
      'value' => array(
        'type' => 'text',
        'size' => 'tiny',
        'not null' => FALSE,
      ),
    ),
  );
}

/**
 * {@inheritdoc}
 */
public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
  $properties = [];
  $properties['value'] = DataDefinition::create('string');

  return $properties;
}

/**
 * {@inheritdoc}
 */
public function isEmpty() {
  $value = $this->get('value')->getValue();
  return $value === NULL || $value === '';
}

/**
 * {@inheritdoc}
 */
public static function defaultFieldSettings() {
  return [
    // Declare a single setting, 'size', with a default
    // value of 'large'
    'size' => 'large',
  ] + parent::defaultFieldSettings();
}

/**
 * {@inheritdoc}
 */
public function fieldSettingsForm(array $form, FormStateInterface $form_state) {

  $element = [];
  // The key of the element should be the setting name
  $element['size'] = [
    '#title' => $this->t('Size'),
    '#type' => 'select',
    '#options' => [
      'small' => $this->t('Small'),
      'medium' => $this->t('Medium'),
      'large' => $this->t('Large'),
    ],
    '#default_value' => $this->getSetting('size'),
  ];

  return $element;
}

 ?>
