<?php

/**
 * Debugging helper, dumps TreeNode object.
 *
 * @return never
 */
function da(Hoa\Compiler\Llk\TreeNode $ast): void
{
    echo (new Hoa\Compiler\Visitor\Dump())->visit($ast);

    exit(1);
}
