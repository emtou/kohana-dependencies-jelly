<?php
/**
 * Declares Dependency_Container
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/dependency/container.php
 * @since     2011-07-01
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Overloads Dependency_Container to add functionality
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/dependency/container.php
 */

class Dependency_Container extends Kohana_Dependency_Container
{

  /**
   * Fetches a definition from a key
   *
   * @param string $definition_key definition key
   *
   * @return Dependency_Definition definition
   */
  public function get_definition($definition_key)
  {
    return $this->_definitions->get($definition_key);
  }


  /**
   * Fetches a definition key from a model name
   *
   * @param string $model_name model name
   *
   * @return string definition key
   */
  public function get_definition_key_from_model($model_name)
  {
    foreach ($this->_definitions as $key => $definition)
    {
      if (isset($definition->arguments[0])
          AND $definition->arguments[0] == strtolower($model_name))
      {
        return $key;
      }
    }

    throw new Kohana_Exception(
        'Can\'t get definition key from model: '.
        'model «:modelname» is not configured.',
        array(':modelname' => $model_name)
    );
  }
}