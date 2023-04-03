<?php

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

class searchingFiles extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:searching-files';
    protected static $defaultDescription = "This command find files";

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $start_path = "C:\Users\я.DESKTOP-CN63JQ9\Desktop\consoleProject/papka1";

        $output->writeln($this->findDirectories($start_path, $output));

        return Command::SUCCESS;
    }

    public function  findDirectories(String $path, OutputInterface $output) {
        $files = scandir($path);
        array_splice($files, 0, 2);
        $sum = 0;
        $count_path = null;

        if (in_array("count.txt", $files)) {
            $count_path = $path . "/" . "/count.txt";
        }

        foreach ($files as $el) {
            if ($el == "count.txt") continue;
            else {
                $sum += $this->findDirectories($path . "/" . $el, $output);
            }
        }

        if ($count_path != null) {
            $file = fopen($count_path, "r");

            return $sum + fgets($file);
        }

        return $sum;
    }
}