<?php

    Class Tank Extends Champion
    {
        // ATTRIBUTES
        protected $attackList = array();

        CONST STRENGTH = -60; 
        CONST INTELLIGENCE = 0; 
        CONST HEALTH = 450; 
        CONST WEAPON_NAME = 'Shield of concrete'; 
        CONST WEAPON_BONUS = 10;
        CONST CHAMP_NAME = 'Alistar';
        CONST CLASSE_NAME = 'Tank';
        // END OF ATTRIBUTES

        // CONSTRUCTOR
        public function __construct( )
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
                    'health_bonus' => self::WEAPON_BONUS,
                )
            ));
            $this->saveCollections('weapons');
        }
        // END OF CONSTRUCTOR

        // METHODS
        public function secondaryComp(Champion $enemy)
        {
            $this->fields['strength']['value'] += 20;
            $dmg = $this->computedAbilities('strength');
            $enemy->receiveAttack($dmg);
        }

    	public function mainComp(Champion $enemy)
        {
            $dmg = $this->computedAbilities('strength') + floor($this->fields['strength']['value']/6);

            $this->receiveAttack(20);
            $enemy->receiveAttack($dmg);
        }
        // END OF METHODS
    }