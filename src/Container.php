<?php

namespace PimpleSingleton;

/**
 * Extends the Pimple Container so that it's accessible from the whole app as a Singleton.
 * This method also allows PhpStorm metadata for auto-completion.
 *
 * Usage examples:
 *   $di = DIC\Container::getContainer();
 *   $db = DIC\Container::get('pdo');      // If set through PhpStorm metadata, $db will resolve as a PDO connection
 */
class Container extends \Pimple\Container
{

  /** @var \Pimple\Container */
  protected static $container = null;


  public function __construct(array $values = array())
  {
    parent::__construct($values);
    if (is_null(static::$container)) {
      static::$container = $this;
    }
  }


  /**
   * @return \Pimple\Container
   */
  public static function getContainer()
  {
    if (is_null(static::$container)) {
      new Container();
    }
    return static::$container;
  }


  /**
   * @param \Pimple\Container|\Interop\Container\ContainerInterface $container
   */
  public static function setContainer($container)
  {
    self::$container = $container;
  }


  public static function get($name)
  {
    if (is_null(static::$container)) {
      throw new ContainerException(__CLASS__ . ' must be initialized before use');
    }
    return static::$container[$name];
  }

}
