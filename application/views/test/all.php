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

	<a href="#" id="addall">Add everyone</a>

	<hr>
	<h3>People waiting</h3>
	<ul>
	<? foreach ($waiting_users as $user): ?>
		<li><img src="<?=$user->twitter_avatar?>"> <?=$user->twitter_name?></li>
	<? endforeach; ?>
	</ul>

	<hr>
	<h3>Create a game</h3>
	<a href=""></a>

	<hr>

	<script src="/js/jquery-1.8.2.min.js"></script>
	<script>
		var allofus = [
			{ "name" : "maracuja", "number" : "447403061588" },
			{ "name" : "loopdream", "number" : "447900905138" },
			{ "name" : "", "number" : "" },
			{ "name" : "", "number" : "" },
			{ "name" : "", "number" : "" },
			{ "name" : "", "number" : "" },
			{ "name" : "", "number" : "" },
			{ "name" : "", "number" : "" },
			{ "name" : "", "number" : "" },
			{ "name" : "", "number" : "" },
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
		});
	</script>
</body>
</html>