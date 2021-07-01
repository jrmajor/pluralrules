%skip   space          \s

%token  integers        @integer
%token  decimals        @decimal
%token  tilde           ~
%token  dot             \.
%token  comma           ,
%token  ellipsis        (…|\.\.\.)
%token  value           [0-9]+(\.[0-9]+)?([ce][1-9][0-9]*)?

#samples:
     ( ::integers:: rangeList() )? ( ::decimals:: rangeList() )?

rangeList:
    ( <value> | range() ) ( ::comma:: ( <value> | range() ) )* ( ::comma:: ::ellipsis:: )?

#range:
    <value> ( ::tilde:: <value> )?
