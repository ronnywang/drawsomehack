<?php

$set = '';
$length = '';
$founds = array();

if (isset($_GET['set'])) {
    $set = strval($_GET['set']);
    $length = intval($_GET['length']);

    $sets = array();
    for ($i = 0; $i < strlen($set); $i ++) {
        $sets[$set[$i]] ++;
    }

    $fp = fopen('dict', 'r');
    while (false !== ($line = fgets($fp))) {
        $word = trim($line);

        if ($length != strlen($word)) {
            continue;
        }

        $clone_sets = $sets;
        for ($i = 0; $i < $length; $i ++) {
            if (!$clone_sets[$word[$i]]) {
                continue 2;
            }
            $clone_sets[$word[$i]] --;
        }
        $founds[] = $word;
    }
}

?>
<form method="get">
    alphabets: <input type="text" name="set" placeholder="Ex: AFETNOKMA" value="<?= htmlspecialchars($set) ?>"><br>
    length: <input type="text" name="length" placeholder="2~8" value="<?= htmlspecialchars($length) ?>"><br>
    <input type="submit">
</form>
<ol>
    <?php foreach ($founds as $word) { ?>
    <li><?= htmlspecialchars($word) ?></li>
    <?php } ?>
</ol>


