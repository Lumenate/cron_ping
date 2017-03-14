<?php
/**
 * @file
 * Contains \Drupal\cron_ping\Entity\CronPingRecord.
 */

namespace Drupal\cron_ping\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\cron_ping\CronPingRecordInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 * Defines the CronPingRecord entity.
 *
 * @ContentEntityType(
 *   id = "cron_ping_record",
 *   label = @Translation("Cron Ping Record"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "list_builder" = "Drupal\cron_ping\Entity\Controller\CronPingRecordListBuilder",
 *     "form" = {
 *       "add" = "Drupal\cron_ping\Form\CronPingRecordAddForm",
 *       "edit" = "Drupal\cron_ping\Form\CronPingRecordAddForm",
 *       "delete" = "Drupal\cron_ping\Form\CronPingRecordDeleteForm",
 *     },
 *   },
 *   base_table = "cron_ping_record",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/cron_ping_record/{cron_ping_record}",
 *     "add-form" = "/cron_ping_record/{cron_ping_record}/add",
 *     "edit-form" = "/admin/cron_ping_record/{cron_ping_record}/edit",
 *     "delete-form" = "/cron_ping_record/{cron_ping_record}/delete",
 *     "collection" = "/cron_ping_record/list"
 *   },
 * )
 */
class CronPingRecord extends ContentEntityBase implements CronPingRecordInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   *
   * When a new entity instance is added, set the user_id entity reference to
   * the current user as the creator of the instance.
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getChangedTime() {
    return $this->get('changed')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   *
   * Define the field properties here.
   *
   * Field name, type and size determine the table structure.
   *
   * In addition, we can define how the field and its content can be manipulated
   * in the GUI. The behaviour of the widgets used can be determined here.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);
    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Cron Ping Record.'))
      ->setReadOnly(TRUE);

    // Standard field, unique outside of the scope of the current project.
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Cron Ping Record.'))
      ->setReadOnly(TRUE);

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of Cron Ping Record.'));
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['start_time'] = BaseFieldDefinition::create('list_integer')
      ->setLabel(t('Start Time'))
      ->setDescription(t('The start time.'))
      ->setSettings(array(
        'default_value' => 0,
        'unsigned' => TRUE,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'inline',
        'type' => 'string',
        'weight' => -6,
      ))
      ->setSetting('allowed_values', [
          '0' => '12am',
          '1' => '1am',
          '2' => '2am',
          '3' => '3am',
          '4' => '4am',
          '5' => '5am',
          '6' => '6am',
          '7' => '7am',
          '8' => '8am',
          '9' => '9am',
          '10' => '10am',
          '11' => '11am',
          '12' => '12pm',
          '13' => '1pm',
          '14' => '2pm',
          '15' => '3pm',
          '16' => '4pm',
          '17' => '5pm',
          '18' => '6pm',
          '19' => '7pm',
          '20' => '8pm',
          '21' => '9pm',
          '22' => '10pm',
          '23' => '11pm',
      ])
      ->setDisplayOptions('form', array(
        'type' => 'options_select',
        'weight' => -6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['end_time'] = BaseFieldDefinition::create('list_integer')
      ->setLabel(t('End Time'))
      ->setDescription(t('The end time.'))
      ->setSettings(array(
        'default_value' => 0,
        'unsigned' => TRUE,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'inline',
        'type' => 'string',
        'weight' => -6,
      ))
      ->setSetting('allowed_values', [
        '0' => '12am',
        '1' => '1am',
        '2' => '2am',
        '3' => '3am',
        '4' => '4am',
        '5' => '5am',
        '6' => '6am',
        '7' => '7am',
        '8' => '8am',
        '9' => '9am',
        '10' => '10am',
        '11' => '11am',
        '12' => '12pm',
        '13' => '1pm',
        '14' => '2pm',
        '15' => '3pm',
        '16' => '4pm',
        '17' => '5pm',
        '18' => '6pm',
        '19' => '7pm',
        '20' => '8pm',
        '21' => '9pm',
        '22' => '10pm',
        '23' => '11pm',
      ])
      ->setDisplayOptions('form', array(
        'type' => 'options_select',
        'weight' => -6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['address'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Address'))
      ->setDescription(t('Address.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'inline',
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

}
