<?php

mb_language("ja");
mb_internal_encoding("UTF-8");

// メッセージを保存するファイルのパス設定
define( 'FILENAME', 'draft.csv');

// 変数の初期化
$page_flag = 0;

if( !empty($_POST['btn_confirm']) ) {

	$page_flag = 1;
	session_start();
	$_SESSION['page'] = true;

} elseif( !empty($_POST['btn_submit']) ) {

	if( $file_handle = fopen( FILENAME, "a") ) {

		// 書き込むデータを作成
		$data = "'".$_POST['name']."'\n\n'".$_POST['q']."','".$_POST['a_left']."','".$_POST['a_right']."'\n\n\n";

		// 書き込み
		fwrite( $file_handle, $data);

		// ファイルを閉じる
		fclose( $file_handle);
	}

	session_start();
	if( !empty($_SESSION['page']) && $_SESSION['page'] === true ) {

	$page_flag = 2;

	// 変数とタイムゾーンを初期化
	$header = null;
	$auto_reply_subject = null;
	$auto_reply_text = null;
	$admin_reply_subject = null;
	$admin_reply_text = null;
	date_default_timezone_set('Asia/Tokyo');

	// ヘッダー情報を設定
	$header = "MIME-Version: 1.0\n";
	$header .= "From: i choose <we.are.pe.hu@gmail.com>\n";
	$header .= "Reply-To: i choose <we.are.pe.hu@gmail.com>\n";

	// 件名を設定
	$auto_reply_subject = 'i choose | Create Your Question';

	// 本文を設定
	$auto_reply_text .= "Thank You for Create Your Question\n\n";
	$auto_reply_text .= "This questions was created by\n" . $_POST['name'] . "\n\n\n";

	$auto_reply_text .= "Question\n\n" . $_POST['q'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left'] . "";
	$auto_reply_text .= " or " . $_POST['a_right'] . "\n\n\n\n";

	$auto_reply_text .= "Posted on " . date("m-d-y H:i") . "\n\n\n";
	$auto_reply_text .= "ichoose.pe.hu";

	mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text, $header);


	// 件名を設定
	$admin_reply_subject = 'i choose | Create Your Question';

	// 本文を設定
	$admin_reply_text .= "Thank You for Create Your Question\n\n";
	$admin_reply_text .= "This questions was created by\n" . $_POST['name'] . "\n\n";
	$admin_reply_text .= "Email " . $_POST['email'] . "\n\n\n";

	$admin_reply_text .= "Question\n\n" . $_POST['q'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left'] . "";
	$admin_reply_text .= " or " . $_POST['a_right'] . "\n\n\n\n";

	$admin_reply_text .= "Posted on " . date("m-d-y H:i") . "\n\n\n";
	$admin_reply_text .= "ichoose.pe.hu";

	mb_send_mail( 'pehu@creative-community.space', $admin_reply_subject, $admin_reply_text, $header);

	} else {
		$page_flag = 0;
	}
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<title>Create 10 Questions | The Answers are always inside of you</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="10の質問のコレクションを作成しています。さまざまな人が考えた10の質問を楽しんで、理想の10の質問を考えてみましょう。">

<link rel="stylesheet" type="text/css" href="../styles.css" />
<link rel="stylesheet" type="text/css" href="../list.css" />

<style type="text/css">
.ichoose {font-size: 2vw; margin:10vw 5vw 35vw;}
.ichoose h3 u {font-size: 2.5vw;}
.ichoose p {margin-bottom: 5vw;}
input[type="name"],
input[type="email"],
input[type="text"] {
  width:75%;
  padding:1.25%;
  font-size:2vw;
}

input[type="submit"] {
  padding:2.5% 5%;
  margin:0 2.5%;
  font-size:2.5vw;
  background:transparent;
  border:red 2px solid;
  border-radius:50%;
  cursor:pointer;
}
#next {margin-top:5vw;}

.thankyou {
  position:absolute;
  display:block;
  overflow:auto;
  padding:0; margin:0;
  width:100%; height:100vh;
}
.thankyou h2 {
  position:fixed;
  bottom:0;
  width:100%;
  text-align:center;
  font-size: 2.5vw; font-weight: 500;
  font-family: "Times New Roman", "Times", serif;
}
.thankyou hr {
  border:none;
  padding:2.5vw;
}

#today {
  position:fixed;
  z-index:10;
  top:0; left:0;
  width:100%;
  height:100vh;
  display:none;
}
#inside {
  top: 50%;
  left: 50%;
  z-index:25;
  z-index:100;
  height: 75vh;
  width: 75%;
  position:absolute;
  margin:0; padding:0;
  -webkit-transform:translate(-50%,-50%);
  transform:translate(-50%,-50%);
}
#next {zoom:1.25;}

