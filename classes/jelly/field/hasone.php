<?php
/**
 * Declares Jelly_Field_HasOne
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/field/hasone.php
 * @since     2011-07-01
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Overloads Jelly_Field_HasOne to handle dependency injection
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/field/hasone.php
 */
class Jelly_Field_HasOne extends Jelly_Core_Field_HasOne
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

    if ($model->changed($this->name))
    {
      return $query->where($this->foreign['model'].'.'.':primary_key', '=', $value)
                   ->limit(1);
    }
    else
    {
      return $query->where($this->foreign['model'].'.'.$this->foreign['field'], '=', $model->id())
                   ->limit(1);
    }
  }
}