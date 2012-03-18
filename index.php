<?php

$set = '';
$length = '';
$founds = array();

if (isset($_GET['set'])) {
    $set = strval($_GET['set']);
    $length = intval($_GET['length']);

    $sets = array();
    for ($i = 0; $i < strlen($set); $i ++) {
        $sets[strtolower($set[$i])] ++;
    }

    $fp = fopen('dict', 'r');
    while (false !== ($line = fgets($fp))) {
        $word = trim($line);

        if ($length != strlen($word)) {
            continue;
        }

        $clone_sets = $sets;
        for ($i = 0; $i < $length; $i ++) {
            if (!$clone_sets[strtolower($word[$i])]) {
                continue 2;
            }
            $clone_sets[strtolower($word[$i])] --;
        }
        $founds[] = $word;
    }
}

?>
<html>
<head>
<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-30131444-1']);
_gaq.push(['_trackPageview']);

(function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

</script>
</head>
<body>
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
</body>
</html>
