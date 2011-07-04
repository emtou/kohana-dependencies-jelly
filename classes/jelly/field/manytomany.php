<?php
/**
 * Declares Jelly_Field_ManyToMany
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/field/manytomany.php
 * @since     2011-07-01
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Overloads Jelly_Field_ManyToMany to handle dependency injection
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/field/manytomany.php
 */
class Jelly_Field_ManyToMany extends Jelly_Core_Field_ManyToMan
{
  /**
   * Returns a Jelly_Builder that can then be selected, updated, or deleted.
   *
   * @param Jelly_Model $model model
   * @param mixed       $value value
   *
   * @return Jelly_Builder
   */
  public function get($model, $value)
  {
    // If the value hasn't changed, we need to pull from the database
    if ( ! $model->changed($this->name))
    {
      $value = $this->_in($model);
    }

    if (isset($model->container))
    {
      $foreign_definition_key = $model->container
                                      ->get_definition_key_from_model($this->foreign['model']);

      $query = $model->container->get('jelly.request')
                ->query($foreign_definition_key);
    }
    else
    {
      $query = Jelly::query($this->foreign['model']);
    }

    return $query->where($this->foreign['field'], 'IN', $value);
  }
}