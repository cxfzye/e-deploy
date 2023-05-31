<?php
<?php
use Symfony\Component\Console\Application;
use App\Base\Base;

require __DIR__ . '/../vendor/autoload.php';

include __DIR__ . '/../bootstrap/env.php';
$app = include __DIR__ . '/../bootstrap/bootstrap.php';

$container = $app->getContainer();

$commands = include __DIR__ . '/../app/commands.php';

$application = new Application();
Base::$container = $container;

foreach ($commands as $command) {
    $application->add(new $command());
}

$application->run();
