# Pimple Container as a Singleton

The task is simple: I'd like to easily get my Pimple Container from anywhere in the code.

Whether it's a module, an external class, independent library that has no idea which framework my particular project is using, or, I'd like not to worry about how I am passing it around.
 
So a singleton seems the easy option.

The singleton is created automatically when the Container is invoked. You can do this:

```php
new \PimpleSingleton\Container();
$di = \PimpleSingleton\Container::getContainer(); 
```

Have you already defined your Pimple instance, for instance through a framework initialization, or maybe in a unit test?

```php
$di = new Pimple\Container();
\PimpleSingleton\Container::setContainer($di);
$di = \PimpleSingleton\Container::getContainer();
```

Using PhpStorm (the greatest IDE of them all... ;-)

```
namespace PHPSTORM_META {
  /** @noinspection PhpUnusedLocalVariableInspection */
  /** @noinspection PhpIllegalArrayKeyTypeInspection */
  $STATIC_METHOD_TYPES = [
      \PimpleSingleton\Container::get('') => array(
          'db' instanceof \Aura\Sql\ExtendedPdo,
          'request' instanceof \Slim\Http\Request,
          'response' instanceof \Slim\Http\Response
      )
  ];
}
```

PhpStorm will now perform autocompletion for code like this:

```
$db = \PimpleSingleton\Container::get('db');
```

Enjoy!