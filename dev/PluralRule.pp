%skip   space          \s

%token  or              or
%token  and             and
%token  not             not
%token  eq              =
%token  neq             !=
%token  mod             %|mod
%token  operand         n|i|f|t|v|w|c|e
%token  doubleDot       \.\.
%token  comma           ,
%token  number          [0-9]+

#condition:
    relation() ( ( <and> | <or> ) relation() )*

#relation:
    expression() operator() rangeList()

#expression:
    <operand> ( ::mod:: <number> )?

#operator:
    ( <not> )? <eq> | <neq>

#rangeList:
    ( range() | <number> ) ( ::comma:: ( range() | <number> ) )*

#range:
    <number> ::doubleDot:: <number>
