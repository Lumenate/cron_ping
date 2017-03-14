<?php
/**
 * @file
 * Contains \Drupal\cron_ping\CronPingRecordInterface.
 */

namespace Drupal\cron_ping;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a CronPingRecord entity.
 *
 * We have this interface so we can join the other interfaces it extends.
 *
 */
interface CronPingRecordInterface extends ContentEntityInterface, EntityChangedInterface {

}
