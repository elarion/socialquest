<?php

	Class Ranger extends Champion
	{
		// ATTRIBUTES
		protected $attackList = array();

        CONST STRENGTH = 0; 
        CONST INTELLIGENCE = -50; 
        CONST HEALTH = 0; 
        CONST WEAPON_NAME = 'Bow of sacrifice'; 
        CONST WEAPON_BONUS = 10;
        CONST CHAMP_NAME = 'Ash';
        CONST CLASSE_NAME = 'Ranger';
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
		        	'strength_bonus' => self::WEAPON_BONUS,
	        	)
	        ));
	        $this->saveCollections('weapons');
	    }
	    // END OF CONSTRUCTOR

	    // METHODS
	    public function secondaryComp(Champion $enemy)
	    {
	        $this->fields['strengh']['value'] += 20;
	        $dmg = $this->computedAbilities('strength');
	        $enemy->receiveAttack($dmg);
	    }

		public function mainComp(Champion $enemy)
	    {
	        $dmg = $this->computedAbilities('strength') + floor($this->fields['strengh']['value']/6);

	        $this->receiveAttack(50);
	        $enemy->receiveAttack($dmg);
	    }
	    // END OF METHODS
	}