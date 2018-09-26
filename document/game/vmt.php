<?php 
        $userId = 0;
        if(isset($_SESSION['userId'])){
            $userId = $_SESSION['userId'];
        }
        $curentPage = $_POST['page'];

        $documentId = $_POST['documentId'];
        $gameCode = $_POST['gameType'];
        $cateId = $_POST['cateId'];

        if(is_string($_POST['dataWords'])){
            $dataWords = json_decode($_POST['dataWords']);
        } else{
            $dataWords =$_POST['dataWords'];
        }
	
		if($dataWords != '') {
			$allTrueWords = array();
			foreach($dataWords as $val){
                if(is_array($val)){
                    $allTrueWords[] = $val['trueWord'];
                }else{
                    $allTrueWords[] = $val->trueWord;
                }
				
			}
			
		$countStage = count($dataWords);
		
		$page = $curentPage- 1;
		
		if(is_array($dataWords[$page])){
            $allwords = $dataWords[$page]['allWords'];
        }else{
            $allwords = $dataWords[$page]->allWords;
        }
		
		shuffle($allwords);
        $jsallwords = json_encode($allwords);
        
        if(is_array($dataWords[$page])){
            $srcimg = $dataWords[$page]['img'];
        }else{
            $srcimg = $dataWords[$page]->img;
        }
       
        
        if(is_array($dataWords[$page])){
            $trueword = $dataWords[$page]['trueWord'];
        }else{
            $trueword = $dataWords[$page]->trueWord;
        }
		
		
		
		?>
        <script src="/assets/js/createjs-2015.05.21.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <script>
            BASE_URL = "http://s1.nextnobels.com";
            function TextLink(text, font, color, hoverColor) {
                // this super class constructor reference is automatically created by createjs.extends:
                this.Text_constructor(text, font, color);
                this.hoverColor = hoverColor;
                this.hover = false;
                this.hitArea = new createjs.Shape();
                this.textBaseline = "top";

                this.addEventListener("rollover", this);
                this.addEventListener("rollout", this);
            }
            createjs.extend(TextLink, createjs.Text);

            // use the same approach with draw:
            TextLink.prototype.draw = function (ctx, ignoreCache) {
                // save default color, and overwrite it with the hover color if appropriate:
                var color = this.color;
                if (this.hover) {
                    this.color = this.hoverColor;
                }

                // call Text's drawing method to do the real work of drawing to the canvas:
                // this super class method reference is automatically created by createjs.extends for methods overridden in the subclass:
                this.Text_draw(ctx, ignoreCache);

                // restore the default color value:
                this.color = color;

                // update hit area so the full text area is clickable, not just the characters:
                this.hitArea.graphics.clear().beginFill("#FFF").drawRect(0, 0, this.getMeasuredWidth(), this.getMeasuredHeight());
            };

            // set up the handlers for mouseover / out:
            TextLink.prototype.handleEvent = function (evt) {
                this.hover = (evt.type == "rollover");
            };

            // set up the inheritance relationship: TextLink extends Text.
            createjs.promote(TextLink, "Text");

            

            RainWord = {
                canvas: null,
                stage: null,
                //loader bar
                WALL_THICKNESS: 15,
                SCORE_BOARD_HEIGHT: 40,
                
                live: 3,
                score: 0,
                scoreTxt: null,
                livesTxt: null,
				text: [],
                
                bitmap: null,
                
				textTrue: '<?php echo $trueword; ?>',
				allWords: <?php echo $jsallwords; ?>,
				srcimg: '<?php echo $srcimg; ?>',
				
				
				txtMes: null,
				prev: false,
				next: false,
				
                end:false,
                
                //start
                start: false,
                
                init: function() {
                    
                    this.canvas = document.getElementById('canvas');
                    this.stage = new createjs.Stage(this.canvas);
                    this.stage.enableMouseOver(40);

                    this.stage.addChild(this.bitmap);
                    this.preload();
                    this.insSoundBg();

                    var data = {
                        images: [BASE_URL+"/Default/skin/test/game/art/spritesheet_sparkle.png"],
                        frames: {width: 21, height: 23, regX: 10, regY: 11}
                    };

                    //this.buildWalls();
                    // set up an animation instance, which we will clone
                    this.sprite = new createjs.Sprite(new createjs.SpriteSheet(data));

                    this.display();
                    // start the tick and point it at the window so we can do some work before updating the stage:

                },
				startGame: function() {
						this.init();
						this.buildMessageBoard();
                        this.bitmap = new createjs.Bitmap(BASE_URL+"/Default/skin/test/game/images/gamemt.png");
                        this.bitmap.x = 0;
                        this.bitmap.y = 40;
                        this.stage.addChild(this.bitmap);
				        this.soundTrue();
						this.soundFalse();
						
						var pageGame = jQuery('#pageGame').val();
						this.reloadPage();
						if(pageGame < <?php echo $countStage; ?>) {
							this.nextPage();
						
						}
						if(pageGame > 1) {
							this.previewPage();
						}
						
						this.drawImg();
						this.rainWord();
                        this.display();
				},
                //display
                display: function() {
                    var that = this;
                    createjs.Ticker.setFPS(60);
                    createjs.Ticker.addEventListener("tick", function (e) {
                        
                        if (!that.end) {
                            // Actions carried out when the Ticker is not paused.
                            if(that.live == 0) {
                                that.end = true;
                                that.endGame();

                            }
                            that.stage.update();
                        }
                        
                    });
                },
				drawImg: function() {
					
					img = new createjs.Bitmap(this.srcimg);
				
					
					
					img.x = 330;
					img.y = 40;
					
					//var targetWidth = 300; 
					//var targetHeight = 150; 
					//img.scaleX = targetWidth / img.image.width; 
					//img.scaleY = targetHeight / img.image.height; 
					img.scaleX = 0.7; 
					img.scaleY = 0.7; 
					
					
					this.stage.addChild(img);
					this.stage.update();
				},
				createLabel: function(text, x, y) {
					var label = new createjs.Text(text, "bold 14px Open Sans", "#305958");
					label.name = "label";
					label.textAlign = "center";
					label.textBaseline = "middle";
					label.x = x;
					label.y = y;
					return label;
				},
				createButton: function(color, x, y, z, name) {
					var background = new createjs.Shape();
					background.name = name;
					background.graphics.beginFill(color).drawRoundRect(0, 0, x, y, z);
					return background;
				},
				nextPage: function() {
				var background = this.createButton("#c6dfe9", 80, 32, 10, "background");
				var label = this.createLabel("Next", 40, 16);

				button = new createjs.Container();
				button.name = "page 1";
				button.x = 500;
				button.y = 490;
				button.page = 1;
				button.addChild(background, label);
				button.addEventListener('click', function(event){
					that = this;
					var pageGame = jQuery('#pageGame').val();
					pageGame ++;
					jQuery('#pageGame').val(pageGame);
					if(pageGame < <?php echo $countStage+1; ?>){
						if (typeof timer != 'undefined') {
							timer.stopCount();
						}
						var documentId = <?= $documentId;?>;
						var gameType = '<?= $gameCode;?>';
						var cateId = <?= $cateId; ?>;
						var dataWords = '<?php echo json_encode($dataWords); ?>';
						jQuery.ajax({
							type: "Post",
							data: {documentId:documentId, gameType:gameType, cateId:cateId, dataWords: dataWords, page: pageGame},
							url:'/document/game/vmt.php',
							success: function(data){
								jQuery("#resGame").html(data);
							}
						});
					
					}else {
						alert('khong con');
						that.stage.removeChild(this);
					}
				});
				this.next = button;
				this.stage.addChild(button);
			},
			reloadPage: function() {
				
				var background = this.createButton("#c6dfe9", 80, 32, 10, "background");
				var label = this.createLabel("Replay", 40, 16);

				button = new createjs.Container();
				button.name = "page 1";
				button.x = 270;
				button.y = 490;
				button.page = 1;
				button.addChild(background, label);
				button.addEventListener('click', function(event){
					that = this;
					var pageGame = jQuery('#pageGame').val();
					if(pageGame < <?php echo $countStage+1; ?>){
						if (typeof timer != 'undefined') {
							timer.stopCount();
						}
						var documentId = <?= $documentId;?>;
						var gameType = '<?= $gameCode;?>';
						var cateId = <?= $cateId; ?>;
						var dataWords = '<?php echo json_encode($dataWords); ?>';
						jQuery.ajax({
							type: "Post",
							data: {documentId:documentId, gameType:gameType, cateId:cateId, dataWords: dataWords, page: pageGame},
							url:'/document/game/vmt.php',
							success: function(data){
								jQuery("#resGame").html(data);
							}
						});
					
					}else {
						alert('khong con');
						that.stage.removeChild(this);
					}
				});
				this.next = button;
				this.stage.addChild(button);
			},
			previewPage: function() {

				var background = this.createButton("#c6dfe9", 80, 32, 10, "background");
				var label = this.createLabel("Prev", 40, 16);

				button = new createjs.Container();
				button.name = "page 1";
				button.x = 380;
				button.y = 490;
				button.page = 1;
				button.addChild(background, label);
				button.addEventListener('click', function(event){
					var pageGame = jQuery('#pageGame').val();
					pageGame --;
					jQuery('#pageGame').val(pageGame);
					//page = pageGame;
					if (typeof timer != 'undefined') {
                        timer.stopCount();
                    }
                    var documentId = <?= $documentId;?>;
                    var gameType = '<?= $gameCode;?>';
                    var cateId = <?= $cateId; ?>;
                    var dataWords = '<?php echo json_encode($dataWords); ?>';
					jQuery.ajax({
		              	type: "Post",
                        data: {documentId:documentId, gameType:gameType, cateId:cateId, dataWords: dataWords, page: pageGame},
						url:'/document/game/vmt.php',
			            success: function(data){
							
			            	jQuery("#resGame").html(data);
							
			           	}
		            });
					
					
				});
				this.prev = button;
				this.stage.addChild(button);
			
			},
                preload: function () {
                    var that = this;
                    var preload = new createjs.LoadQueue(true);
                    preload.installPlugin(createjs.Sound);
                    preload.addEventListener("fileload", function() {that.playSound();});
                },
                buildWalls: function() {
                    var wall = new createjs.Shape();
                    wall.graphics.beginFill('#c6e9fc');
                    wall.graphics.drawRect(0, 0, this.WALL_THICKNESS, this.canvas.height);
                    this.stage.addChild(wall);
                    wall = new createjs.Shape();
                    wall.graphics.beginFill('#c6e9fc');
                    wall.graphics.drawRect(0, 0, this.WALL_THICKNESS, this.canvas.height);
                    wall.x = this.canvas.width - this.WALL_THICKNESS;
                    this.stage.addChild(wall);
                    wall = new createjs.Shape();
                    wall.graphics.beginFill('#c6e9fc');
                    wall.graphics.drawRect(0, 0, this.canvas.width, this.WALL_THICKNESS);
                    wall.y = this.canvas.height - this.WALL_THICKNESS;

                    this.stage.addChild(wall);
                },
                buildMessageBoard: function () {
                    var board = new createjs.Shape();
                    board.graphics.beginFill('#c6e9fc');
                    board.graphics.drawRect(0, 0, this.canvas.width, this.SCORE_BOARD_HEIGHT);
                    this.stage.addChild(board);

                    this.livesTxt = new createjs.Text('lives: ' + this.live, '20px Open Sans', '#ff7700');
                    this.livesTxt.textAlign = "right";
                    this.livesTxt.y = board.y + 8;
                    this.livesTxt.x = this.canvas.width - this.WALL_THICKNESS;
                    this.stage.addChild(this.livesTxt);

                    var messageTxt = new createjs.Text('Rain word', 'bold 20px Open Sans',
                        '#ff7700');
                    messageTxt.textAlign = 'center';
                    messageTxt.y = board.y + 8;
                    messageTxt.x = this.canvas.width / 2;
                    this.stage.addChild(messageTxt);
                },
                
                
                //rain word
                rainWord: function(){
					that = this;
					var allWords = this.allWords;
					for(i = 0; i < allWords.length; i++) {
						var word = allWords[i];
						var txt = new TextLink(word, "bold 18px Open Sans", "red", "orange");
						txt.x = (i * 150 + 50);
						txt.y = 150;
						txt.cursor = 'pointer';
						
						txt.addEventListener('click', function (e) {
							var valWord = e.target.text;
							that.onLetterClick(valWord);
							
							createjs.Tween.removeTweens(e.target);

                            that.stage.removeChild(e.target);
							
							that.clickText(e);
							
						});
						createjs.Tween.get(txt, {loop: true}).to({ alpha:1, y: this.stage.canvas.height+10 },15000 + Math.random()*900);
						this.stage.addChild(txt);
						
						this.text.push(txt);
					}
					
                },
				
				onLetterClick: function(valWord) {
                    
                    var board = new createjs.Shape();
                    board.graphics.drawRect(0, 0, this.canvas.width, this.SCORE_BOARD_HEIGHT);
					
                    if(valWord.trim() == this.textTrue.trim()) {
                        this.trueSound();
						this.pass(valWord.trim());

                    }else {
                       
                        this.falseSound();
                        if(this.live > 0) {
                            this.live --;
                        }
                        this.livesTxt.text = "lives: " + this.live;

                    }
                },
				trueSound: function() {
					createjs.Sound.play("sound1");
				},
				falseSound: function() {
					 createjs.Sound.play("sound2");
				},
				clearAllEvent: function() {
					this.stage.removeAllEventListeners();
				},
				removeAll: function() {
					this.stage.removeAllChildren();
					this.clearAllEvent();
				},
				pass: function(trueWord) {
					that = this;
					var pageGame = jQuery('#pageGame').val();
					
					if(trueWordByPages.indexOf(trueWord) == -1) {
						trueWordByPages.push(trueWord);
					}
					
					
					for(var i = 0; i < this.text.length; i++) {
						this.stage.removeChild(this.text[i]);
					}
					
					if(pageGame < <?php echo $countStage; ?>) {
						
						var txtScore = new createjs.Text("Correct! click button next to continue!", "bold 16px Lato", "orange");
						txtScore.textAlign = "center";
						txtScore.x = 480;
						txtScore.y = 260;
						this.stage.removeChild(this.txtMes);
						this.txtMes = txtScore;
						this.stage.addChild(txtScore);
						return false;
					}else{
						
						var documentId = "<?php echo $documentId; ?>";
						var gameCode = "<?php echo $gameCode; ?>";
						var totalWord = "<?php echo $countStage; ?>";
						var cateId = "<?php echo $cateId;?>";
                        score = trueWordByPages.length;

                        var userId = <?=$userId;?>;
                        var trueWords = [];
                        if(trueWordByPages.length == 1){
                            trueWords = trueWordByPages[0];
                        }else if(trueWordByPages.length > 1){
                            for(var i = 0; i < trueWordByPages.length; i++)
                            trueWords = trueWords.concat(trueWordByPages[i]);
                        }
                        
						jQuery.ajax({
							type: "Post",
							data:{score: score, userId: userId, totalWord: totalWord, cateId: cateId, trueWords: trueWords, documentId:documentId, gameCode:gameCode},
							url: FL_API_URL+'/game/saveGameVocabunary',
							dataType: 'json',
							success: function(data){
								
								that.finishGame(data.score, data.totalWord, data.trueWords);
								
							}
						});
						
						return false;
					}
					
				},
				addMess: function(text, x, y) {
					alert = new createjs.Text(text, "bold 16px Lato", "orange");
					alert.textAlign = "center";
					alert.x = x;
					alert.y = y;
					this.stage.addChild(alert);
					this.stage.update();
				},
				clearData: function(){
					gameScoreByPage = [];
					trueWordByPages = [];
				},
				finishGame: function(score, totalWord, trueWords) {
					this.removeAll();
				
					totalWord = totalWord;
					score = score;
					trueWords = trueWordByPages.toString();
					var wrongWords = jQuery(<?php echo json_encode($allTrueWords); ?>).not(trueWordByPages).get();
					this.addMess("Finish game", 450, 25);
					this.addMess("Score: "+score+'/'+totalWord, 450, 60);
					this.addMess("True words: "+trueWords, 450, 90);
					this.addMess("Wrong words: "+wrongWords, 450, 120);
					this.clearData();
					
				},
				clickText: function(e) {
                    that = this;
                    img = new Image();
                    img.src = BASE_URL+"/Default/skin/nobel/game/art/bubbles.png";
                    var data = {
                        framerate: 10,
                        images: [img],
                        frames: {width:64, height:64, regX:32, regY:32},
                        animations: {
                            'explode': [0, 10]
                        }
                    };

                    var spritesheet = new createjs.SpriteSheet(data);
                    var animation = new createjs.Sprite(spritesheet, 'explode');
                    animation.x = e.stageX;
                    animation.y = e.stageY;
                    this.stage.addChild(animation);
                    setTimeout(function(){  that.stage.removeChild(animation); }, 200);

                },
                
                //sound
                soundFalse: function () {
                    createjs.Sound.alternateExtensions = ["mp3"];
                    createjs.Sound.registerSound("/assets/audio/Game-Break.ogg", "sound2");

                },
                //sound
                soundTrue: function () {
                    createjs.Sound.alternateExtensions = ["mp3"];
                    createjs.Sound.registerSound("/assets/audio/Game-Spawn.ogg", "sound1");

                },
                insSoundBg: function() {
                    var that = this;
                    createjs.Sound.alternateExtensions = ["mp3"];	
                    createjs.Sound.registerSound("/assets/audio/soundBg.ogg", "sBg");  
                    createjs.Sound.addEventListener("fileload", function(){that.playSound();});
                },
                playSound: function () {
                    instance = createjs.Sound.play('sBg');
                    instance.volume = 0.2;
                },
                pauseSound: function() {
                    createjs.Sound.stop();
                },
                //end game
                endGame: function() {
                    var that = this;
                    this.pauseSound();

                    //this.stage.removeAllChildren();
					for(var i = 0; i < this.text.length; i++) {
						this.stage.removeChild(this.text[i]);
					}
					
					var txtScore = new createjs.Text("You have exceeded wrong word limit!", "bold 16px Lato", "orange");
					txtScore.textAlign = "center";
					txtScore.x = 480;
					txtScore.y = 260;
					this.stage.removeChild(this.txtMes);
					this.txtMes = txtScore;
					this.stage.addChild(txtScore);
					
					var pageGame = jQuery('#pageGame').val();
					
					if(pageGame == <?php echo $countStage; ?>) {
						var documentId = "<?php echo $documentId; ?>";
						var gameCode = "<?php echo $gameCode; ?>";
						var totalWord = "<?php echo $countStage; ?>";
						var cateId = "<?php echo $cateId;?>";
                        var score = trueWordByPages.length;

                        var userId = <?=$userId;?>;
                        var trueWords = [];
                        if(trueWordByPages.length == 1){
                            trueWords = trueWordByPages[0];
                        }else if(trueWordByPages.length > 1){
                            for(var i = 0; i < trueWordByPages.length; i++)
                            trueWords = trueWords.concat(trueWordByPages[i]);
                        }
						jQuery.ajax({
							type: "Post",
							data:{score:score, totalWord: totalWord, userId: userId, trueWords: trueWordByPages, cateId:cateId, documentId:documentId, gameCode:gameCode},
							url: FL_API_URL+'/game/saveGameVocabunary',
							dataType: 'json',
							success: function(data){
								
								that.finishGame(data.score, data.totalWord, data.trueWords);
								
							}
						});
					}
						
					
                    return false;
                }
            };
            function pauseSound() {
                RainWord.pauseSound();
            }
            
			jQuery(function() {
				
				RainWord.startGame();
				 
            });

        </script>
		
        <div class='alert alert-info mgb0'>
            Look at the photos and click on the words that describe it.
        </div>
        
        <div class="item" >
			<canvas style='width: 100% !important;' id="canvas" width='900px' height="570"></canvas>
        </div>
		<?php } else { ?>
			Chưa có dữ liệu
	<img class='item' src="<?php echo BASE_URL; ?>/Default/skin/nobel/test/themes/default/media/bg_game.jpg" />
		<?php } ?>
