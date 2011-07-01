<?php
/**
 * Declares Jelly_Core_Request
 *
 * PHP version 5
 *
 * @group DependenciesJelly
 *
 * @category  DependenciesJelly
 * @package   DependenciesJelly
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/core/request.php
 * @since     2011-07-01
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Provides Jelly_Core_Request
 *
 * PHP version 5
 *
 * @group DependenciesJelly
 *
 * @category  DependenciesJelly
 * @package   DependenciesJelly
 * @author    mtou <mtou@charougna.com>
 * @copyright 2011 mtou
 * @license   http://www.debian.org/misc/bsd.license BSD License (3 Clause)
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/core/request.php
 */
abstract class Jelly_Core_Request
{

  /**
   * Dummy constructor needed by in dependency injector
   *
   * @return null
   */
  public function __construct()
  {

  }


  /**
   * Get a Jelly_Builder with container aggregation
   *
   * @param string $model name of the model
   * @param mixed  $key   optional key
   *
   * @return Jelly_Builder builder instance
   */
  public function query($model, $key = NULL)
  {
    $builder            = Jelly::query($model, $key);
    $builder->container = $container;

    return $builder;
  }

} // End class Jelly_Core_Request