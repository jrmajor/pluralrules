<?php

namespace Major\PluralRules\Dev;

use Closure;
use Major\PluralRules\Dev\Helpers\CldrData;
use Major\PluralRules\Dev\Helpers\LocaleFiles;
use Major\PluralRules\Dev\Rules\RuleCompiler;
use Major\PluralRules\Dev\Tests\TestCompiler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CompileCommands
{
    #[AsCommand('rules', 'Compiles rules for all locales')]
    public function rules(SymfonyStyle $io): int
    {
        return $this->compile($io, 'rules', fn ($locale, $rules) => new RuleCompiler($locale, $rules)->compile());
    }

    #[AsCommand('tests', 'Compiles tests for all locales')]
    public function tests(SymfonyStyle $io): int
    {
        return $this->compile($io, 'tests', fn ($locale, $rules) => new TestCompiler($locale, $rules)->compile());
    }

    /**
     * @param 'rules'|'tests' $directory
     * @param Closure(string, array<string, string>): void $compile
     */
    private function compile(SymfonyStyle $io, string $directory, Closure $compile): int
    {
        $start = microtime(true);

        LocaleFiles::prepareDirectory($directory);

        foreach ($io->progressIterate(CldrData::rules()) as $locale => $rules) {
            $compile($locale, $rules);
        }

        $io->success('Compiled in ' . round(microtime(true) - $start, 2) . 's');

        return Command::SUCCESS;
    }
}
