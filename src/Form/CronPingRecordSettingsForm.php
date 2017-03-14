<?php
/**
 * @file
 * Contains Drupal\cron_ping\Form\CronPingRecordSettingsForm.
 */

namespace Drupal\cron_ping\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class CronPingRecordSettingsForm.
 * @package Drupal\cron_ping\Form
 */
class CronPingRecordSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'cron_ping_record_edit_form';
  }

  /**
   * Form submission handler.
   *
   * @param FormStateInterface $form
   *   An associative array containing the structure of the form.
   * @param array $form_state
   *   An associative array containing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Define the form used for Cron settings.
   * @return array
   *   Form definition array.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['cron_ping_record_settings']['#markup'] = 'Settings form for Cron Ping Record. Manage field settings here.';
    return $form;
  }
}
