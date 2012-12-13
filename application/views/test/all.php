<!doctype html>
<head>
	<title>test harness stuff</title>
</head>
<body>
	<hr>
	<h3>Current Game</h3>
	<? if ($game): ?>
		<ul>
			<li><img src="<?=$p1->twitter_avatar?>"> <?=$p1->twitter_name?> - <a href="/index.php/game/finish/21/10" class="finish_game">p1 wins</a></li>
			<li><img src="<?=$p2->twitter_avatar?>"> <?=$p2->twitter_name?> - <a href="/index.php/game/finish/10/21" class="finish_game">p2 wins</a></li>
		</ul>
	<? else: ?>
		<p>No game in progress - 
		<a href="/index.php/game/start" id="create_a_game">This link will create a game</a></p>
	<? endif; ?>

	<hr>
	<h3>People waiting</h3>
	<ul>
	<? foreach ($waiting_users as $user): ?>
		<li><img src="<?=$user->twitter_avatar?>"> <?=$user->twitter_name?></li>
	<? endforeach; ?>
	</ul>

	<hr>
	<h3>Add Us all to the queue</h3>
	<a href="/index.php/test/add_queue" id="create_a_game">This will add us all to the queue</a></p>

	<hr>
	<h3>Clear everything</h3>
	<a href="/index.php/test/clear_all" id="clear_all">This will delete everything</a>

	<script src="/js/jquery-1.8.2.min.js"></script>
	<script>
		$(document).ready(function(){
			$('a').click(function (e) {
				$.ajax(
					$(this).attr('href')
				);
				e.preventDefault();
			});
		});
	</script>
</body>
</html>