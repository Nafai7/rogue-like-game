<?php

namespace Nafai\Game\GameData\Characters;


require_once __DIR__."/Character.php";

use Nafai\Game\GameData\Characters\Character;

class Player {
    private Character $character;
    private int $experience;

    public function __construct(Character $character, int $experience) {
        $this->character = $character;
        $this->experience = $experience;
    }
    
    public function getCharacter(): Character {
        return $this->character;
    }

    public function getExperience(): int {
        return $this->experience;
    }

    public function addExperience(int $value): int {
        if ($value < 0) {
            throw new Exception("Can't decrease experience");
        }
        $this->experience += $value;
        
        $current_exp_threshold = pow(2, $this->character->getLevel()) * 100;
        if ($this->experience > $current_exp_threshold) {
            $this->character->addLevel(1);
            $this->experience -= $current_exp_threshold;
        }

        return $this->experience;
    }
}

?>