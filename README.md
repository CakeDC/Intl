CakeDC Intl Plugin
===================

This plugin library was created to help developers that do not have access to install the PHP intl extension.
It is not met to be a full replace for the PHP extension since it is limited in functionality and should be used with caution.

Versions and branches
============

**This code is still in ALPHA stages**


Requirements
============

* CakePHP 3.4+
* PHP 5.6+ without intl extension (it will still install, but what is the point if you have the extension).

Installation
============

Composer
------
Replace my_app with name of directory you will use.
```
composer self-update && composer create-project --prefer-dist cakephp/app my_app_name --ignore-platform-reqs
cd my_app_name
composer self-update && composer require cakedc/intl --ignore-platform-reqs
```
Changes needed in CakePHP
------

in config/requirements.php (or config/bootstrap.php if you are using an older version of CakePHP) change 
```
if (!extension_loaded('intl')) {
     trigger_error('You must enable the intl extension to use CakePHP.', E_USER_ERROR);
}
```
to

```
//if (!extension_loaded('intl')) {
     //trigger_error('You must enable the intl extension to use CakePHP.', E_USER_ERROR);
//}
```


Support
============

For bugs and feature requests, please use the [issues](https://github.com/CakeDC/users/issues) section of this repository.

Commercial support is also available, [contact us](https://www.cakedc.com/contact) for more information.

Contributing
============

This repository follows the [CakeDC Plugin Standard](https://www.cakedc.com/plugin-standard). If you'd like to contribute new features, enhancements or bug fixes to the plugin, please read our [Contribution Guidelines](https://www.cakedc.com/contribution-guidelines) for detailed instructions.

License
============

Copyright 2017 Cake Development Corporation (CakeDC). All rights reserved.

Licensed under the [MIT](http://www.opensource.org/licenses/mit-license.php) License. Redistributions of the source code included in this repository must retain the copyright notice found in each file.
