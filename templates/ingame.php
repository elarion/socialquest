<header>
    <h1>
        <img src="./cores/img/logoPOO.png">
    </h1>
</header>
<div id="player_wrapper">
    <div class="center">
                <span class="player">
                    <?php echo($var['user1']->pseudo); ?> (<?php echo($var['champion_user1'][0]->name); ?>)
                    <span class="hp"><?php echo($var['champion_user1'][0]->health); ?></span>
                </span>
                <span class="player player2">
                    <?php echo($var['user2']->pseudo); ?> (<?php echo($var['champion_user2'][0]->name); ?>)
                    <span class="hp"><?php echo($var['champion_user2'][0]->health); ?></span>
                </span>
    </div>
    <div class="clear"></div>
</div>
<div id="form_wrapper">
    <div class="center">
        <div class="player" id="player1">
            <?php if ($var['win_is'] == 0 && $var['turn_is'] == $var['user1']->id) { ?>
                <form action="?action=action" method="post">
                    <span>
                        <input type="radio" name="method" value="attack" id="form_attack"/><label for="form_attack">Attack</label>
                    </span>
                    <span>
                        <input type="radio" name="method" value="protect" id="form_protection"/><label for="form_protection">Protect</label>
                    </span>
                    <span>
                        <input type="radio" name="method" value="heal" id="form_heal"/><label for="form_heal">Heal</label>
                    </span>
                    <span>
                        <input type="radio" name="method" value="mainComp" id="form_mainComp"/><label for="form_mainComp">mainComp</label>
                    </span>
                    <span>
                        <input type="radio" name="method" value="secondaryComp" id="form_secondaryComp"/><label for="form_secondaryComp">secondaryComp</label>
                    </span>
                    <input type="hidden" name="id_user" value="<?php echo $var['user1']->id; ?>" />
                    <input type="submit" value="GO"/>
                </form>
            <?php } ?>
        </div>
        <div class="j2 player2">
            <?php if ($var['win_is'] == 0 && $var['turn_is'] == $var['user2']->id) { ?>
                <form action="?action=action" method="post">
                    <span>
                        <input type="radio" name="method" value="attack" id="form_attack"/><label for="form_attack">Attack</label>
                    </span>
                    <span>
                        <input type="radio" name="method" value="protect" id="form_protection"/><label for="form_protection">Protect</label>
                    </span>
                    <span>
                        <input type="radio" name="method" value="heal" id="form_heal"/><label for="form_heal">Heal</label>
                    </span>
                    <span>
                        <input type="radio" name="method" value="mainComp" id="form_mainComp"/><label for="form_mainComp">mainComp</label>
                    </span>
                    <span>
                        <input type="radio" name="method" value="secondaryComp" id="form_secondaryComp"/><label for="form_secondaryComp">secondaryComp</label>
                    </span>
                    <input type="hidden" name="id_user" value="<?php echo $var['user2']->id; ?>" />
                    <input type="submit" value="GO"/>
                </form>
            <?php } ?>
        </div>
        <div class="clear"></div>
        <div>
            <div class="center j1_result">
                <?php if (!is_null($var['win_is']) && $var['win_is'] == $var['user1']->id) { ?>
                     <?php echo ($var['user1']->pseudo); ?> &agrave; gagn&eacute; !
                <?php } ?>
                <?php if (!is_null($var['win_is']) && $var['win_is'] == $var['user2']->id) { ?>
                     <?php echo ($var['user2']->pseudo); ?> &agrave; gagn&eacute; !
                <?php } ?>
            </div>
        </div>
        <div id="restartButton">
            <form method="post" action="index.php?action=restart">
                <input type="submit" value="Nouvelle partie" ?>
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>