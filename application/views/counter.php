<!DOCTYPE HTML>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>R/GA Make Day 2012</title>

		<link type="text/css" rel="stylesheet" href="css/reset.css">
		<link type="text/css" rel="stylesheet" href="css/style.css">

		<!-- <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'> -->
		<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:300' rel='stylesheet' type='text/css'>


		<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
	</head>


	<body>
		
		<img src="images/logo.png" id="logo">
		<div id="tweeted">Game result was tweeted!</div>
		<div id="scores">

			<div id="player1" class="player">
		
				<div class="score-card">
					<span class="score">
						<span class="number front current"><?=$game->p1_score?></span>
						<span class="number back next"><?=$game->p1_score?></span>
					</span>
					 
				</div>
	 			<div class="player-name">
	 					<span style="background-image: url(<?=$p1->twitter_avatar?>);">@<?=$p1->twitter_name?></span>
				</div>
			</div>
	
			<div id="player2" class="player">
			
				<div class="score-card">
					<span class="score">
						<span class="number front current"><?=$game->p2_score?></span>
						<span class="number back next"><?=$game->p2_score?></span>
					</span>
					 
				</div>
				
									
				<div class="player-name">
						<span style="background-image: url(<?=$p2->twitter_avatar?>);">@<?=$p2->twitter_name?></span>
				</div>
				 
			</div>	
					
		</div>
		

	
		<div id="player-queue">
			
			<ul>

			</ul>
			
		</div>
		
		
		
		
		<audio id="number-0" src="audio/0.mp3">
		<audio id="number-1" src="audio/1.mp3">
		<audio id="number-2" src="audio/2.mp3">
		<audio id="number-3" src="audio/3.mp3">
		<audio id="number-4" src="audio/4.mp3">
		<audio id="number-5" src="audio/5.mp3">
		<audio id="number-6" src="audio/6.mp3">	
		<audio id="number-7" src="audio/7.mp3">
		<audio id="number-8" src="audio/8.mp3">
		<audio id="number-9" src="audio/9.mp3">
		<audio id="number-10" src="audio/10.mp3">
		<audio id="number-11" src="audio/11.mp3">
		<audio id="number-12" src="audio/12.mp3">	
		<audio id="number-13" src="audio/13.mp3">
		<audio id="number-14" src="audio/14.mp3">
		<audio id="number-15" src="audio/15.mp3">
		<audio id="number-16" src="audio/16.mp3">
		<audio id="number-17" src="audio/17.mp3">
		<audio id="number-18" src="audio/18.mp3">
		<audio id="number-19" src="audio/19.mp3">		
		<audio id="number-20" src="audio/20.mp3">
		<audio id="number-21" src="audio/21.mp3">
		 
		
		<audio id="commentary-shit" src="audio/shit.mp3">
		<audio id="commentary-awesome" src="audio/awesome.mp3">
		<audio id="commentary-really_good" src="audio/really_good.mp3">
		<audio id="commentary-shit_no_good" src="audio/shit_no_good.mp3">
		<audio id="commentary-wft" src="audio/wft.mp3">
		<audio id="commentary-come_on" src="audio/come_on.mp3">
		<audio id="commentary-game_on" src="audio/game_on.mp3">
		<audio id="commentary-youre_invincible" src="audio/youre_invincible.mp3">
		<audio id="gong" src="audio/gong.mp3">
		<audio id="church-bell" src="audio/church-bell.mp3">
		
</audio>

		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.flipCounter.1.2.pack.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script>
			var currently_playing = <?=($waiting == false) ? 'true' : 'false' ?>
		</script>

	</body>

</html>