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
   * Asks the dependency injection container the model name
   *
   * @param string $definition_key definition key
   *
   * @return string model name
   */
  protected function _get_model_name($definition_key)
  {
    return $this->container->get_definition($definition_key)->arguments[0];
  }


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
   * @param string $definition_key name of the DI definition
   * @param mixed  $key            optional primary key to fetch from database
   *
   * @return Jelly_Builder builder instance
   */
  public function query($definition_key, $key = NULL)
  {
    $model_name = $this->_get_model_name($definition_key);

    $builder                 = Jelly::query($model_name, $key);
    $builder->container      = $this->container;
    $builder->definition_key = $definition_key;

    return $builder;
  }

} // End class Jelly_Core_Request