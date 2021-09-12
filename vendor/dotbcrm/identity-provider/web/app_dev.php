<?php
/* 
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */

use Dotbcrm\IdentityProvider\App\Application;
use Symfony\Component\Debug\Debug;

ini_set('display_errors', 1);
require_once __DIR__ . '/../vendor/autoload.php';

Debug::enable();

$app = new Application(['env' => Application::ENV_DEV]);
$app->run();
