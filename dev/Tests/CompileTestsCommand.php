<?php

namespace Major\PluralRules\Dev\Tests;

use Major\PluralRules\Dev\Helpers\CldrData;
use Major\PluralRules\Dev\Helpers\LocaleFiles;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('tests', 'Compiles tests for all locales')]
final class CompileTestsCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $start = microtime(true);

        LocaleFiles::prepareDirectory('tests');

        $progressBar = new ProgressBar($output);

        foreach ($progressBar->iterate(CldrData::rules()) as $locale => $rules) {
            (new TestCompiler($locale, $rules))->compile();
        }

        $output->writeln('');
        $output->writeln('<info>Compiled in ' . round(microtime(true) - $start, 2) . 's</info>');

        return Command::SUCCESS;
    }
}
