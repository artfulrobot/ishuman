<?php
namespace Drupal\ishuman\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Test form
 */
class ConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ishuman_config_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return['ishuman.config'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ishuman.config');

    $form['ishuman_salt'] = [
      '#title' => 'Salt',
      '#description' => t('Enter some random letters etc.'),
      '#type' => 'textfield',
      '#default_value' => $config->get('salt') ?: md5(time()),
    ];
    $form['ishuman_protect'] = [
      '#title' => 'Form Ids to protect (you can use * for wildcard)',
      '#type' => 'textarea',
      '#rows' => 8,
      '#columns' => 60,
      '#description' => t('Enter form ids one per line. e.g. <code>comment_node_*_form</code>'),
      '#default_value' => $config->get('protect'),
    ];
    return parent::buildForm($form, $form_state);
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('ishuman.config')
      ->set('salt', $form_state->getValue('salt'))
      ->set('protect', $form_state->getValue('protect'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}

