<?php

    Class Wizard extends Champion
    {
        // ATTRIBUTES
        protected $attackList = array();

        CONST STRENGTH = -20; 
        CONST INTELLIGENCE = 50; 
        CONST HEALTH = 0; 
        CONST WEAPON_NAME = "Street's wand"; 
        CONST WEAPON_BONUS = 10;
        CONST CHAMP_NAME = 'Veigar';
        CONST CLASSE_NAME = 'Wizard';
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
                    'intelligence_bonus' => self::WEAPON_BONUS,
                )
            ));
            $this->saveCollections('weapons');
        }
        // END OF CONSTRUCTOR

        // METHODS
        public function secondaryComp(Champion $enemy)
        {
            $this->addBuff(array('intelligence' => 20));
            $enemy->addBuff(array('intelligence' => -10));
        }

    	public function mainComp(Champion $enemy)
        {
            $dmg = $this->computedAbilities('intelligence') + 10;

            $this->receiveAttack(20);
            $enemy->receiveAttack($dmg);
        }
        // END OF METHODS
    }