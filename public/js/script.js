/*
 * Rayban Ambermatic
 * R/GA London 2012.
 * @author Pedro Duarte
==================================================*/

var rgaMakeDay = {};
if (typeof console == 'undefined') console = { log: function(){} };


(function(rgaMakeDay) {

	/**
	Global vars
	*/
	var $body;
	var $players;
	var $player1;
	var $player2;
	var $audio;

	var $removeButton;
	var $resetButton;
	var player1ScoreAudio;
	var player2ScoreAudio;
	var newScore;
	var audioPath;
	var commentary;
 

	/**
	Dom Ready
	*/
	$(function() {
		
		$body = $('body');

		$players = $('.player');
		$player1 = $('#player1');
		$player2 = $('#player2');
	 	 
		$removeButton = $('.remove-btn');
		$resetButton = $('.reset-btn');
		
		audioPath = '/assets/audio/';
		
		commentary = new Array('awesome', 'really_good', 'shit_no_good', 'shit', 'wft', 'come_on', 'your_invincible');

		initGlobal();

	});


	/**
	Global init
	*/
	function initGlobal()
	{
		keyBindings();
	}

	function keyBindings()
	{


		$body.single_double_click(function (e) { // single click
		  

			if (e.keyCode == 37)  // 37 == left  > add / remove point Player 1
			{
				player1Score = parseInt($player1.find('.current').text(), 0);
				player2Score = parseInt($player2.find('.current').text(), 0);
				
				if(player1Score < 21)
				{
					addPoint($player1, player1Score);
				}

				speakScore(
						(player1Score+1), 
						(player2Score)
					);
			 
			}
			if (e.keyCode == 39) // 39 == right > add / remove point Player 2
			{
				player1Score = parseInt($player1.find('.current').text(), 0);
				player2Score = parseInt($player2.find('.current').text(), 0);
				
				if(player2Score < 21)
				{
					addPoint($player2, player2Score);
				}

				speakScore(
						(player1Score), 
						(player2Score+1)
					);
			}
			else if (e.keyCode == 39) // 38 == up > new game / rematch
			{

			}


			


		}, function (e) { // double click
		

			if (e.keyCode == 37)
			{
				player1Score = parseInt($player1.find('.current').text(), 0);
				removePoint($player1, player1Score);

			}
			if (e.keyCode == 39)
			{
				player2Score = parseInt($player2.find('.current').text(), 0);
				removePoint($player2, player2Score);

			}
			else if (e.keyCode == 39)
			{

			}


		});		


		$resetButton.on('click', function() {
			removePoint($players, parseInt($players.find('.current').text(), 0), true);
		});
	}


	function speakScore(score1, score2)
	{
		$('#number-'+score1).get(0).play();
		setTimeout(function(){ $('#number-'+score2).get(0).play();}, 1100);
		setTimeout(function(){ $('#commentary-'+randomCommentary()).get(0).play();}, 2200);
	}



	function randomCommentary()
	{
		var randomCommentary = commentary[Math.floor(Math.random()*commentary.length)];
		return randomCommentary;
	}



	function addPoint(aoPlayer, anPlayerScore)
	{
		if (!aoPlayer.find('.score').hasClass('flipped'))
		{
			aoPlayer.find('.number').removeClass('current');
			aoPlayer.find('.back').text(anPlayerScore + 1).addClass('current');
			aoPlayer.find('.score').addClass('flipped');
		}
		else
		{
			aoPlayer.find('.number').removeClass('current');
			aoPlayer.find('.front').text(anPlayerScore + 1).addClass('current');
			aoPlayer.find('.score').removeClass('flipped');
		}
	}

	function removePoint(aoPlayer, anPlayerScore, abResetScore)
	{

		if (anPlayerScore > 0)
		{
			aoPlayer.find('.number').removeClass('current');

			if (!abResetScore)
			{
				newScore = anPlayerScore - 1;
			}
			else
			{
				newScore = 0;
			}

			if (!aoPlayer.find('.score').hasClass('flipped'))
			{
				aoPlayer.find('.back').text(newScore).addClass('current');
				aoPlayer.find('.score').addClass('flipped');
			}
			else
			{
				aoPlayer.find('.front').text(newScore).addClass('current');
				aoPlayer.find('.score').removeClass('flipped');
			}

		}
	}




})(rgaMakeDay);


/* Detect Double Click function */
jQuery.fn.single_double_click = function(single_click_callback, double_click_callback, timeout) {
  return this.each(function(){
    var clicks = 0, self = this;
    jQuery(this).keyup(function(event){
      clicks++;
      if (clicks == 1) {
        setTimeout(function(){
          if(clicks == 1) {
            single_click_callback.call(self, event);
          } else {
            double_click_callback.call(self, event);
          }
          clicks = 0;
        }, timeout || 300);
      }
    });
  });
}
