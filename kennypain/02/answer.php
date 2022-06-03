<?php
function h($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$answer = (string)filter_input(INPUT_POST, 'answer'); // $_POST['answer']

$fp = fopen('answer.csv', 'a+b');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    flock($fp, LOCK_EX);
    fputcsv($fp, [$answer]);
    rewind($fp);
}

flock($fp, LOCK_SH);
while ($row = fgetcsv($fp)) {
    $rows[] = $row;
}
flock($fp, LOCK_UN);
fclose($fp);
?>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../10q.css" />
<link rel="stylesheet" type="text/css" href="../answer.css" />
<link rel="stylesheet" type="text/css" href="http://ichoose.pe.hu/styles.css" />
<title>10 Questions | by ケニーペイン</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>
<section id="main" class="form">
<form action="answer.php" id="10q" method="post">
<div class="question">
<h2>being beside</h2>
<p>隣にいる。</p>
<div id="answer">
<span class="left">
<p><u>hold hands</u></p>
<p>手を繋ぐ</p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><u>cross shoulders</u></p>
<p>肩を組む</p>
</span>
</div>
<div id="total">
<?php if (!empty($rows)): ?>
<?php foreach ($rows as $row): ?>
<button class="<?=h($row[0])?>"></button>
<?php endforeach; ?>
<?php else: ?>
<?php endif; ?>
</div>
<p id="next"><a href="../03/"> Next Question </a></p>
</div>
</form>
</section>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://ichoose.pe.hu/js/10q.js"></script>
<script type="text/javascript" src="http://ichoose.pe.hu/js/main.js"></script>
<script type="text/javascript" src="http://ichoose.pe.hu/js/jquery.arctext.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
