<?php

namespace Major\PluralRules\Dev\Rules;

use Major\PluralRules\Dev\Helpers\CldrData;
use Major\PluralRules\Dev\Helpers\LocaleFiles;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CompileRulesCommand extends Command
{
    protected static $defaultName = 'rules';

    protected static $defaultDescription = 'Compiles rules for all locales';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $start = microtime(true);

        LocaleFiles::prepareDirectory('rules');

        foreach (CldrData::rules() as $locale => $rules) {
            (new RuleCompiler($locale, $rules))->compile();
        }

        $output->writeln('<info>Compiled in ' . round(microtime(true) - $start, 2) . 's</info>');

        return Command::SUCCESS;
    }
}
