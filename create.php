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
		$data = "'".$_POST['name']."'\n\n'".$_POST['q_one']."','".$_POST['a_left_one']."','".$_POST['a_right_one']."'\n'".$_POST['q_two']."','".$_POST['a_left_two']."','".$_POST['a_right_two']."'\n'".$_POST['q_three']."','".$_POST['a_left_three']."','".$_POST['a_right_three']."'\n'".$_POST['q_four']."','".$_POST['a_left_four']."','".$_POST['a_right_four']."'\n'".$_POST['q_five']."','".$_POST['a_left_five']."','".$_POST['a_right_five']."'\n'".$_POST['q_six']."','".$_POST['a_left_six']."','".$_POST['a_right_six']."'\n'".$_POST['q_seven']."','".$_POST['a_left_seven']."','".$_POST['a_right_seven']."'\n'".$_POST['q_eight']."','".$_POST['a_left_eight']."','".$_POST['a_right_eight']."'\n'".$_POST['q_nine']."','".$_POST['a_left_nine']."','".$_POST['a_right_nine']."'\n'".$_POST['q_ten']."','".$_POST['a_left_ten']."','".$_POST['a_right_ten']."'\n\n\n";

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
	$auto_reply_subject = 'i choose | Create 10 Questions';

	// 本文を設定
	$auto_reply_text .= "Thank You for Create 10 Questions\n\n";
	$auto_reply_text .= "This questions was created by\n" . $_POST['name'] . "\n\n\n";

	$auto_reply_text .= "Question 1\n\n" . $_POST['q_one'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left_one'] . "";
	$auto_reply_text .= " or " . $_POST['a_right_one'] . "\n\n\n";

	$auto_reply_text .= "Question 2\n\n" . $_POST['q_two'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left_two'] . "";
	$auto_reply_text .= " or " . $_POST['a_right_two'] . "\n\n\n";

	$auto_reply_text .= "Question 3\n\n" . $_POST['q_three'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left_three'] . "";
	$auto_reply_text .= " or " . $_POST['a_right_three'] . "\n\n\n";

	$auto_reply_text .= "Question 4\n\n" . $_POST['q_four'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left_four'] . "";
	$auto_reply_text .= " or " . $_POST['a_right_four'] . "\n\n\n";

	$auto_reply_text .= "Question 5\n\n" . $_POST['q_five'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left_five'] . "";
	$auto_reply_text .= " or " . $_POST['a_right_five'] . "\n\n\n";

	$auto_reply_text .= "Question 6\n\n" . $_POST['q_six'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left_six'] . "";
	$auto_reply_text .= " or " . $_POST['a_right_six'] . "\n\n\n";

	$auto_reply_text .= "Question 7\n\n" . $_POST['q_seven'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left_seven'] . "";
	$auto_reply_text .= " or " . $_POST['a_right_seven'] . "\n\n\n";

	$auto_reply_text .= "Question 8\n\n" . $_POST['q_eight'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left_eight'] . "";
	$auto_reply_text .= " or " . $_POST['a_right_eight'] . "\n\n\n";

	$auto_reply_text .= "Question 9\n\n" . $_POST['q_nine'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left_nine'] . "";
	$auto_reply_text .= " or " . $_POST['a_right_nine'] . "\n\n\n";

	$auto_reply_text .= "Question 10\n\n" . $_POST['q_ten'] . "\n";
	$auto_reply_text .= "" . $_POST['a_left_ten'] . "";
	$auto_reply_text .= " or " . $_POST['a_right_ten'] . "\n\n\n\n";

	$auto_reply_text .= "Posted on " . date("m-d-y H:i") . "\n\n\n";
	$auto_reply_text .= "ichoose.pe.hu";

	mb_send_mail( $_POST['email'], $auto_reply_subject, $auto_reply_text, $header);


	// 件名を設定
	$admin_reply_subject = 'i choose | Create 10 Questions';

	// 本文を設定
	$admin_reply_text .= "Thank You for Create 10 Questions\n\n";
	$admin_reply_text .= "This questions was created by\n" . $_POST['name'] . "\n\n";
	$admin_reply_text .= "Email " . $_POST['email'] . "\n\n\n";

	$admin_reply_text .= "Question 1\n\n" . $_POST['q_one'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left_one'] . "";
	$admin_reply_text .= " or " . $_POST['a_right_one'] . "\n\n\n";

	$admin_reply_text .= "Question 2\n\n" . $_POST['q_two'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left_two'] . "";
	$admin_reply_text .= " or " . $_POST['a_right_two'] . "\n\n\n";

	$admin_reply_text .= "Question 3\n\n" . $_POST['q_three'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left_three'] . "";
	$admin_reply_text .= " or " . $_POST['a_right_three'] . "\n\n\n";

	$admin_reply_text .= "Question 4\n\n" . $_POST['q_four'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left_four'] . "";
	$admin_reply_text .= " or " . $_POST['a_right_four'] . "\n\n\n";

	$admin_reply_text .= "Question 5\n\n" . $_POST['q_five'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left_five'] . "";
	$admin_reply_text .= " or " . $_POST['a_right_five'] . "\n\n\n";

	$admin_reply_text .= "Question 6\n\n" . $_POST['q_six'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left_six'] . "";
	$admin_reply_text .= " or " . $_POST['a_right_six'] . "\n\n\n";

	$admin_reply_text .= "Question 7\n\n" . $_POST['q_seven'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left_seven'] . "";
	$admin_reply_text .= " or " . $_POST['a_right_seven'] . "\n\n\n";

	$admin_reply_text .= "Question 8\n\n" . $_POST['q_eight'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left_eight'] . "";
	$admin_reply_text .= " or " . $_POST['a_right_eight'] . "\n\n\n";

	$admin_reply_text .= "Question 9\n\n" . $_POST['q_nine'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left_nine'] . "";
	$admin_reply_text .= " or " . $_POST['a_right_nine'] . "\n\n\n";

	$admin_reply_text .= "Question 10\n\n" . $_POST['q_ten'] . "\n";
	$admin_reply_text .= "" . $_POST['a_left_ten'] . "";
	$admin_reply_text .= " or " . $_POST['a_right_ten'] . "\n\n\n\n";

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

<link rel="stylesheet" type="text/css" href="styles.css" />
<link rel="stylesheet" type="text/css" href="list.css" />

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
<h2 class="today"><u><a onclick="obj=document.getElementById('today').style; obj.display=(obj.display=='block')?'none':'block';">FAQs</a></u></h2>

<?php if( $page_flag === 1 ): ?>
<section id="main" class="form">

<div class="ichoose">
<h3><u>This question was created by</u></h3>
これは、 <b><?php echo $_POST['name']; ?></b>
<p>が考えた 10の質問 です。</p>
</div>

<form action="" id="10q" method="post">

<div class="question">
<h2><?php echo $_POST['q_one']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left_one']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right_one']; ?></p>
</span>
</div>
</div>

<div class="question">
<h2><?php echo $_POST['q_two']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left_two']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right_two']; ?></p>
</span>
</div>
</div>

<div class="question">
<h2><?php echo $_POST['q_three']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left_three']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right_three']; ?></p>
</span>
</div>
</div>

<div class="question">
<h2><?php echo $_POST['q_four']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left_four']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right_four']; ?></p>
</span>
</div>
</div>

<div class="question">
<h2><?php echo $_POST['q_five']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left_five']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right_five']; ?></p>
</span>
</div>
</div>

<div class="question">
<h2><?php echo $_POST['q_six']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left_six']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right_six']; ?></p>
</span>
</div>
</div>

<div class="question">
<h2><?php echo $_POST['q_seven']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left_seven']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right_seven']; ?></p>
</span>
</div>
</div>

<div class="question">
<h2><?php echo $_POST['q_eight']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left_eight']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right_eight']; ?></p>
</span>
</div>
</div>

<div class="question">
<h2><?php echo $_POST['q_nine']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left_nine']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right_nine']; ?></p>
</span>
</div>
</div>

<div class="question">
<h2><?php echo $_POST['q_ten']; ?></h2>
<div class="answer">
<span class="left">
<p><?php echo $_POST['a_left_ten']; ?></p>
</span>
<span class="or"><p><i>or</i></p></span>
<span class="right">
<p><?php echo $_POST['a_right_ten']; ?></p>
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

<input type="hidden" name="q_one" value="<?php echo $_POST['q_one']; ?>">
<input type="hidden" name="a_left_one" value="<?php echo $_POST['a_left_one']; ?>">
<input type="hidden" name="a_right_one" value="<?php echo $_POST['a_right_one']; ?>">

<input type="hidden" name="q_two" value="<?php echo $_POST['q_two']; ?>">
<input type="hidden" name="a_left_two" value="<?php echo $_POST['a_left_two']; ?>">
<input type="hidden" name="a_right_two" value="<?php echo $_POST['a_right_two']; ?>">

<input type="hidden" name="q_three" value="<?php echo $_POST['q_three']; ?>">
<input type="hidden" name="a_left_three" value="<?php echo $_POST['a_left_three']; ?>">
<input type="hidden" name="a_right_three" value="<?php echo $_POST['a_right_three']; ?>">

<input type="hidden" name="q_four" value="<?php echo $_POST['q_four']; ?>">
<input type="hidden" name="a_left_four" value="<?php echo $_POST['a_left_four']; ?>">
<input type="hidden" name="a_right_four" value="<?php echo $_POST['a_right_four']; ?>">

<input type="hidden" name="q_five" value="<?php echo $_POST['q_five']; ?>">
<input type="hidden" name="a_left_five" value="<?php echo $_POST['a_left_five']; ?>">
<input type="hidden" name="a_right_five" value="<?php echo $_POST['a_right_five']; ?>">

<input type="hidden" name="q_six" value="<?php echo $_POST['q_six']; ?>">
<input type="hidden" name="a_left_six" value="<?php echo $_POST['a_left_six']; ?>">
<input type="hidden" name="a_right_six" value="<?php echo $_POST['a_right_six']; ?>">

<input type="hidden" name="q_seven" value="<?php echo $_POST['q_seven']; ?>">
<input type="hidden" name="a_left_seven" value="<?php echo $_POST['a_left_seven']; ?>">
<input type="hidden" name="a_right_seven" value="<?php echo $_POST['a_right_seven']; ?>">

<input type="hidden" name="q_eight" value="<?php echo $_POST['q_eight']; ?>">
<input type="hidden" name="a_left_eight" value="<?php echo $_POST['a_left_eight']; ?>">
<input type="hidden" name="a_right_eight" value="<?php echo $_POST['a_right_eight']; ?>">

<input type="hidden" name="q_nine" value="<?php echo $_POST['q_nine']; ?>">
<input type="hidden" name="a_left_nine" value="<?php echo $_POST['a_left_nine']; ?>">
<input type="hidden" name="a_right_nine" value="<?php echo $_POST['a_right_nine']; ?>">

<input type="hidden" name="q_ten" value="<?php echo $_POST['q_ten']; ?>">
<input type="hidden" name="a_left_ten" value="<?php echo $_POST['a_left_ten']; ?>">
<input type="hidden" name="a_right_ten" value="<?php echo $_POST['a_right_ten']; ?>">
</div>
</form>
</section>

<?php elseif( $page_flag === 2 ): ?>

<div class="thankyou">
<div class="ichoose">
<h3><u>Thank You for Create 10 Questions</u></h3>
<b><?php echo $_POST['name']; ?></b>
<p>10の質問をご制作いただき、ありがとうございます。</p>
<br/>
<p>10の質問投稿フォームに入力いただいたメールアドレスに、あなたが制作した10の質問を自動返信します。</p>
<p><u>※ 質問投稿後、返信メールが届かなかった場合は、お手数ですが we.are.pe.hu@gmail.com までお問合わせください。</u></p>
<br/>
<p>投稿いただいた10の質問を、このウェブサイトに公開する準備が整いましたら、同じく投稿フォームに入力いただいたメールアドレスまで、ウェブページ公開のお知らせをお送りいたします。</p>
<hr/>
</div>
</div>

<?php else: ?>
<section id="main" class="form">
<form action="" id="10q" method="post">

<div class="ichoose">
<h3><u>Let's Create Your Ideal 10 Questions.</u></h3>
<p>自分が質問されたいこと、嬉しい／楽しい気持ちを持って答えられる質問を考えましょう。</p>
Let’s create questions that you want to be asked and make people feel happy and pleasant while answering questions.<hr/>
<p><i>質問は、自分の興味や性質を他者に簡単に伝えることができる身近な行為です。<br/>
よくある質問だけでは退屈だし、専門的な知識がないと答えられない類の質問や、深層心理を深くえぐる質問だけでは相手を不快にする可能性があります。</i></p>
<p><i>Questioning is the simple way to tell people your interests and your character.<br/>
You need to be careful not to make people feel uncomfortable and bored by asking such as frequently asked questions, questions need expert knowledge and questions hurt the unconscious mind.</i></p>
<p>質問の種類・順番などを工夫し、あなたがされて嬉しい理想の10の質問をここに投稿ください。</p>
<p>Please submit your ideal 10 questions that you would be happy to be asked by thinking well about variety and orders of questions.</p>
</div>

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
<h2 for="q_one">Question 1</h2>
<h2><input id="q_one" type="text" name="q_one" value="<?php if( !empty($_POST['q_one']) ){ echo $_POST['q_one']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left_one" type="text" name="a_left_one" value="<?php if( !empty($_POST['a_left_one']) ){ echo $_POST['a_left_one']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right_one" type="text" name="a_right_one" value="<?php if( !empty($_POST['a_right_one']) ){ echo $_POST['a_right_one']; } ?>" required></p>
</span>
</div>
</div>

<div class="question">
<h2 for="q_two">Question 2</h2>
<h2><input id="q_two" type="text" name="q_two" value="<?php if( !empty($_POST['q_two']) ){ echo $_POST['q_two']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left_two" type="text" name="a_left_two" value="<?php if( !empty($_POST['a_left_two']) ){ echo $_POST['a_left_two']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right_two" type="text" name="a_right_two" value="<?php if( !empty($_POST['a_right_two']) ){ echo $_POST['a_right_two']; } ?>" required></p>
</span>
</div>
</div>

<div class="question">
<h2 for="q_three">Question 3</h2>
<h2><input id="q_three" type="text" name="q_three" value="<?php if( !empty($_POST['q_three']) ){ echo $_POST['q_three']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left_three" type="text" name="a_left_three" value="<?php if( !empty($_POST['a_left_three']) ){ echo $_POST['a_left_three']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right_three" type="text" name="a_right_three" value="<?php if( !empty($_POST['a_right_three']) ){ echo $_POST['a_right_three']; } ?>" required></p>
</span>
</div>
</div>

<div class="question">
<h2 for="q_four">Question 4</h2>
<h2><input id="q_four" type="text" name="q_four" value="<?php if( !empty($_POST['q_four']) ){ echo $_POST['q_four']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left_four" type="text" name="a_left_four" value="<?php if( !empty($_POST['a_left_four']) ){ echo $_POST['a_left_four']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right_four" type="text" name="a_right_four" value="<?php if( !empty($_POST['a_right_four']) ){ echo $_POST['a_right_four']; } ?>" required></p>
</span>
</div>
</div>

<div class="question">
<h2 for="q_five">Question 5</h2>
<h2><input id="q_five" type="text" name="q_five" value="<?php if( !empty($_POST['q_five']) ){ echo $_POST['q_five']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left_five" type="text" name="a_left_five" value="<?php if( !empty($_POST['a_left_five']) ){ echo $_POST['a_left_five']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right_five" type="text" name="a_right_five" value="<?php if( !empty($_POST['a_right_five']) ){ echo $_POST['a_right_five']; } ?>" required></p>
</span>
</div>
</div>

<div class="question">
<h2 for="q_six">Question 6</h2>
<h2><input id="q_six" type="text" name="q_six" value="<?php if( !empty($_POST['q_six']) ){ echo $_POST['q_six']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left_six" type="text" name="a_left_six" value="<?php if( !empty($_POST['a_left_six']) ){ echo $_POST['a_left_six']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right_six" type="text" name="a_right_six" value="<?php if( !empty($_POST['a_right_six']) ){ echo $_POST['a_right_six']; } ?>" required></p>
</span>
</div>
</div>

<div class="question">
<h2 for="q_seven">Question 7</h2>
<h2><input id="q_seven" type="text" name="q_seven" value="<?php if( !empty($_POST['q_seven']) ){ echo $_POST['q_seven']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left_seven" type="text" name="a_left_seven" value="<?php if( !empty($_POST['a_left_seven']) ){ echo $_POST['a_left_seven']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right_seven" type="text" name="a_right_seven" value="<?php if( !empty($_POST['a_right_seven']) ){ echo $_POST['a_right_seven']; } ?>" required></p>
</span>
</div>
</div>

<div class="question">
<h2 for="q_eight">Question 8</h2>
<h2><input id="q_eight" type="text" name="q_eight" value="<?php if( !empty($_POST['q_eight']) ){ echo $_POST['q_eight']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left_eight" type="text" name="a_left_eight" value="<?php if( !empty($_POST['a_left_eight']) ){ echo $_POST['a_left_eight']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right_eight" type="text" name="a_right_eight" value="<?php if( !empty($_POST['a_right_eight']) ){ echo $_POST['a_right_eight']; } ?>" required></p>
</span>
</div>
</div>

<div class="question">
<h2 for="q_nine">Question 9</h2>
<h2><input id="q_nine" type="text" name="q_nine" value="<?php if( !empty($_POST['q_nine']) ){ echo $_POST['q_nine']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left_nine" type="text" name="a_left_nine" value="<?php if( !empty($_POST['a_left_nine']) ){ echo $_POST['a_left_nine']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right_nine" type="text" name="a_right_nine" value="<?php if( !empty($_POST['a_right_nine']) ){ echo $_POST['a_right_nine']; } ?>" required></p>
</span>
</div>
</div>

<div class="question">
<h2 for="q_ten">Question 10</h2>
<h2><input id="q_ten" type="text" name="q_ten" value="<?php if( !empty($_POST['q_ten']) ){ echo $_POST['q_ten']; } ?>" required></h2>

<div id="answer">
<span class="left">
<span>Answer A</span>
<p><input id="a_left_ten" type="text" name="a_left_ten" value="<?php if( !empty($_POST['a_left_ten']) ){ echo $_POST['a_left_ten']; } ?>" required></p>
</span>

<span class="or"><p><i>or</i></p></span>

<span class="right">
<span>Answer B</span>
<p><input id="a_right_ten" type="text" name="a_right_ten" value="<?php if( !empty($_POST['a_right_ten']) ){ echo $_POST['a_right_ten']; } ?>" required></p>
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
<iframe src="faqs.html" frameborder="0">読み込んでいます…</iframe>
</div>
</div>
</body>
</html>
