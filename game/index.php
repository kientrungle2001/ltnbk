<style>
	.fix-menu{margin-bottom: 15px;}
</style>
<div class="full pt-3">
	<div class="container">
		<?php if(isset($_SESSION['userId'])) { ?>
		<div class="card bg-light mb-3">
		    <div class="card-block p-3">
		    	<div class="row">

		            <div class="col-md-4 col-12">
		                <label for="">Game</label>
		                <select ng-change="selectGameType();" ng-model="selectedGameType" class="form-control input-sm" name="gameType" id="gameType">
		                 	<option value="">Choose game</option>
                            <option ng-repeat="gameType in gameTypes" value="{{gameType.gamecode}}">{{gameType.game_type}}</option>
                        </select>
		            </div>

					<div id="resbytype" class="col-md-4 col-12">
						<div class="form-group">
							<label for="">Topic</label>
							<select  ng-model="selectedGameTopic" class="form-control input-sm" name="gameTopic" id="gameTopic">
								<option value=""> Choose topic </option>

								<option ng-show="selectedGameType == 'muatu'" value="{{gameTopic.id}}" ng-repeat="gameTopic in muatuTopics">
									--{{gameTopic.treeLevel|repeat:'--'}} {{gameTopic.game_topic}}							
								</option>
								<option ng-show="selectedGameType == 'dragWord'" value="{{gameTopic.id}}" ng-repeat="gameTopic in dragTopics">
									Topic {{$index+1}}							
								</option>
							</select>
						</div>
					</div>
					
		            <div class="col-md-4 col-12">
		                <div class="form-group">

		                    <div ng-click="playGame()" id="playgame" style="margin-top: 30px;" class="btn btn-primary">
		                        <span class="glyphicon fefe glyphicon glyphicon-play" aria-hidden="true"></span> Play game
		                    </div>
		                </div>
		            </div>

		        </div>
		    </div>
		</div>

		<div class="full mb-3">	
			<?php if(isset($_GET['gameType']) && $_GET['gameType'] == 'muatu'){ ?>
			<div id="gamemuatu">
				<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
		        <script src="/assets/js/createjs-2015.05.21.min.js"></script>
		        
		        <script id="editable">

					gameRunning = false;
					BASE_URL = 'http://s1.nextnobels.com';	
		            // define a new TextLink class that extends / subclasses Text, and handles drawing a hit area
		            // and implementing a hover color.
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
		                dataWord : null,
		                dataTrue : null,
		                canvas: null,
		                stage: null,
		                //loader bar
		                WALL_THICKNESS: 15,
		                SCORE_BOARD_HEIGHT: 40,
		                loaderBar: null,
		                loadInterval: null,
		                LOADER_WIDTH: 400,
		                percentLoaded: 0,
		                //
		                allword: 0,//tong so tu trong game
		                stopCustomData: 6,
		                live: 3,
		                score: 0,
		                scoreTxt: null,
		                livesTxt: null,
		                button: null,
		                txt: null,
		                starfield: null,
		                bitmap: null,
		                rand: null,
		                //end game
		                end:false,
		                sprite: null,
		                clickFalse: [],
		                wordDel: [],
		                clickTrue: [],
		                //start
		                start: false,
		                i: 0,//dem so lan de quy ham CustomData()

		                init: function(dataword, dataTrue, allword) {
		                    that = this;
		                    var myArray = ['1', '2', '3'];
		                    this.rand = myArray[Math.floor(Math.random() * myArray.length)];
		                    this.dataWord = dataword;
		                    this.allword = allword;
		                    this.dataTrue = dataTrue;
		                    this.canvas = document.getElementById('canvas');
		                    this.stage = new createjs.Stage(this.canvas);
		                    this.stage.enableMouseOver(40);

		                    //draw sky
		                    //this.skys();
		                    this.bitmap = new createjs.Bitmap(BASE_URL+"/default/skin/test/game/images/play1.png");
		                    this.bitmap.x = 0;
		                    this.bitmap.y = 0;

		                    this.stage.addChild(this.bitmap);
		                    this.preload();
		                    this.insSoundBg();

		                    this.buildStart();
		                    var data = {
		                        images: [BASE_URL+"/default/skin/test/game/art/spritesheet_sparkle.png"],
		                        frames: {width: 21, height: 23, regX: 10, regY: 11}
		                    };

		                    //this.buildWalls();
		                    // set up an animation instance, which we will clone
		                    this.sprite = new createjs.Sprite(new createjs.SpriteSheet(data));

		                    this.display();
		                    // start the tick and point it at the window so we can do some work before updating the stage:

		                },
		                tick: function(event) {

		                    var l = this.stage.getNumChildren();
		                    for (var i=l-1; i>0; i--) {
		                        var sparkle = this.stage.getChildAt(i);

		                        // apply gravity and friction
		                        sparkle.vY += 2;
		                        sparkle.vX *= 0.98;

		                        // update position, scale, and alpha:
		                        sparkle.x += sparkle.vX;
		                        sparkle.y += sparkle.vY;
		                        sparkle.scaleX = sparkle.scaleY = sparkle.scaleX+sparkle.vS;
		                        sparkle.alpha += sparkle.vA;

		                        //remove sparkles that are off screen or not invisble
		                        if (sparkle.alpha <= 0 || sparkle.y > canvas.height) {
		                            this.stage.removeChildAt(i);
		                        }
		                    }


		                },
		                //display
		                display: function() {
		                    var that = this;
		                    createjs.Ticker.setFPS(60);
		                    createjs.Ticker.addEventListener("tick", function (e) {
		                        if (!that.end) {
		                            // Actions carried out when the Ticker is not paused.
		                            if(that.live == 0 || that.allword == 0) {
		                                that.end = true;
		                                that.endGame();

		                            }
		                            that.stage.update();
		                        }
		                    });
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

		                    this.scoreTxt = new createjs.Text('score: ' + this.score, '20px Open Sans', '#ff7700');
		                    this.scoreTxt.y = board.y + 8;
		                    this.scoreTxt.x = this.WALL_THICKNESS;
		                    this.stage.addChild(this.scoreTxt);

		                    var messageTxt = new createjs.Text('Rain word', 'bold 20px Open Sans',
		                        '#ff7700');
		                    messageTxt.textAlign = 'center';
		                    messageTxt.y = board.y + 8;
		                    messageTxt.x = this.canvas.width / 2;
		                    this.stage.addChild(messageTxt);
		                },
		                buildStart: function() {
		                    this.stage.enableMouseOver(40);
		                    var that = this;
		                    var background = new createjs.Shape();
		                    background.name = "background";
		                    background.graphics.beginFill("#c6dfe9").drawRoundRect(0, 0, 170, 70, 10);

		                    var label = new createjs.Text("Start", "bold 55px Open Sans", "#305958");
		                    label.name = "label";
		                    label.textAlign = "center";
		                    label.textBaseline = "middle";
		                    label.x = 170/2;
		                    label.y = 70/2;

		                    this.button = new createjs.Container();
		                    this.button.name = "button";
		                    this.button.x = 365;
		                    this.button.y = 292;
		                    this.button.addChild(background, label);
		                    // setting mouseChildren to false will cause events to be dispatched directly from the button instead of its children.
		                    // button.mouseChildren = false;
		                    this.button.addEventListener("click", function(event) {
		                        that.stage.removeChild(that.button);
		                        that.stage.removeChild(that.bitmap);
		                        that.buildMessageBoard();

		                        that.bitmap = new createjs.Bitmap(BASE_URL+"/default/skin/test/game/images/background_"+that.rand+".png");
		                        that.bitmap.x = 0;
		                        that.bitmap.y = 40;
		                        that.stage.addChild(that.bitmap);
								
								
								
		                        //draw load
		                        //that.skys();
		                        //that.randomStar();
		                        that.soundTrue();
		                        that.builLoaderBar();
		                        that.startLoad();
		                        that.soundFalse();
		                        that.display();
		                    });
		                    this.stage.addChild(this.button);

		                },

		                skys: function() {
		                    // draw the sky
		                    var that = this;
		                    var sky = new createjs.Shape();
		                    sky.graphics.beginLinearGradientFill(["#204", "#003", "#000"], [0, 0.15, 0.6], 0, this.canvas.height, 0, 0);
		                    sky.graphics.drawRect(0, 40, this.canvas.width, this.canvas.height);
		                    this.stage.addChild(sky);
		                    // create a Shape instance to draw the vectors stars in, and add it to the stage:
		                    this.starfield = new createjs.Shape();
		                    this.stage.addChild(this.starfield);

		                    // set up the cache for the star field shape, and make it the same size as the canvas:
		                    this.starfield.cache(0, 0, this.canvas.width, this.canvas.height);
		                    createjs.Ticker.addEventListener("tick", function(){that.randomStar();});
		                    createjs.Ticker.setFPS(30);
		                },
		                randomStar: function() {
		                    // draw a vector star at a random location:
		                    this.starfield.graphics.beginFill(createjs.Graphics.getRGB(0xFFFFFF, Math.random())).drawPolyStar(Math.random() * this.canvas.width, Math.random() * this.canvas.height, Math.random() * 4 + 1, 5, 0.93, Math.random() * 360);

		                    // draw the new vector onto the existing cache, compositing it with the "source-overlay" composite operation:
		                    this.starfield.updateCache("source-overlay");

		                    // if you omit the compositeOperation param in updateCache, it will clear the existing cache, and draw into it:
		                    // in this demo, that has the effect of showing just the star that was drawn each tick.
		                    // shape.updateCache();

		                    // because the vector star has already been drawn to the cache, we can clear it right away:
		                    this.starfield.graphics.clear();
		                },

		                //loader bar
		                builLoaderBar: function() {
		                    this.loaderBar = new createjs.Shape();
		                    this.loaderBar.x = this.stage.canvas.width/2 - 200;
		                    this.loaderBar.y = this.stage.canvas.height/2 -100;
		                    this.loaderBar.graphics.setStrokeStyle(2);
		                    this.loaderBar.graphics.beginStroke('red');
		                    this.loaderBar.graphics.drawRect(0, 0, this.LOADER_WIDTH, 40);
		                    this.stage.addChild(this.loaderBar);
		                },
		                startLoad: function() {
		                    var that = this;
		                    this.loadInterval = setInterval(function(){that.updateLoad();}, 50);// chu y
		                },
		                updateLoaderBar: function() {
		                    this.loaderBar.graphics.clear();
		                    this.loaderBar.graphics.beginFill('orange');
		                    this.loaderBar.graphics.drawRect(0, 0, this.LOADER_WIDTH * this.percentLoaded, 40);
		                    this.loaderBar.graphics.endFill();
		                    this.loaderBar.graphics.setStrokeStyle(0.3);
		                    this.loaderBar.graphics.beginStroke("red");
		                    this.loaderBar.graphics.drawRect(0, 0, this.LOADER_WIDTH, 40);
		                    this.loaderBar.graphics.endStroke();

		                },
		                updateLoad: function() {
		                    var that =  this;
		                    this.percentLoaded += .025;
		                    this.updateLoaderBar();
		                    if (this.percentLoaded >= 1) {
		                        clearInterval(this.loadInterval);
		                        this.stage.removeChild(this.loaderBar);
		                        //mua chu
		                        var data = this.dataWord;

		                        this.customData(data);
		                    }
		                },

		                customData: function(data) {
		                    if(this.end == true) return false;
		                    var that = this;
		                    var dataJson = data[that.i];
		                    this.rainWord(dataJson);
		                    this.i++;
		                    if(this.i > this.stopCustomData) return false;
		                    setTimeout(function(){

		                        if(that.i > that.stopCustomData) return false;
		                        that.customData(data);
		                    }, 8000);
		                },
		                //rain word
		                rainWord: function(dataword){

		                    that = this;
		                    for(i = 0; i < dataword.length; i++) {
		                        //setInterval(function(){ this. = that.dataWord[i]; }, 3000);

		                        var word = dataword[i];
		                        var widthW = word.length*10;
		                        //var txt = new createjs.Text(word, 'bold 25px Arial');
		                        var color = "red";
		                        var checkmau = i % 4;
		                        switch(checkmau) {
		                            case 0:
		                                color = "red";
		                                break;
		                            case 1:
		                                color = "blue";
		                                break;
		                            case 2:
		                                color = "orange";
		                                break;
		                            case 3:
		                                color = "red";
		                                break;
		                            default:
		                                color = "red";
		                        }

		                        var txt = new TextLink(word, "bold 18px Open Sans", color, "orange");
		                        txt.cursor = 'pointer';
		                        var j = i +1;
		                        if(j == 6) {
		                            j = 1;
		                        }
		                        txt.x = (j * 170)-110  ;
		                        txt.y = 35 + Math.floor((Math.random() * 10) + 2)*15;
		                        this.stage.addChild(txt);
		                        txt.addEventListener('click', function (e) {
		                            var valWord = e.target.text;
		                            that.onLetterClick(valWord);
		                            //remove tween
		                            createjs.Tween.removeTweens(e.target);
		                            //-- cau
		                            that.checkEndWord();
		                            //remove text
		                            that.stage.removeChild(e.target);
		                            that.clickText(e);
		                        });

		                        var checkTrue = this.dataTrue.indexOf(txt.text);
		                        if(checkTrue >= 0) {
		                            createjs.Tween.get(txt).to({ alpha:1, y: this.stage.canvas.height+10 },15000 + Math.random()*900).call(function(){that.handleComplete(txt.text);});
		                        }else {
		                            createjs.Tween.get(txt).to({ alpha:1, y: this.stage.canvas.height+10 },15000 + Math.random()*900).call(function(){that.checkEndWord();});
		                        }
		                    }
		                },
		                addSparkles: function(count, x, y, speed) {
		                    //create the specified number of sparkles
		                    for (var i = 0; i < count; i++) {
		                        // clone the original sparkle, so we don't need to set shared properties:
		                        var sparkle = this.sprite.clone();

		                        // set display properties:
		                        sparkle.x = x;
		                        sparkle.y = y;
		                        //sparkle.rotation = Math.random()*360;
		                        sparkle.alpha = Math.random() * 0.5 + 0.5;
		                        sparkle.scaleX = sparkle.scaleY = Math.random() + 0.3;

		                        // set up velocities:
		                        var a = Math.PI * 2 * Math.random();
		                        var v = (Math.random() - 0.5) * 30 * speed;
		                        sparkle.vX = Math.cos(a) * v;
		                        sparkle.vY = Math.sin(a) * v;
		                        sparkle.vS = (Math.random() - 0.5) * 0.2; // scale
		                        sparkle.vA = -Math.random() * 0.05 - 0.01; // alpha

		                        // start the animation on a random frame:
		                        sparkle.gotoAndPlay(Math.random() * sparkle.spriteSheet.getNumFrames());

		                        // add to the display list:
		                        this.stage.addChild(sparkle);
		                    }
		                },
		                clickText: function(e) {
		                    that = this;
		                    img = new Image();
		                    img.src = BASE_URL+"/default/skin/nobel/game/art/bubbles.png";
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
		                //chu dung roi xuong dat
		                handleComplete: function (txt) {
		                    //Tween complete
		                    this.checkEndWord();
		                    this.wordDel.push(txt);
		                    if(this.live > 0 ) {
		                        createjs.Sound.play("sound2");
		                        this.live --;
		                    }

		                    this.livesTxt.text = "lives: " + this.live;

		                },
		                // chu sai roi xuong dat
		                checkEndWord: function() {
		                    if(this.allword > 0) {
		                        this.allword --;
		                    }
		                },
		                //click vao word
		                onLetterClick: function(valWord) {
		                    var checkTrue = this.dataTrue.indexOf(valWord);
		                    var board = new createjs.Shape();
		                    board.graphics.drawRect(0, 0, this.canvas.width, this.SCORE_BOARD_HEIGHT);
		                    if(checkTrue >= 0) {
		                        createjs.Sound.play("sound1");
		                        this.clickTrue.push(valWord);
		                        this.score = this.score + 1;
		                        this.scoreTxt.text = "score: " + this.score;

		                    }else {
		                        createjs.Sound.play("sound2");
		                        this.clickFalse.push(valWord);
		                        if(this.live > 0) {
		                            this.live --;
		                        }
		                        this.livesTxt.text = "lives: " + this.live;

		                    }
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
		                    createjs.Sound.alternateExtensions = ["mp3"];	// add other extensions to try loading if the src file extension is not supported
		                    createjs.Sound.registerSound("/assets/audio/soundBg.ogg", "sBg");  // register sound, which preloads by default
		                    //createjs.Sound.onLoadComplete = this.playSound();  // add a callback for when load is completed
		                    createjs.Sound.addEventListener("fileload", function(){that.playSound();}); // add an event listener for when load is completed

		                },
		                playSound: function () {
		                    instance = createjs.Sound.play('sBg');
		                    instance.volume = 0.2;
		                },
		                pauseSound: function() {
		                    createjs.Sound.stop();
		                },
		                //end game
		                removeGame: function(){
		                	
		                	this.pauseSound();
		                	if(this.stage){
		                    	this.stage.autoClear = false;
		                    	this.stage.removeAllEventListeners()
		                    	this.stage.removeAllChildren();
		                    	this.end = true;
		                    	this.stage.update();
		                	}
		                },
		                startGame: function(){
		                	this.end = false;
		                },
		                endGame: function() {
		                    var that = this;
		                    this.pauseSound();

		                    //this.stage.removeContainer();
		                    this.stage.removeAllChildren();

		                    //var msg ="Điểm của bạn: " + this.score +' mang '+ this.live;
		                    //var gameOverTxt = new createjs.Text(msg, "22px Arial", '#ff7700');
		                    //gameOverTxt.textAlign = 'center';
		                    //gameOverTxt.textBaseline = 'middle';
		                    //gameOverTxt.x = this.stage.canvas.width / 2;
		                    //gameOverTxt.y = this.stage.canvas.height / 2;
		                    //this.stage.addChild(gameOverTxt);
		                    //this.display();
		                    var gamecode = "<?php echo $_GET['gameType']; ?>";
		                    var gameTopic = "<?php echo $_GET['gameTopic']; ?>";
		                    var check = 1;
		                    jQuery.ajax({
		                        type: "POST",
		                        url: FL_API_URL+'/game/gameSave',
		                        data: {score:that.score, live:that.live, gamecode:gamecode, gameTopic:gameTopic, check:check},
		                        success: function(data) {
		                            if(data) {


		                                var rate = data;
		                                if(that.clickFalse.length > 0) {
		                                    var wordFalse = that.clickFalse;
		                                    wordFalse.toString();
		                                    document.getElementById("clickFlase").innerHTML = wordFalse;
		                                    document.getElementById("showWordFalse").style.display = 'block';

		                                    jQuery('#showGame').show();
		                                }
		                               if(that.wordDel.length > 0 ) {
		                                   var wordTrue = that.wordDel;
		                                   wordTrue.toString();
		                                   document.getElementById("wordDel").innerHTML = wordTrue;
		                                   document.getElementById("showWordTrue").style.display = 'block';

		                                   jQuery('#showGame').show();
		                               }
		                                if(that.clickTrue.length > 0 ) {
		                                    var wordTrue = that.clickTrue;
		                                    wordTrue.toString();
		                                    document.getElementById("clickTrue").innerHTML = wordTrue;
		                                    document.getElementById("showWord").style.display = 'block';
		                                    jQuery('#showGame').show();
		                                }

		                                var msg ="Xếp hạng: " + rate.rating +'/'+ rate.total;
		                                canvas = document.getElementById('canvas');
		                                stage = new createjs.Stage(canvas);
		                                var bitmap = new createjs.Bitmap(BASE_URL+"/default/skin/test/game/images/background_"+that.rand+".png");
		                                bitmap.x = 0;
		                                bitmap.y = 0;

		                                stage.addChild(bitmap);
										var gameOver = new createjs.Text("GAME OVER", "40px Open Sans", '#ff7700');
										gameOver.textAlign = 'center';
		                                gameOver.textBaseline = 'middle';
		                                gameOver.x = stage.canvas.width / 2;
		                                gameOver.y = stage.canvas.height / 2-140;
										
		                                var score = "Score: "+that.score;
		                                var gamescore = new createjs.Text(score, "20px Open Sans", '#ff7700');
		                                gamescore.textAlign = 'center';
		                                gamescore.textBaseline = 'middle';
		                                gamescore.x = stage.canvas.width / 2;
		                                gamescore.y = stage.canvas.height / 2-60;
										
										var live = "Live: "+that.live;
										var gameLive = new createjs.Text(live, "20px Open Sans", '#ff7700');
		                                gameLive.textAlign = 'center';
		                                gameLive.textBaseline = 'middle';
		                                gameLive.x = stage.canvas.width / 2;
		                                gameLive.y = stage.canvas.height / 2-30;
										
		                                var gameOverTxt = new createjs.Text(msg, "20px Open Sans", '#ff7700');
		                                gameOverTxt.textAlign = 'center';
		                                gameOverTxt.textBaseline = 'middle';
		                                gameOverTxt.x = stage.canvas.width / 2;
		                                gameOverTxt.y = stage.canvas.height / 2;
										
										stage.addChild(gameOver);
		                                stage.addChild(gameLive);
		                                stage.addChild(gamescore);
		                                stage.addChild(gameOverTxt);
		                                createjs.Ticker.setFPS(60);
		                                createjs.Ticker.addEventListener("tick", function (e) {
		                                    stage.update();
		                                });
		                            }
		                        }
		                    });
		                    
		                    return false;
		                }
		            };


		            function pauseSound() {
		                RainWord.pauseSound();
		            }
		            function reloadPage() {
		                history.go(0);
		            }



		        </script>
		       

				<div class="row">
					<div class="col-12 col-md-9">
						<strong id="question" class="item" style="margin: 10px 0px;">
										{{question}}	
						</strong>
						
						<canvas style='width: 100% !important;' id="canvas" width='900px' height="570">
						</canvas>
						
						<button class="btn btn-primary" onclick="reloadPage();">
						<span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span> Play again</button>

						
						<button id="showGame" style="display:none;"  type="button" class="btn btn-danger" data-toggle="modal" data-target=".showGame"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Game results</button>
						<!--show game -->
						<div class="modal fade showGame" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			                <div class="modal-dialog modal-lg">
			                    <div class="modal-content">
			                        <div class="modal-header">
			                            <button style="right: 15px; position: absolute;" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                            <h4 class="modal-title" id="gridSystemModalLabel">Game results</h4>
			                        </div>
			                        <div class="modal-body">
			                            <div class="alert alert-success" >
			                                <b id="showWord" style="color: black; display:none;" >Correct words clicked: <span style="color:red;" id="clickTrue"></span></b><br>
			                                <b id="showWordFalse" style="color: black; display:none;" >Wrong words clicked: <span style="color:red;" id="clickFlase"></span> </b> <br>
			                                <b id="showWordTrue" style="color: black; display:none;" >Correct Words unclicked: <span style="color:red;" id="wordDel"></span></b> </br>
											<p>Note: Double click on the word to see translate into Vietnamese</p>		
			                            
										</div>
			                        </div>
			                    </div>
			                </div>
			            </div>
				
					</div>
					<div class="col-12 col-md-3">
						<h4>Rating</h4>
						<style>
						.tablerate{
							width: 100%;
							border: 1px solid #cccccc;
							
						}
						.tablerate tr td{
							text-align: center;
							border: 1px solid #cccccc;
							padding: 6px;
						}
						.tablerate tr th{
							text-align: center;
							border: 1px solid #cccccc;
							padding: 3px;
						}
						</style>
						<table class='tablerate'>
							<tr>
								<th>Username</th>
								<th>Score</th>
								<th>live</th>
							</tr>
							<tr ng-repeat="rank in ranks">
								<td>{{rank.username}}</td>
								<td>{{rank.score}}</td>
								<td>{{rank.live}}</td>
							</tr>
						</table>

					</div>
				</div>

		      

			</div>
			<?php } else if(isset($_GET['gameType']) && $_GET['gameType'] == 'dragWord'){ ?>
			
			<script src="https://code.createjs.com/createjs-2015.05.21.min.js"></script>
    
		    <script>
				BASE_URL = 'http://s1.nextnobels.com';
				function playSound() {
						createjs.Sound.registerSound({src:"/assets/audio/M-GameBG.ogg", id:"sound"});
						createjs.Sound.play("sound");
					}
				Factorys = {
					dragRadius: 40,
					topicHeight: 100,
					topicWidth: 100,
					game: false,
					score: false,
					time: false,
					cells: false,
					board: false,
					topics: false,
					dataCells: [],
					dataTopics: [],
					initGame: function(dataCells, dataTopics){
						this.dataCells = dataCells;
						this.dataTopics = dataTopics;
					},
					getGame: function() {
						if(!this.game) {
							this.game = new Game();
						}
						return this.game;
					},
					getBoard: function() {
						if(!this.board) {
							this.board = new Board();
						}
						return this.board;
					},
					getScore: function() {
						if(!this.score) {
							this.score = new Score();
						}
						return this.score;
					},
					getTime: function() {
						if(!this.time) {
							this.time = new Time();
						}
						return this.time;
					},
					getCells: function () {
						if(!this.cells) {
							dataWords = this.dataCells;
							this.cells = [];
							var h = 0;
							for(var i = 0; i < dataWords.length; i++) {
								var j = i % 5;
								if(j == 0){
									h++;
								}
								
								tam = dataWords[i];
								var cell = new Cell(tam.name, tam.type, j*110 + 50, 110*h - 60);
								this.cells.push(cell);
							}	
						}
						//console.log(this.cells);		
						return this.cells;
					},
					getTopics: function () {
						if(!this.topics) {
							var dataTopics = this.dataTopics;
							this.topics = [];
							for(var i = 0; i<dataTopics.length; i++) {
								var t = dataTopics[i];
								var topic = new Topic(t.name, t.type, i*120+ 55);
								this.topics.push(topic);
							}
						}
						return this.topics;
					}
					
				};
			
				//class game
				Game = function() {
					
				};
				Game.prototype = {
					destroy: false,
					timePlay: false,
					startTime: 0,
					endTime: 0,
					start: function() {
						
						var that = this;
						Factorys.getBoard().init();
						
						Factorys.getBoard().display();
						
						
						this.timePlay = createjs.Ticker.on("tick", function () { that.checkEnd(); });
					},
					checkEnd: function() {
						//alert(1);
						
						var board = Factorys.getBoard();
						var timer = Factorys.getTime();
						var score = board.score;
						var live = board.live;
						var time = board.time;
						
						if(score == 18 ) {
							
							
							var txtScore = new createjs.Text("Congratulations! You have won!", "bold 16px Lato", "orange");
							txtScore.textAlign = "center";
							txtScore.x = 380;
							txtScore.y = 100;
							board.stage.removeChild(board.txtMes);
							board.txtMes = txtScore;
							board.stage.addChild(txtScore); 
							//xoa cell
							var cells = Factorys.getCells();
							for(var i = 0; i < cells.length; i++) {
								board.stage.removeChild(cells[i].shapes[i]);
							}
							board.stage.update();
							var score = board.score;
							var time = timer.value;
							this.endTime = parseInt(this.startTime) + parseInt(time);
							timer.stopCount();
							
							createjs.Ticker.removeAllEventListeners();
							
							
						}else if(live == 4) {
							
							
							var txtScore = new createjs.Text("You have exceeded wrong word limit!", "bold 16px Lato", "orange");
							txtScore.textAlign = "center";
							txtScore.x = 380;
							txtScore.y = 100;
							board.stage.removeChild(board.txtMes);
							board.txtMes = txtScore;
							
							board.stage.addChild(txtScore); 
							//xoa cell
							var cells = Factorys.getCells();
							for(var i = 0; i < cells.length; i++) {
								board.stage.removeChild(cells[i].shapes[i]);
							}
							board.stage.update();
							
							var score = board.score;
							var time = timer.value;
							this.endTime = parseInt(this.startTime) + parseInt(time);
							timer.stopCount();
						
							createjs.Ticker.removeAllEventListeners();
							
						}else if(time == 180) {
							this.endGame();
						}
					},
					endGame: function() {
						
						this.destroy = true;
						this.endTime = '1533541551';
						var board = Factorys.getBoard();
						var txtScore = new createjs.Text("Time's up! ", "bold 16px Lato", "orange");
						txtScore.textAlign = "center";
						txtScore.x = 360;
						txtScore.y = 100;
						board.stage.removeChild(board.txtMes);
						board.txtMes = txtScore;
						board.stage.addChild(txtScore); 
						//xoa cell
						var cells = Factorys.getCells();
						for(var i = 0; i < cells.length; i++) {
							board.stage.removeChild(cells[i].shapes[i]);
						}
						board.stage.update();
						var score = board.score;
						var time = timer.value;
						this.endTime = parseInt(this.startTime) + parseInt(time);
						timer.stopCount();
						
						createjs.Ticker.removeAllEventListeners();
					},
					saveData: function(score, time, startTime, endTime, lessonId, lessonType) {
						$.ajax({
				              	type: "Post",
					            data:{time:time, score: score, startTime:startTime, endTime:endTime, lessonId, lessonType},
					            url:'http://s1.nextnobels.com/form/saveWord',
					            success: function(data){
					            	
					           	}
				            });
					}
				};
				
				//class Board
				Board = function() {
					
				};
				Board.prototype = {
					stage:null, 
					canvas:null,
					soundBd: false,
					cells: null,
					topics: null,
					txtScore: null,
					txtMes: null,
					txtLive: null,
					appleFalse: [],
					score: 0,
					live: 0,
					time: 0,
					timePlay: false,
					txtTime: null,
					init: function() {
						this.canvas = document.getElementById('canvas');
		                this.stage = new createjs.Stage(this.canvas);
						
						bitmap2 = new createjs.Bitmap(BASE_URL+"/default/skin/test/game/images/cay.png");
		                        bitmap2.x = 700;
		                        bitmap2.y = 0;
		                        this.stage.addChild(bitmap2);
						
		                this.stage.enableMouseOver();
						//outside
						this.stage.mouseMoveOutside = true;
						//enable touch
						createjs.Touch.enable(this.stage);
						
						//sound
						this.soundTrue();
						this.soundFalse();
						//this.soundBg();
						
						var cells = Factorys.getCells();
						this.cells = cells;
						
						var topics = Factorys.getTopics();
						this.topics = topics;
						
						
						//console.log(timer.value);	
					},
					display: function() {
						//that = this;
						
						this.displayShapes();
						this.displayTopics();
						this.displayGreenApple();
						this.displayScore();
						this.displayLive();
						this.displayTime();
						this.stage.update();
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
					soundBg: function() {
						that = this;
						createjs.Sound.addEventListener("fileload", function() {
							that.soundBd = createjs.Sound.registerSound({src:"/assets/audio/M-GameBG.ogg", id:"sound"});
							createjs.Sound.play("sound");
					
						});
						
						
					},
					
					displayShapes: function () {
						that = this;
						for(var i = 0; i < this.cells.length; i++) {
							this.cells[i].drag(i);
							this.stage.addChild(this.cells[i].shapes[i]);
						}
						
					},
					displayTopics: function() {
						for(var i = 0; i < this.topics.length; i++) {
							this.stage.addChild(this.topics[i].topic);
						}
						
					},
					displayGreenApple:function() {
						apple1 = new createjs.Bitmap(BASE_URL+"/default/skin/test/game/images/green-apple.png");
						apple1.x = 863;
						apple1.y = 260;
						this.stage.addChild(apple1);
						this.appleFalse.push(apple1);
						
						apple2 = new createjs.Bitmap(BASE_URL+"/default/skin/test/game/images/green-apple.png");	
						apple2.x = 896;
						apple2.y = 260;
						this.stage.addChild(apple2);
						this.appleFalse.push(apple2);
						
						apple3 = new createjs.Bitmap(BASE_URL+"/default/skin/test/game/images/green-apple.png");	
						apple3.x = 929;
						apple3.y = 260;
						this.stage.addChild(apple3);
						this.appleFalse.push(apple3);
						
						apple4 = new createjs.Bitmap(BASE_URL+"/default/skin/test/game/images/green-apple.png");	
						apple4.x = 962;
						apple4.y = 260;
						this.stage.addChild(apple4);
						this.appleFalse.push(apple4);				
					},
					displayScore: function () {
						this.txtScore = new createjs.Text("Correct words: 0", "bold 16px Lato", "orange");
						this.txtScore.textAlign = "center";
						this.txtScore.x = 100;
						this.txtScore.y = 15;
						this.stage.addChild(this.txtScore);
						
					},
					displayLive: function () {
						this.txtLive = new createjs.Text("Wrong words : 0", "bold 16px Lato", "orange");
						this.txtLive.textAlign = "center";
						this.txtLive.x = 650;
						this.txtLive.y = 15;
						this.stage.addChild(this.txtLive);
						
					},
					displayTime: function () {
						var that = this;
						var timer = Factorys.getTime();
						timer.count();
			
						this.timePlay = createjs.Ticker.on("tick", function () { that.callTime(); });
					},
					callTime: function() {
						timer = Factorys.getTime();
						var time = timer.value;
						this.time = time;
						this.stage.removeChild(this.txtTime);
						this.txtTime = new createjs.Text("Time: "+time, "bold 16px Lato", "orange");
						this.txtTime.textAlign = "center";
						this.txtTime.x = 375;
						this.txtTime.y = 15;
						
						this.stage.addChild(this.txtTime);
						this.stage.update();
					},
					buttonSound: function() {
						var imageUnchecked = new createjs.Bitmap('checkboxen.jpg');
						imageUnchecked.sourceRect = new createjs.Rectangle(0, 0, 34, 29);

						var imageChecked = new createjs.Bitmap('checkboxen.jpg');
						imageChecked.sourceRect = new createjs.Rectangle(34, 0, 34, 29);
					}	
				
				};
				//class cell
				Cell = function(txt, type, width, height) {
					var label = new createjs.Text(txt, "14px Lato", "orange");
					label.textAlign="center";
					label.x += 50;
					label.y += 40;
					var circle = new createjs.Shape();
					circle.graphics.setStrokeStyle(1).beginStroke("#ffca65").beginFill("white").drawRect(0,0, 100, 100);

					var shape = new createjs.Container();
					shape.homeX = width;//Math.random() * (650 - 20) + 20;
					shape.homeY = height;//Math.random() * (500 - 20) + 2;
					shape.x = shape.homeX;
					shape.y = shape.homeY;
					shape.type = type;
					
					shape.addChild(circle, label);
					
					//shape.setBounds(100, 100, Factorys.dragRadius*2, Factorys.dragRadius*2);
					this.shapes.push(shape);
					
				};
				Cell.prototype = {
					shapes: [],
					apples:[],
					drag: function(i) {
						var that = this;
						var board = Factorys.getBoard();
						this.shapes[i].on("pressmove", function(evt) {
						
							this.x = evt.stageX;
							this.y = evt.stageY;
							board.stage.update();
							
							
						});
						
						//khi nguoi dung bo drag
						this.shapes[i].on("pressup", function (evt) {
							//var that4 = this;
							//console.log(that);
							var board = Factorys.getBoard();
							//dragger = this;//evt.currentTarget;
							
							
							var type = this.type; 
							
							objtopics = Factorys.getTopics();
							
							var objtopic = false;
							for(var i = 0; i < objtopics.length; i++) {
								if(objtopics[i].type == type) {
									objtopic = objtopics[i].topic;
									break;
								}
							}
							if(objtopic) {
								if (that.check(this, objtopic)) {
									createjs.Sound.play("sound1");
									this.off("pressmove", this);
									//dragger.removeEventListener("pressmove");
									board.stage.removeChild(this);
									var score = Factorys.getScore();
									score.addApple();
									apple = new createjs.Bitmap(BASE_URL+"/default/skin/test/game/images/images.png");						
									
									var items = [
												[830,45],[860,75],[890,45], [920,75], [950,45], [980,75], [1010,45],
												[800, 135],[860, 135],[890,105],[920,135],[950,105],[980, 135],[1010,105],
												[1040,135],[830,165],[890,165],[950,165],[1110,165]
												];
									
									var j = score.apple-1;
									
									
									apple.x = items[j][0];
									apple.y = items[j][1];
									
									board.stage.addChild(apple);
									
											
									
									score.addScore();
									
									var nscore = score.score;
									var txtScore = new createjs.Text("Correct words: "+score.score, "bold 16px Lato", "orange");
									txtScore.textAlign = "center";
									txtScore.x = 100;
									txtScore.y = 15;
									board.score = score.score;
									board.stage.removeChild(board.txtScore);
									board.txtScore = txtScore;
									board.stage.addChild(txtScore);
									
									
								}else {
									if(this.x > 550) {
										board.live = board.live + 1;
										var score = Factorys.getScore();
										
										var nscore = score.score;
										var txtScore = new createjs.Text("Correct words: "+score.score, "bold 16px Lato", "orange");
										txtScore.textAlign = "center";
										txtScore.x = 100;
										txtScore.y = 15;
										board.score = score.score;
										board.stage.removeChild(board.txtScore);
										board.txtScore = txtScore;
										board.stage.addChild(txtScore);
										
										
										apple = board.appleFalse[0];
										//apple.x = 800 - score.fapple*25;
										//apple.y = 450;
										board.stage.removeChild(apple);
										
										board.appleFalse.shift();
										
										
										
										
										var txtLive = new createjs.Text("Wrong words : "+board.live, "bold 16px Lato", "orange");
										txtLive.textAlign = "center";
										txtLive.x = 650;
										txtLive.y = 15;
										
										board.stage.removeChild(board.txtLive);
										board.txtLive = txtLive;
										board.stage.addChild(txtLive);
										
										createjs.Sound.play("sound2");
									}
									this.x = this.homeX;
									this.y = this.homeY;
									
								}
							
							}else {
								if(this.x > 500){
									board.live = board.live + 1;
									var score = Factorys.getScore();
									var nscore = score.score;
									var txtScore = new createjs.Text("Correct words: "+score.score, "bold 16px Lato", "orange");
									txtScore.textAlign = "center";
									txtScore.x = 100;
									txtScore.y = 15;
									board.score = score.score;
									board.stage.removeChild(board.txtScore);
									board.txtScore = txtScore;
									board.stage.addChild(txtScore);
									
									
									apple = board.appleFalse[0];
									//apple.x = 800 - score.fapple*25;
									//apple.y = 450;
									board.stage.removeChild(apple);
									board.appleFalse.shift();
								
								
									var txtLive = new createjs.Text("Wrong words : "+board.live, "bold 16px Lato", "orange");
										txtLive.textAlign = "center";
										txtLive.x = 650;
										txtLive.y = 15;
										
										board.stage.removeChild(board.txtLive);
										board.txtLive = txtLive;
										board.stage.addChild(txtLive);
									
									createjs.Sound.play("sound2");
								}
								this.x = this.homeX;
								this.y = this.homeY;
							}
							board.stage.update();
							
						});
			
						
					},
					check: function(obj1,obj2) {
						  var pt = obj1.globalToLocal(obj2.x, obj2.y);
						  var h1 = -50;
						  var h2 = 50;
						  var w1 = -100;
						  var w2 = 100;
						  
						  if(pt.x > w2 || pt.x < w1) return false;
						  if(pt.y > h2 || pt.y < h1) return false;
						  
						  return true;
					}
					
				};
				
				//class topic
				Topic = function (txt, type, height) {
						var label2 = new createjs.Text(txt, "bold 14px Lato", "orange");
						label2.textAlign = "center";
						label2.x += 50;
						label2.y += 40;

						var box = new createjs.Shape();
						box.graphics.setStrokeStyle(2).beginStroke("orange").rect(0, 0, Factorys.topicHeight, Factorys.topicWidth);
						var topic = new createjs.Container();
						topic.x = 650;
						topic.y = height;
								
						topic.addChild(box, label2);
						this.topic = topic;
						this.type = type;
				};
				Topic.prototype = {
					topic: null,
					type: null,
					
				};
				
				//class Score
				Score = function () {
					
				};
				Score.prototype = {
					score: 0,
					apple: 0,
					napple: 0,
					fapple: 0,
					addScore: function() {
						this.score ++;
					},
					subScore:function() {
						this.score --;
					},
					addApple: function() {
						this.apple ++;
					},
					addNapple: function() {
						this.napple ++;
					},
					resApple: function() {
						this.apple = 0;
					},
					addFapple: function() {
						this.fapple ++;
					}
				};
				
				//class Time
				Time = function() {
					
				};
				Time.prototype = {
					value: 1,
					id: false,
					count: function() {
						that = this;
						that.id = setInterval(function() {
							that.value ++;
							
						}, 1000);
					},
					stopCount: function() {
						
						clearInterval(this.id);
						this.value = 1;
					
					},
					getTime: function() {
						return this.value;
					}
				};

		    </script>
			<style>
				.bggame{background: #f5f5f5; border-radius: 5px; background: url('http://s1.nextnobels.com/default/skin/test/game/images/test_bg3.jpg');background-size: cover;}
				.bdrd5{border-radius: 5px;}
				

			</style>

			<div id='resultLesson' class='item bggame mgb15'>	
				<canvas style='width: 100% !important;'  id="canvas" width="1150" height="500"></canvas> 
			</div>
			
		

			<?php } ?>	


		</div>
	<?php } else{ ?>
		<div class="alert text-center alert-warning">
			Bạn cần <a href="#" data-toggle="modal" data-target="#loginRegisterModal" rel="/game"> Đăng nhập </a> để chơi thử!
		</div>
	<?php } ?>
	</div>
</div>	