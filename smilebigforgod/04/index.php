<!DOCTYPE html>
<html lang="ja">
<head>
<title>10 Questions | by smilebigforgod</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="/10q/10q.css" />

<style type="text/css">
#answer span:first-child:before {
  content:"Yes, but only in my head.";
}
#answer span:first-child label:after {
  content:"はい、でも頭の中だけ";
}
#answer span:last-child:before {
  content:"Never, they don’t speak like humans.";
}
#answer span:last-child label:after {
  content:"いいえ、動物たちは人間みたいに話しません";
}
#enquete span {
  display:inline-block;
}

#answer:after {
  position:absolute;
  margin:1.5vw 0; padding:1.5vw 0;
	display:block;
	content:'or';
	-webkit-transform:translate(-50%,-50%);
	transform:translate(-50%,-50%);
	top:50%; left:50%;
}

#image {
  position:absolute;
  text-align:center;
	-webkit-transform:translate(-50%,-50%);
	transform:translate(-50%,-50%);
	top:50%; left:50%;
  width:100vw;
  z-index:-1;
  overflow:hidden;
}
#image img {
  max-width:40vw;
  max-height:40vw;
  padding:2.5vw;
}
</style>
</head>
<body>

<section id="main" class="questionnaire">
<form action="answer.php" id="10q" method="post">

<div class="question">
<h2>Do you give animals cute voices in your head?</h2>
<p>頭の中で動物たちはかわいい声で話しますか？</p>

<div id="answer">
<?php
$answer = array('left', 'right');
for ($i = 0; $i < count($answer); $i++) {
  print "<span>\n";
  print "<input id='{$answer[$i]}' type='radio' name='answer' value='$i' required>\n";
  print "<label for='{$answer[$i]}'></label>\n";
  print "</span>\n";
}
?>
</div>
</div>


<p id="start">
<input type="submit" name="submit" value="Answer">
</p>

</form>
</section>

</body>
</html>
