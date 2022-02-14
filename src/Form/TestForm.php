<?php
namespace Drupal\ishuman\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
/**
 * Test form
 */
class TestForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ishuman_test_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['#ishuman'] = TRUE;
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => 'Name',
      '#required' => TRUE,
      '#description' => '<p>If you press submit too fast it will fail. However
        if you submit it after a ~5s seconds it should work. Also test: Enter
        "invalid", then wait 5s and submit. It should give an error that "invalid" is
        not valid. Add a character or two and hit submit again immediately; you should
        not need to wait a second time. fails complete the field and submit again
        quickly - this second time you should not need to wait again.</p>'
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Test',
    ];
    return $form;
  }
  public function ajaxSubmitCallback(&$form, FormStateInterface $form_state) {
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('name') === 'invalid') {
      $form_state->setErrorByName('name', 'It is invalid to enter "invalid"!');
    }
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::service('messenger')->addMessage(t('Form submission accepted (spam test passed).'), 'info');
  }
}

