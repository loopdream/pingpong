<!doctype html>
<head>
	<title>test harness stuff</title>
</head>
<body>
	<form action="/index.php/text/receive" method="post" id="test">
		<br>Number <input type="text" name="number" id="number" value="+447403061588">
		<br>Text <input type="text" name="text" id="text" value="maracuja">
		<br><input type="submit">
	</form>

	<script src="/js/jquery-1.8.2.min.js"></script>
	<script>
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
		});
	</script>
</body>
</html>