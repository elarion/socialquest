<?php

    Abstract Class Champion Extends Table
    {
        // ATTRIBUTES
        public static $class = array('Wizard', 'Warrior', 'Tank', 'Priest', 'Ranger');
        protected $error = array();
        protected $protect = FALSE;
        protected $buff = array();
        protected static $tableName = 'champions';
        // END OF ATTRIBUTES

        // CONSTRUCTOR
        public function __construct( array $fields )
        {
            $this->relation = array('weapons' => 'weapons_has_champions');
            $this->fillable = array('id', 'name', 'health', 'strength', 'intelligence', 'classe');

            $param = array_map(function($n, $m){return $n+$m;}, $fields, array('strength' => 100, 'intelligence' => 100, 'health' => 500));
            $param = array_combine(array_keys($fields), $param);
            return parent::__construct($param);
        }
        // END OF CONSTRUCTOR

        // METHODS
        public function addWeapons(Weapon $weapon)
        {
            $this->collections['weapons'][] = $weapon;
            if (!isset($weapon->id)) {
                $weapon->save();
            }
        }

        public function computedAbilities($abilities)
        {
            if (!empty($this->fields[$abilities]['value'])) {
                $computed_val = $this->fields[$abilities]['value'];

                if (!empty($this->collections['weapons'])) {
                    foreach ($this->collections['weapons'] as $weapon){
                        $computed_val += $weapon->$abilities."_bonus";
                    }

                }
                if (!empty($this->buff[$abilities]))  {
                    $computed_val += $this->buff[$abilities];
                }
                if (!empty($this->debuff[$abilities])) {
                    $computed_val += $this->debuff[$abilities];
                }
                return (int) $computed_val;
            }
            else {
                die('No value for this abilities');
            }
        }


        public function addBuff(array $fields) 
        {
            $this->buff = array_merge($this->buff, $fields);

            foreach ($this->buff as $field => $buf) {
                $this->fields[$field]['value'] = $buf;
            }
        }

        public function getBuff ($abilities) 
        {
            return (isset($this->buff[$abilities]) ? $this->buff[$abilities] : 0);
        }
        public function attack(Champion $ennemy) 
        {
            $damages = $this->computedAbilities('strength');
            $ennemy->receiveAttack($damages);
        }

        public function protect() 
        {
            $this->protect = TRUE;
        }

        public function noProtect() 
        {
            $this->protect = FALSE;
        }
        public function receiveAttack($damage) 
        {
            if ($this->protect) {
                $this->fields['health']['value'] -= floor($damage * ((100-75) / 100));
            } else {
                $this->fields['health']['value'] -= $damage;
            }
        }

        public function heal() 
        {
            $intel = $this->computedAbilities('intelligence');
            $this->fields['health']['value'] += $intel;
        }
        // END OF METHODS
    }