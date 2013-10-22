<?php

	Class GameController
	{
		public function init_party()
		{
            global $template;

            if (!empty($_POST)) {
                if (!empty($_POST['pseudo'][0]) && !empty($_POST['pseudo'][1])) {
                    $user1_name = $_POST['pseudo'][0];
                    $user1_class = $_POST['classes'][0];
                    $user2_name = $_POST['pseudo'][1];
                    $user2_class = $_POST['classes'][1];

                    if ($user1_name != $user2_name) { 
                        if (($user1 = User::find(array('pseudo' => $user1_name))) === NULL) {
                            $user1 = new User(array('pseudo' => $user1_name));
                            $user1->save();
                            $user1_champ = new $user1_class(array('health' => 500));
                            $user1->addCollection($user1_champ, 'champions');
                            $user1->saveCollections('champions');
                        } else {
                            $user1->with('champions');
                            $user1_champ = ($user1->getCollection('champions'));
                            $user1_champ[0]->fill(array('health' => 500));
                        }
                        
                        if (($user2 = User::find(array('pseudo' => $user2_name))) === NULL) {
                            $user2 = new User(array('pseudo' => $user2_name));
                            $user2->save();
                            $user2_champ = new $user2_class();
                            $user2->addCollection($user2_champ, 'champions');
                            $user2->saveCollections('champions');
                        } else {
                            $user2->with('champions');
                            $user2_champ = ($user2->getCollection('champions'));
                            $user2_champ[0]->fill(array('health' => 500));
                        }

                        $n = rand(1, 2);
                        $alias = 'user'.$n;
                        $battle = new Battle(array('id_user_1' => $user1->id, 'id_user_2' => $user2->id, 'turn_is' => ${$alias}->id));
                        $battle->save();
                        $_SESSION['battle'] = $battle->id;
                        $template = 'battle';

                        return array('user1' => $user1, 'user2' => $user2, 'turn_is' => $battle->turn_is, 'win_is' => 0, "champion_user1" => $user1->getCollection('champions'), "champion_user2" => $user2->getCollection('champions'));
                    } else {
                        header('location: index.php');
                    }
                } else {
                    header('location: index.php');
                }
            } else {
                header('location: index.php');
            }
        }

        public function action() {

            global $template;

            if (!empty($_SESSION)) {
                $id_battle = $_SESSION['battle'];
                $battle = new Battle(array('id' => $id_battle));
                $battle->usersInBattle();
                $id = $_POST['id_user'];
                $action = $_POST['method'];
                $template = 'battle';
                $win_is = $battle->round($id,$action);

                return array('user1' => $battle->user_1, 
                             'user2' => $battle->user_2, 
                             'turn_is' => $battle->turn_is,
                             'win_is' => (!is_null($win_is) ? $win_is : NULL),
                             'champion_user1' => $battle->user_1->getCollection('champions'),
                             'champion_user2' => $battle->user_2->getCollection('champions')
                );
            } else {
                header('location: index.php');
            }
        }

        public function restart() {
            global $template;

            $id_battle = $_SESSION['battle'];
            $battle = new Battle(array('id' => $id_battle));
            $battle->delete();

            session_destroy();

            header('location: index.php');
        }
	}