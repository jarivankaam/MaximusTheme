<?php

return \StubsGenerator\Finder::create()
    ->in('wp-content/plugins/lockr')
    ->notPath('css')
    ->notPath('js')
    ->notPath('vendor')
    ->sortByName()
;
