<?php
$userId = 0;
if(isset($_SESSION['userId'])){
	$userId = $_SESSION['userId'];
}
$documentId = $_POST['documentId'];
$gameCode = $_POST['gameType'];
$cateId = $_POST['cateId'];

if(is_string($_POST['dataWords'])){
	$words = json_decode($_POST['dataWords']);
}else{
	$words = $_POST['dataWords'];
}

//$words = $data->getWords();
$allWords = array();
foreach($words as $val) {
	$allWords[] = $val[0];
}
$allWords = json_encode($allWords);

if(count($words) > 0){
 ?>

<script src="/assets/js/jquery-ui.js"></script> 
 
<div class='alert alert-info'>
    Click on the word you choose in order or drag from below into the box above.
</div>
		
<style>
.character-cell, .input-cell {
	width: 			80px;
	height: 		80px;
	display: 		block;
	margin-right: 	20px;
	border: 		5px solid black;
	border-radius: 	10px;
	text-align: 	center;
	float: 			none;
	display:		inline-block;
	line-height: 	100%;
	margin-top: 	10px;
}
.character {
	line-height: 	100%;
	padding:		30px;
	width: 			70px;
	height: 		70px;
	border: 		1px solid black;
	cursor: 		pointer;
	font-weight:	bold;
}

.character-cell, .input-cell {
    width: 			50px;
	height: 		50px;
	margin-right:	5px;
	border:			2px solid black;
}
.character {
	width: 			46px;
	height: 		46px;
	padding:		10px;
}

@media (min-width: 480px) { 
.character-cell, .input-cell {
    width: 			50px;
	height: 		50px;
	margin-right:	5px;
	border:			2px solid black;
}
.character {
	width: 			46px;
	height: 		46px;
	padding:		10px;
}}

@media (min-width: 768px) { 
.character-cell, .input-cell {
    width: 			60px;
	height: 		60px;
	margin-right:	10px;
	border:			3px solid black;
}
.character {
	width: 			55px;
	height: 		55px;
	padding:		15px;
}}
@media (min-width: 992px) { 
.character-cell, .input-cell {
    width: 			70px;
	height: 		70px;
	margin-right:	15px;
	border:			4px solid black;
}
.character {
	width: 			62px;
	height: 		62px;
	padding:		20px;
}}
@media (min-width: 1200px) { 
.character-cell, .input-cell {
    width: 			80px;
	height: 		80px;
	margin-right:	20px;
	border:			5px solid black;
}
.character {
	width: 			70px;
	height: 		70px;
	padding:		30px;
}}

#character-board {
	margin-top: 	30px;
}
.clear {
	clear: both;
}
#board {
	width: 			100%;
	margin: 		0 auto;
}

#input-board, #character-board, #navigation-board {
	margin: 		0 auto;
	margin-top: 	30px;
	width: 			260px;
	text-align:		center;
}

@media (min-width: 768px) { 
#input-board, #character-board, #navigation-board {
	width:			800px;
}
}
</style>

