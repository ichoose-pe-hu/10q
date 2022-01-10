<?php

function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$name = (string)filter_input(INPUT_POST, 'name'); // $_POST['name']
$link = (string)filter_input(INPUT_POST, 'link'); // $_POST['link']
$tag = (string)filter_input(INPUT_POST, 'tag'); // $_POST['tag']

$fp = fopen('10q.csv', 'a+b');
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
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="/styles.css" />
<link rel="stylesheet" type="text/css" href="/10q/list.css" />
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="/10q/org.js"></script>
<script type="text/javascript">
$(function(){
$("#top").load("/top.html");
})
</script>
<title>Create 10 Questions | The Answers are always inside of you</title>
</head>
<body>
<div id="top"></div>
<h2 class="today"><u><a href="/collection/">Create</a></u></h2>

<div id="main">
<div id="ichoose">
<h1><i>Think</i></h1>
<div id="howto">
<h3>We create a collection of<br/><i>10 Questions</i></h3>
<h3>Let's enjoy 10 Questions by various peoples
<br>and Let's Create Your 10 Questions here.</h3>
<p>10の質問のコレクションを作成しています。<br/>
さまざまな人が考えた10の質問を楽しんで、理想の10の質問を考えてみましょう。</p>
</div>
</div>
<form id="org">
<h3><u>These 10 questions were created by</u></h3>
<div class="search-box language" style="display:none;">
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
<input type="reset" name="reset" value="All" class="reset-button"></li>
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
<span>coming soon</span>
<a></a>
</li>
<?php endif; ?>
</ul>
<h1>by creative, community space <b><a href="http://vg.pe.hu/jp/">∧°┐</a></b></h1>
</div>
</body>
</html>
