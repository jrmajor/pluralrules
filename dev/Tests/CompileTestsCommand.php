<?php

namespace Major\PluralRules\Dev\Tests;

use Major\PluralRules\Dev\Helpers\CldrData;
use Major\PluralRules\Dev\Helpers\LocaleFiles;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CompileTestsCommand extends Command
{
    protected static $defaultName = 'tests';

    protected static $defaultDescription = 'Compiles tests for all locales';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $start = microtime(true);

        LocaleFiles::prepareDirectory('tests');

        foreach (CldrData::rules() as $locale => $rules) {
            (new TestCompiler($locale, $rules))->compile();
        }

        $output->writeln('<info>Compiled in ' . round(microtime(true) - $start, 2) . 's</info>');

        return Command::SUCCESS;
    }
}
