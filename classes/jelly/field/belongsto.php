<?php
/**
 * Declares Jelly_Field_BelongsTo
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/field/belongsto.php
 * @since     2011-07-01
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Overloads Jelly_Field_BelongsTo to handle dependency injection
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/field/belongsto.php
 */
class Jelly_Field_BelongsTo extends Jelly_Core_Field_BelongsTo
{
  /**
   * Returns the Jelly model that this model belongs to.
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

    return $query->where($this->foreign['model'].'.'.$this->foreign['field'], '=', $value)
                ->limit(1);
  }

}