<?php

namespace App\Service;

class ProfileInfoGenerator
{
    public function getRaces() {
        return [
            'Human',
            'Dwarf',
            'Night Elf',
            'Gnome'
        ];
    }

    public function getClasses() {
        return [
            'Druid',
            'Hunter',
            'Mage',
            'Paladin',
            'Priest',
            'Rogue',
            'Warlock',
            'Warrior',
        ];
    }

    public function getSpecs() {
        return [
            'Dps',
            'Tank',
            'Healer',
        ];
    }

    public function getProfessions() {
        return [
            '',
            'Alchemy',
            'Blacksmithing (Armour)',
            'Blacksmithing (Weapon)',
            'Enchanting',
            'Engineering (Gnomish)',
            'Engineering (Goblin)',
            'Herbalism',
            'Leatherworking',
            'Mining',
            'Skinning',
            'Tailoring',
        ];
    }
}