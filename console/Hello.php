<?php
namespace Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
class Hello extends Command
{
    function __construct(string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('hello');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
	    echo "Welcom to deploly console!\n";
	    return 1;
    }
}