<div id="game">
		<div id="player"></div>
		<div id="point"></div>
		<div id="live"></div>
		<div id="timing"></div>
		<div id="board">
			<div id="image-board">
				<img id="game-image" src="" />
			</div>
			<div id="input-board">
				<div class="input-cell"></div>
				<div class="input-cell"></div>
				<div class="input-cell"></div>
				<div class="input-cell"></div>
				<div class="input-cell"></div>
				<div class="clear"></div>
			</div>
			<div id="character-board">
				<div class="character-cell">
					<div class="character">
						A
					</div>
				</div>
				<div class="character-cell">
					<div class="character">
						P
					</div>
				</div>
				<div class="character-cell">	
					<div class="character">
						P
					</div>
				</div>
				<div class="character-cell">
					<div class="character">
						L
					</div>
				</div>
				<div class="character-cell">
					<div class="character">
						E
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div id="navigation-board" class="text-center">
				<!--a href="#" class="btn btn-default" onclick="prevGame(); return false;">Previous</a-->
				<a href="#" class="btn btn-warning" onclick="nextGame(); return false;">Skip</a>
				<br /><br />
			</div>
		</div>
		
	</div>
	<script type="text/javascript">
	
	// word dang chay
	var word = null;
	var gameImage = null;
	var trueWords = [];
	// khoi tao game
	function initGame(w) {
		word = w[0];
		gameImage = w[1];
		var chars = [];
		for(var i = 0; i < word.length; i++) {
			chars.push(word[i]);
		}
		chars.shuffle();
		var characterHtml = '';
		for(var i = 0; i < chars.length; i++) {
			characterHtml += '<div class="character-cell"><div class="character">' + chars[i] + '</div></div>';
		}
		characterHtml += '<div class="clear"></div>';
		jQuery('#character-board').html(characterHtml);
		var inputHtml = '<div class="input-cell"></div>'.repeat(chars.length);
		inputHtml += '<div class="clear"></div>';
		jQuery('#input-board').html(inputHtml);
		/*
		var maxLength = (chars.length * 100);
		if(maxLength > 600) {
			maxLength = 600;
		}
		jQuery('#input-board').width(maxLength + 'px');
		jQuery('#character-board').width(maxLength + 'px');
		*/
		jQuery('#image-board').html(gameImage);
		// if(mobilecheck()) {
		// 	jQuery('#image-board').find('img').addClass('img-responsive');
		// }
		
		// khoi tao su kien
		initEvents();
	
	}
	
	// keo tha
	function initEvents() {
	
		jQuery( ".character").draggable({
		  cancel: "a.ui-icon", // clicking an icon won't initiate dragging
		  revert: "invalid", // when not dropped, the item will revert back to its initial position
		  containment: "document",
		  helper: "clone",
		  cursor: "move"
		});
		
		jQuery(".input-cell, .character-cell").droppable({
		  accept: ".character",
		  activeClass: "ui-state-highlight",
		  drop: function( event, ui ) {
			moveCharater(this, ui.draggable );
		  }
		});
		
		jQuery( ".character").click(function() {
			var $self = jQuery(this);
			if($self.parent().hasClass('input-cell')) {
				jQuery('.character-cell:empty:first').append($self);
			} else if($self.parent().hasClass('character-cell')) {
				jQuery('.input-cell:empty:first').append($self);
				checkFinish();
			}
		});
	
	}
	
	// tha vao
	function moveCharater(target, elem) {
		if(jQuery(target).children().length == 0) {
			jQuery(target).append(elem);
		}
		checkFinish();
	}
	finishListeners = [];
	totalFinished = 0;
	// kiem tra xem da ket thuc chua
	function checkFinish () {
		var result = jQuery('#input-board').text();
		if(result == word) {
			//load audio true
			sound = new Audio('/assets/audio/Game-Spawn.mp3');
			sound.loop = false;	
			sound.play();
			jQuery('#input-board .input-cell').css('border-color', 'green');
			for(var i = 0; i < finishListeners.length; i++) {
			
				// xem co su kien gi xay ra khong
				finishListeners[i]();
			}
			totalFinished++;
			trueWords.push(word);
		} else if(result.length == word.length) {
			//load audio false
			sound = new Audio('/assets/audio/Game-Break.mp3');
			sound.loop = false;	
			sound.play();
			jQuery('#input-board .input-cell').css('border-color', 'red');
		} else {
			jQuery('#input-board .input-cell').css('border-color', 'black');
		}
	}
	// shuffle
	Array.prototype.shuffle = function() {
	  var i = this.length, j, temp;
	  if ( i == 0 ) return this;
	  while ( --i ) {
		 j = Math.floor( Math.random() * ( i + 1 ) );
		 temp = this[i];
		 this[i] = this[j];
		 this[j] = temp;
	  }
	  return this;
	}
	
	var words = [['APPLE', 'http://s1.nextnobels.com/3rdparty/Filemanager/source/apple.jpg'], ['MANGO', 'http://s1.nextnobels.com/3rdparty/Filemanager/source/mango.jpg'], ['BANANA', 'http://s1.nextnobels.com/3rdparty/Filemanager/source/banana.jpg']];
	words = <?php echo json_encode($words);?>;
	wordIndex = 0;
	words.shuffle();
	initGame(words[wordIndex]);
	finishListeners.push(function() {
		nextGame();
	});
	
	function nextGame() {
		setTimeout(function() {
			if(wordIndex == words.length - 1) {
				
				
				var documentId = "<?php echo $documentId; ?>";
				var gameCode = "<?php echo $gameCode; ?>";
				var totalWord = words.length;
				var score = trueWords.length;
				var cateId = "<?php echo $cateId; ?>";
				var wrongWords = jQuery(<?php echo $allWords; ?>).not(trueWords).get();
				var userId = <?=$userId;?>;
				jQuery.ajax({
					type: "Post",
					data:{score:score,  userId: userId, totalWord: totalWord, cateId: cateId, trueWords: trueWords, documentId:documentId, gameCode:gameCode},
					url: FL_API_URL+'/game/saveGameVocabunary',
					dataType: 'json',
					success: function(data){
						jQuery('#board').html('<h4>Finish Game: '+totalFinished + '/' + words.length +' mission completed!</h4><br /><h4>True words: '+trueWords.join(', ')+'</h4><br /><h4>Wrong words: '+wrongWords.join(', ')+'</h4>');
					}
				});
				return false;
			}
			wordIndex++;
			initGame(words[wordIndex]);	
		}, 1500);
		
	}
	function prevGame() {
		setTimeout(function() {
			if(wordIndex == 0) return false;
			wordIndex--;
			initGame(words[wordIndex]);
		}, 1500);
	}
	</script>
	
	
	
	<?php }else { ?>
	Chưa có dữ liệu
	<img class='item' src="<?php echo BASE_URL; ?>/Default/skin/nobel/test/themes/default/media/bg_game.jpg" />
<?php } ?>