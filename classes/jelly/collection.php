<?php
/**
 * Declares Jelly_Collection
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/collection.php
 * @since     2011-06-30
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Overloads Jelly_Collection to enable dependency injection
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
 * @link      https://github.com/emtou/kohana-chacms/tree/master/classes/jelly/collection.php
 */
class Jelly_Collection extends Jelly_Core_Collection
{
  /**
   * Tracks a database result
   *
   * @param mixed                $result         database result
   * @param mixed                $model          model to retun results as
   * @param Dependency_Container $container      optional DI
   * @param string               $definition_key optional definition key for the DI
   */
  public function __construct($result, $model = NULL, $container = NULL, $definition_key = NULL)
  {
    $this->_result = $result;

    // Load our default model
    if ($model AND Jelly::meta($model))
    {
      if ($model instanceof Jelly_Model)
      {
        $this->_model = $model;
      }
      else
      {
        if ($definition_key)
        {
          $this->_model            = $container->get($definition_key);
          $this->_model->container = $container;
        }
        else
        {
          $this->_model = new $model;
        }
      }

      $this->_meta = $this->_model->meta();
    }
  }
}