<?php

namespace Nafai\Game\GameData\Actions\Abilities;

abstract class Ability {
    protected $ability_name;
    abstract protected function action($user, $target);
}

?>