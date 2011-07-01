<?php
/**
 * Declares Jelly_Builder
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/builder.php
 * @since     2011-07-01
 */

defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Overloads Jelly_Builder to handle dependency injection
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
 * @link      https://github.com/emtou/kohana-dependencies-jelly/tree/master/classes/jelly/builder.php
 */
class Jelly_Builder extends Jelly_Core_Builder
{

  /**
   * Executes the query as a SELECT statement and always returns Jelly_Collection.
   *
   * @param string $db database
   *
   * @return  Jelly_Collection
   */
  public function select_all($db = NULL)
  {
    $db   = $this->_db($db);
    $meta = $this->_meta;

    if ($meta)
    {
      // Select all of the columns for the model if we haven't already
      empty($this->_select) AND $this->select_column('*');

      // Trigger before_select callback
      $meta->events()->trigger('builder.before_select', $this);
    }

    // Ready to leave the builder, we need to figure out what type to return
    $this->_result = $this->_build(Database::SELECT);

    // Return an actual array
    if ($this->_as_object === FALSE OR Jelly::meta($this->_as_object))
    {
      $this->_result->as_assoc();
    }
    else
    {
      $this->_result->as_object($this->_as_object);
    }

    // Pass off to Jelly_Collection, which manages the result
    if (isset($this->container))
    {
      $this->_result = new Jelly_Collection(
          $this->_result->execute($db),
          $this->_as_object,
          $this->container,
          $this->definition_key
      );
    }
    else
    {
      $this->_result = new Jelly_Collection($this->_result->execute($db), $this->_as_object);
    }

    // Trigger after_query callbacks
    if ($meta)
    {
      $meta->events()->trigger('builder.after_select', $this);
    }

    return $this->_result;
  }
} // End Jelly_Builder