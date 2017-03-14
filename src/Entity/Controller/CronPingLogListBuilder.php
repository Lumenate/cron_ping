<?php

/**
 * @file
 * Contains \Drupal\cron_ping\Entity\Controller\CronPingLogListBuilder.
 */

namespace Drupal\cron_ping\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for CronPingRecord entity.
 *
 */
class CronPingLogListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {
    $build['description'] = array(
      '#markup' => $this->t('Cron Ping Log'),
    );
    $build['table'] = parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the CronPingLogListBuilder list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
  public function buildHeader() {
    $header['id'] = $this->t('id');
    $header['address'] = $this->t('Address');
    $header['result'] = $this->t('Result Code');
    return $header;
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\cron_ping\Entity\CronPingLog */
    $row['id'] = $entity->id();
    $row['address'] = $entity->address->value;
    $row['result'] = $entity->result->value;
    return $row;
  }

}
