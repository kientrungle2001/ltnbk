<?php
	$userId = 0;
	if(isset($_SESSION['userId'])){
		$userId = $_SESSION['userId'];
	}
	$documentId = $_POST['documentId'];
	$gameCode = $_POST['gameType'];
	$cateId = $_POST['cateId'];

	$dataWords = $_POST['dataWords'];
	
	if($dataWords != FALSE) {
		$allWords = array();
		foreach($dataWords as $val) {
			$allWords[] = $val['trueWord'];
		}
		$allWords = json_encode($allWords);
		$allStage = count($dataWords);
		shuffle($dataWords);
		$jsonDataWords = json_encode($dataWords);
		
?>
<script>
	BASE_URL = 'http://s1.nextnobels.com/';
</script>
<style type="text/css">
	.picture-board {
		position: 	relative;
		float: left;
		width: 50%;
		margin: 15px 25%;
		
	}
	.selected {
		border: 1px solid red;
	}
	#fillWord{
		text-align: center;
		margin-bottom: 15px;
	}
	.alertVdt{
		width: 200px !important;
		margin: 0px auto 8px auto;
		padding: 5px 10px;
		color: #3c763d;
		background-color: #dff0d8;
		text-align:center;
		font-weight:bold;
		border-radius: 3px;
	}
	.inputvdt{
		margin: 10px 25%;
		width: 50%;
		height: 45px;
		padding: 3px 12px;
		font-size: 25px;
		color: #555;
		background-color: #fff;
		background-image: none;
		border: 1px solid #ccc;
		border-radius: 4px;
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
		-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
		transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
	}
</style>

<div class='alert alert-info mgb0'>
	Listen to the speakers and write down words in the box.
</div>
	
	<style>
		#fillWord {
			background: url('http://s1.nextnobels.com/default/skin/test/game/images/game5.png');
			height: 600px;
		}
	</style>
<div class='item' id="fillWord">
	
