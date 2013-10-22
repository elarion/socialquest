<?php

    Class Warrior extends Champion
    {
        // ATTRIBUTES
        protected $attackList = array();

        CONST STRENGTH = 70; 
        CONST INTELLIGENCE = -50; 
        CONST HEALTH = 0; 
        CONST WEAPON_NAME = 'Axe of doom'; 
        CONST WEAPON_BONUS = 10;
        CONST CHAMP_NAME = 'Riven';
        CONST CLASSE_NAME = 'Warrior';
        // END OF ATTRIBUTES

        // CONSTRUCTOR
        public function __construct()
        {
            parent::__construct(array(
                'strength' => self::STRENGTH, 
                'intelligence' => self::INTELLIGENCE,
                'health' => self::HEALTH
            ));
            $this->fill(array('name' => self::CHAMP_NAME));
            $this->fill(array('classe' => self::CLASSE_NAME));
            $this->save();
            $this->addWeapons(new Weapon(array(
                    'name' => self::WEAPON_NAME, 
                    'strength_bonus' => self::WEAPON_BONUS,
                )
            ));
            $this->saveCollections('weapons');
        }
        // END OF CONSTRUCTOR

        // METHODS
        public function secondaryComp(Champion $enemy)
        {
            $this->addBuff(array('strength' => 20));
            $this->addBuff(array('intelligence' => -5));
            $enemy->addBuff(array('strength' => -20));
        }

    	public function mainComp(Champion $enemy)
        {
            $dmg = $this->computedAbilities('strength') + 10;

            $this->receiveAttack(20);
            $enemy->receiveAttack($dmg);
        }
        // END OF METHODS
    }