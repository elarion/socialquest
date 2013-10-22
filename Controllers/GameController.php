<?php

	Class GameController
	{
		public function init_party()
		{
            global $template;

            if (!empty($_POST)) {
                $pseudo = $_POST['pseudo'];
                $password = $_POST['classes'];
                if (!empty($pseudo) && !empty($password)) {
                    if (($user = User::find(array('pseudo' => $pseudo))) === NULL) {
                        $user = new User(array('pseudo' => $user1_name));
                        $user->save();
                        $user_champ = new $user1_class(array('health' => 500));
                        $user->addCollection($user1_champ, 'champions');
                        $user->saveCollections('champions');
                    } else {
                        $user->with('champions');
                        $user_champ = ($user1->getCollection('champions'));
                        $user_champ[0]->fill(array('health' => 500));
                    }

                    $n = rand(1, 2);
                    $alias = 'user'.$n;
                    $battle = new Battle(array('id_user_1' => $user1->id, 'id_user_2' => $user2->id, 'turn_is' => ${$alias}->id));
                    $battle->save();
                    $_SESSION['battle'] = $battle->id;
                    $template = 'ingame';

                    return array('user1' => $user1, 'user2' => $user2, 'turn_is' => $battle->turn_is, 'win_is' => 0, "champion_user1" => $user1->getCollection('champions'), "champion_user2" => $user2->getCollection('champions'));
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
                $template = 'ingame';
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