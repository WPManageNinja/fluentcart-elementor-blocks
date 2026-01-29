# WPFluent-Micro Framework - 1.0.21

After downloading this repo, at first change the "psr-4" mappings in the autoload section of your "composer.json" file. Also, search replace namespaces. Most importantly, you should use some classes from the parent/main plugin to extend sub-classes in the add-on, for example:
```
namespace AddonNamespace\App\Http\Controllers;

use FluentCart\Framework\Http\Controller as BaseController;

abstract class Controller extends BaseController
{
    // 
}
```
Set the proper namespaces in places. The same goes for the BaseModel, RequestGuard, Policy and other classes which depend on (extends) classes from the main Plugin. If you want to use Facades then you should use the Facade of the main plugin's namespace as if you are in the main/parent plugin. When using a `Policy`, must use the fully qualified namespace (FQN).

Finally, Don't forget to run the `composer dump` command.
