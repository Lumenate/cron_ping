<?php

/**
 * @file
 * Contains \Drupal\cron_ping\Entity\Controller\CronPingRecordListBuilder.
 */

namespace Drupal\cron_ping\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for CronPingRecord entity.
 *
 */
class CronPingRecordListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {
    $build['description'] = array(
      '#markup' => $this->t('CronPingRecord implements a Content Entity model. These Cron Ping Records are fieldable entities. You can manage the fields on the <a href="@adminlink">Cron Ping Record admin page</a>. <br /><a href="@addlink">Add new</a>', array(
        '@adminlink' => \Drupal::urlGenerator()->generateFromRoute('cron_ping.cron_ping_record_settings'),
        '@addlink' => \Drupal::urlGenerator()->generateFromRoute('cron_ping_record.cron_ping_record_add'),
      )),
    );
    $build['table'] = parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the CronPingRecordListBuilder list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
  public function buildHeader() {
    $header['id'] = $this->t('id');
    $header['start_time'] = $this->t('Start Time');
    $header['end_time'] = $this->t('End Time');
    $header['address'] = $this->t('Address');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\cron_ping\Entity\CronPingRecord */
    $row['id'] = $entity->id();
    $row['start_time'] = $entity->start_time->value;
    $row['end_time'] = $entity->end_time->value;
    $row['address'] = $entity->address->value;
    return $row + parent::buildRow($entity);
  }

}