</div>

	<script type="text/javascript">
	
	
	FillWord = {
		maxStage: <?php echo $allStage;?>,
		stage: 0,
		score: 0,
		question_audios: {},
		current_sound: null,
		current_sound_url: null,
		trueWords: [],
		dataWords: <?php echo $jsonDataWords; ?>,
		startGame: function() {
			if(this.stage == this.maxStage) {
				that = this;
				endStage = this.maxStage -1;
				href = this.dataWords[endStage].href;
				if(typeof question_audios[href] != 'undefined') {
					current_sound = question_audios[href]; 
					current_sound.pause();
					current_sound.onended();
					current_sound.currentTime = 0;
				}
				jQuery.ajax({
					method: "post",
					url: "/game/saveGameVocabunary",
					data: { score: that.score, trueWords: that.trueWords, cateId:<?php echo $cateId; ?>, documentId: <?php echo $documentId; ?>, totalWord: <?php echo $allStage; ?>, gameCode:'<?php echo $gameCode;?>'},
					
				});
				var wrongWords = jQuery(<?php echo $allWords; ?>).not(this.trueWords).get();
				jQuery('#fillWord').empty();
				jQuery('#fillWord').append('<br><div class="alert alert-success"><b>Finish game!</b><br>Correct answers:<b> '+this.score+' / '+ this.maxStage+'</b></br><p>Correct words: '+this.trueWords.join(', ')+'</p><p>Wrong words: '+wrongWords.join(', ')+'</p></div>');
				
				
			}else{
				href = this.dataWords[this.stage].href;
				hreffix = this.dataWords[this.stage].hreffix;
				trueWord = this.dataWords[this.stage].trueWord;
				this.buildGame(href, trueWord);
				$thisspan = jQuery('#fillWord span');
				this.read_question($thisspan, href);
				//this.prevGame(href);
				this.nextGame(href);
			}	
		},
		buildGame: function(href, trueWord) {
			jQuery('#fillWord').append('<span class="btn btn-primary fa fa-volume-up" onclick="FillWord.read_question(this, \''+hreffix+'\');return false;"></span></br>');
			jQuery('#fillWord').append('<input class="inputvdt" rel='+escape(trueWord)+' onblur="return FillWord.checkFillWord(this, \''+hreffix+'\'); return false;" type="text" /></br> <p class="alertVdt " style="display:none;"></p>');
			
		},
		
		read_question: function(elem, url) {
			if(this.current_sound) {
				this.current_sound.pause();
				this.current_sound.currentTime = 0;
				this.current_sound.onended();
			}
			if(this.current_sound_url == url) {
				jQuery(elem).removeClass('fa-volume-up').addClass('fa-volume-off');
				this.current_sound_url = null;
				sound = this.question_audios[url]; 
				sound.play();
				sound.onended = function() {
					jQuery(elem).removeClass('fa-volume-off').addClass('fa-volume-up');
				};
				return ;
			} else {
				this.current_sound_url = url;
			}
			jQuery(elem).removeClass('fa-volume-up').addClass('fa-volume-off');
			if(typeof this.question_audios[url] == 'undefined') {
				sound = new Audio(url);
				sound.loop = false;	
				this.question_audios[url] = sound;
				sound.onended = function() {
					jQuery(elem).removeClass('fa-volume-off').addClass('fa-volume-up');
				};
			}
			this.current_sound = this.question_audios[url];
			this.question_audios[url].play();
		},
		
		
		nextGame: function() {
			jQuery('#fillWord').append('<button class="btn btn-success">Submit</button> <button class="btn btn-warning" onclick="FillWord.nextStage()">Skip</button>');
		},
		prevGame: function() {
			jQuery('#fillWord').append('<button onclick="FillWord.prevStage()">Prev</button>');
		},
		setNextStage: function() {
			this.stage = this.stage +1;
		},
		setPrevStage: function() {
			this.stage = this.stage -1;
		},
		clearBoad: function() {
			jQuery('#fillWord').empty();
		},
		setScore: function() {
			this.score = this.score + 1;
		},
		setTrueWords: function(word) {
			this.trueWords.push(word); 
		},
		checkFillWord: function (that, url){
			that2 = this;
			
			userInput = jQuery(that).val();
			if(userInput != '') {
				userInput = userInput.toLowerCase();
				userInput = escape(userInput);
				trueWord = jQuery(that).attr('rel');
				if(userInput == trueWord) {
					jQuery(that).prop('disabled', true);
					//load audio true
					sound = new Audio('/assets/audio/Game-Spawn.mp3');
					sound.loop = false;	
					sound.play();
					if(typeof this.question_audios[url] != 'undefined') {
						current_sound = this.question_audios[url]; 
						current_sound.pause();
						current_sound.onended();
						current_sound.currentTime = 0;
					}
					jQuery('input.inputvdt').css('border', 'solid 1px blue');
					jQuery('p.alertVdt').css('background-color', '#dff0d8');
					jQuery('p.alertVdt').html('Correct!');
					jQuery('p.alertVdt').show();
					setTimeout(function(){ 
						jQuery('p.alertVdt').hide();
						that2.setNextStage();
						that2.setScore();
						that2.setTrueWords(unescape(userInput));
						that2.clearBoad();
						that2.startGame();
					}, 2000);
					
				}else {
					sound = new Audio('/assets/audio/Game-Break.mp3');
					sound.loop = false;	
					sound.play();
					if(typeof this.question_audios[url] != 'undefined') {
						current_sound = this.question_audios[url]; 
						current_sound.pause();
						current_sound.onended();
						current_sound.currentTime = 0;
					}
					
					jQuery('input.inputvdt').css('border', 'solid 1px red');
					jQuery('p.alertVdt').css('background-color', '#ec971f');
					jQuery('p.alertVdt').html('Wrong! Try again!');
					jQuery('p.alertVdt').show();
					setTimeout(function(){ 
						jQuery('p.alertVdt').hide();
					}, 2000);
				}
			}
		},
		nextStage: function (url) {
			if(typeof this.question_audios[url] != 'undefined') {
				current_sound = this.question_audios[url]; 
				current_sound.pause();
				current_sound.onended();
				current_sound.currentTime = 0;
			}
					
			this.setNextStage();
			this.clearBoad();
			this.startGame();
		},
		prevStage: function (url) {
			if(typeof this.question_audios[url] != 'undefined') {
						current_sound = this.question_audios[url]; 
						current_sound.pause();
						current_sound.onended();
						current_sound.currentTime = 0;
					}
					
					this.setPrevStage();
					this.clearBoad();
					this.startGame();
		}
		
		
	};
	
	jQuery(function() {
		FillWord.startGame();

	});
	
	</script>
	<?php } else { ?>
		Chưa có dữ liệu
	<img class='item' src="http://s1.nextnobels.com/default/skin/nobel/test/themes/default/media/bg_game.jpg" />
	<?php } ?>