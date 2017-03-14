<?php
/**
 * @file
 * Contains \Drupal\cron_ping\CronPingLogInterface.
 */

namespace Drupal\cron_ping;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a CronPingLog entity.
 *
 * We have this interface so we can join the other interfaces it extends.
 *
 */
interface CronPingLogInterface extends ContentEntityInterface, EntityChangedInterface {

}
