<!doctype html>
<head>
	<title>test harness stuff</title>
</head>
<body>
	<h3>Join the queue</h3>
	<form action="/index.php/text/receive" method="post" id="test">
		<br>Number <input type="text" name="number" id="number" value="+447403061588">
		<br>Text <input type="text" name="text" id="text" value="maracuja">
		<br><input type="submit">
	</form>

	<hr>
	<h3>Add everyone</h3>
	<a href="#" id="addall">Add everyone</a>

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
	<h3>Clear everything</h3>
	<a href="/index.php/test/clear_all" id="clear_all">This will delete everything</a>

	<script src="/js/jquery-1.8.2.min.js"></script>
	<script>
		var allofus = [
			{ "name" : "maracuja", "number" : "447403061588" },
			{ "name" : "loopdream", "number" : "447900905138" },
			{ "name" : "amorini", "number" : "447729112804" },
			{ "name" : "Zimon14", "number" : "447586757018" },
			{ "name" : "surdeco", "number" : "447896229505" },
			{ "name" : "Pippyduck", "number" : "447803725141" },
			{ "name" : "", "number" : "" },
		]

		$(document).ready(function(){
			$('#test').submit(function(e) {
				$.ajax(
					$(this).attr('action'),
					{
						"data" : "number=" + $('#number').val() + "&text=" + $('#text').val(),
					}
				);
				e.preventDefault();
			});

			$('#addall').click(function (e) {
				for (var i=0; i < allofus.length; i++)
				{
					if (allofus[i]['name'] != '')
					{
						$.ajax(
							$('#test').attr('action'),
							{
								"data" : "number=" + allofus[i]['number'] + "&text=" + allofus[i]['name'],
							}
						);
					}
				}
				e.preventDefault();
			});

			$('#create_a_game').click(function (e) {
				$.ajax(
					$(this).attr('href')
				);
				e.preventDefault();
			});

			$('#clear_all').click(function (e) {
				$.ajax(
					$(this).attr('href')
				);
				e.preventDefault();
			});

			$('.finish_game').click(function (e) {
				$.ajax(
					$(this).attr('href')
				);
				e.preventDefault();
			});
		});
	</script>
</body>
</html>