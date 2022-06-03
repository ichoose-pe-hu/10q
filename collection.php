<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$name = (string)filter_input(INPUT_POST, 'name'); // $_POST['name']
$link = (string)filter_input(INPUT_POST, 'link'); // $_POST['link']
$tag = (string)filter_input(INPUT_POST, 'tag'); // $_POST['tag']

$fp = fopen('collection.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$name, $link, $tag]);
    rewind($fp);
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title>10 Questions | The Answers are always inside of you</title>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="collection.css" />
</head>
<body>

<form id="org">
<div class="search-box language">
<ul>
<li>
<input type="radio" name="language" value="artist" id="artist">
<label for="artist" class="label">Artist</label></li>
<li>
<input type="radio" name="language" value="music" id="music">
<label for="music" class="label">Musician</label></li>
<li>
<input type="radio" name="language" value="director" id="director">
<label for="director" class="label">Director</label></li>
<li>
<input type="radio" name="language" value="design" id="design">
<label for="design" class="label">Designer</label></li>
<li>
<input type="radio" name="language" value="etc" id="etc">
<label for="etc" class="label">Etc,</label></li>
<li>
<input type="reset" name="reset" value="All" class="reset-button">
</li>
</ul>
</div>
</form>

<ul class="list">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<li class="list_item list_toggle" data-language="<?=h($row[2])?>">
<span><?=h($row[0])?></span>
<a href="<?=h($row[1])?>"></a>
</li>
<?php endforeach; ?>
<?php else: ?>
<li class="list_item list_toggle">
<span>Under Construction</span>
</li>
<?php endif; ?>
</ul>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="http://creative-community.space/coding/js/org.js"></script>
</body>
</html>
