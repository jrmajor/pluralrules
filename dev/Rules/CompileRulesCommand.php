<?php

namespace Major\PluralRules\Dev\Rules;

use Major\PluralRules\Dev\Helpers\CldrData;
use Major\PluralRules\Dev\Helpers\LocaleFiles;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('rules', 'Compiles rules for all locales')]
final class CompileRulesCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $start = microtime(true);

        LocaleFiles::prepareDirectory('rules');

        $progressBar = new ProgressBar($output);

        foreach ($progressBar->iterate(CldrData::rules()) as $locale => $rules) {
            (new RuleCompiler($locale, $rules))->compile();
        }

        $output->writeln('');
        $output->writeln('<info>Compiled in ' . round(microtime(true) - $start, 2) . 's</info>');

        return Command::SUCCESS;
    }
}