@media screen and (max-width: 500px){
.or {width:75%;}
.left, .right {width:100%;}
input[type="name"],
input[type="email"],
input[type="text"] {
  width:85%;
  font-size:2.5vw;
}
.question h2 {padding-bottom:2.5vw;}
.or {padding-bottom:5vw;}
#answer {margin-top:2.5vw;}
#next {margin-top:7.5vw;}
}
@media print{
.ichoose {zoom:150%; height:70vh;}
}
</style>
</head>
<body>
<div id="top"></div>
<h2 class="today"><u><a onclick="obj=document.getElementById('today').style; obj.display=(obj.display=='block')?'none':'block';">Tips</a></u></h2>

<?php if( $page_flag === 1 ): ?>
<section id="main" class="form">

<div class="ichoose">
<h3><u>This question was created by</u></h3>
これは、 <b><?php echo $_POST['name']; ?></b>
<p>が考えた 10の質問 です。</p>
</div>

<form action="" id="10q" method="post">

<div class="question">
<h2><?php echo $_POST['q']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right']; ?></p>
</span>
</div>
</div>

<div class="question">
<p id="next">
<input type="submit" name="btn_back" value="Back">
<input type="submit" name="btn_submit" value="Post">
</p>

<input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
<input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">

<input type="hidden" name="q" value="<?php echo $_POST['q']; ?>">
<input type="hidden" name="a_left" value="<?php echo $_POST['a_left']; ?>">
<input type="hidden" name="a_right" value="<?php echo $_POST['a_right']; ?>">

</div>
</form>
</section>

<?php elseif( $page_flag === 2 ): ?>

<div class="thankyou">
<div class="ichoose">
<h3><u>Thank You for Create Your Question</u></h3>
<b><?php echo $_POST['name']; ?></b>
<p>質問をご制作いただき、ありがとうございます。</p>
<br/>
<p>投稿フォームに入力いただいたメールアドレスに、あなたが制作した質問を自動返信します。</p>
<p><u>※ 質問投稿後、返信メールが届かなかった場合は、お手数ですが we.are.pe.hu@gmail.com までお問合わせください。</u></p>
<br/>
<p>投稿いただいた質問を、このウェブサイトに公開する準備が整いましたら、同じく投稿フォームに入力いただいたメールアドレスまで、ウェブページ公開のお知らせをお送りいたします。</p>
<hr/>
</div>
</div>

<?php else: ?>
<section id="main" class="form">
<form action="" id="10q" method="post">

<div class="question">
<div id="answer">
<h2 for="name">Your Name</h2>
<p><input id="name" type="name" name="name" value="<?php if( !empty($_POST['name']) ){ echo $_POST['name']; } ?>" required></p>
<br/>
<h2 for="name">Email</h2>
<p><input id="email" type="email" name="email" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>" required></p>
</div>
</div>

<div class="question">
<h2 for="q">Question 1</h2>
<h2><input id="q" type="text" name="q" value="<?php if( !empty($_POST['q']) ){ echo $_POST['q']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left" type="text" name="a_left" value="<?php if( !empty($_POST['a_left']) ){ echo $_POST['a_left']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right" type="text" name="a_right" value="<?php if( !empty($_POST['a_right']) ){ echo $_POST['a_right']; } ?>" required></p>
</span>
</div>
</div>

<div class="question">
<p id="next">
<input type="submit" name="btn_confirm" value="Submit">
</p>
</div>
</form>
</section>
<?php endif; ?>

<div id="today">
<div id="inside">
<iframe src="/10q/tips.html" frameborder="0">読み込んでいます…</iframe>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
  $(function(){
  $("#top").load("../howto.html");
  })
</script>
</body>
</html>
