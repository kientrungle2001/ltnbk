flApp.controller('PracticeController', ['$scope', function($scope) {
	$scope.title = 'Công ty cổ phần giáo dục và phát triển trí tuệ sáng tạo Next Nobels';
	$scope.subject_id = parseInt(subject_id);
	$scope.language = window.localStorage.getItem('language') || 'en';
	$scope.changeLanguage = function() {
		window.localStorage.setItem('language', $scope.language);
	}
	
	$scope.grade = window.localStorage.getItem('grade') || '5';
	$scope.changeGrade = function() {
		window.localStorage.setItem('grade', $scope.grade);
	}
	
	$scope.translateOptions = {
		'category.name': {
			'en': 'name',
			'vn': 'name_vn'
		},
		'test.name': {
			'vn': 'name',
			'en': 'name_en'
		}
	};

	$scope.translate = function (val, opt) {
		var language = $scope.language;
		if (language != 'en') {
			language = 'vn';
		}
		if (typeof val == 'string')
			return $langMap[language][val] || val;
		if (typeof val == 'object') {
			var options = $scope.translateOptions[opt];
			if (language == 'vn') {
				return val[options.vn];
			} else {
				return val[options.en];
			}
		}
	};
	
	$scope.parseTranslate = function(str) {
		if(str) {
			str = str.replace(/\[start\](.*)\[end\]/g, '<button class="btn btn-primary" data-toggle="collapse" onclick="jQuery(this).next().collapse(\'toggle\')">Dịch</button><div class="collapse"><div class="card card-body">$1</div></div>');
			str = str.replace(/\[fix\](.*)\[endfix\]/g, "<span class=\"btn btn-default fa fa-volume-up\" onclick=\"read_question(this,'http://s1.nextnobels.com/3rdparty/Filemanager/source/audiovocabulary/'+'$1'.toLowerCase().replace(/ /g, '_')+'.mp3');\"></span>");
			str = str.replace(/\[audio\](.*)\[endaudio\]/g, function(rep){
				var tam = (/\[audio\](.*)\[endaudio\]/gi).exec(rep);
				var $1 = tam[1];
				var $2 = $scope.strip_tags($1).trim();
				return $1+"<span class=\"btn btn-default fa fa-volume-up\" onclick=\"read_question(this,"+"'http://s1.nextnobels.com/3rdparty/Filemanager/source/audiovocabulary/"+$2.toLowerCase().replace(/ /g, '_')+".mp3"+"'"+")\"></span>";
			});			
			return str;
		};
		return '';
	};
	$scope.action = 'practice';
	$scope.checkIsLogedIn = function() {
		return window.sessionUserId !== '';
	};

	$scope.checkIsPaid = function() {
		return window.checkPayment === '1';
	}
	$scope.subjects = [];
	jQuery.ajax({url: FL_API_URL +'/common/getSubjects', success: function(resp) {
		$scope.subjects = resp;
		$scope.$apply();
	}});
	$scope.tests = [];
	jQuery.ajax({
		type: 'post',
		url: FL_API_URL +'/common/getTests', 
		data: {
			categoryId: '1412',
			software: SOFTWARE,
			site: SITE
		},
		dataType: 'json',
		success: function(resp) {
			$scope.tests = resp;
			$scope.$apply();
		}
	});
	$scope.englishTests = [];
	jQuery.ajax({
		type: 'post',
		url: FL_API_URL +'/common/getTests', 
		data: {
			categoryId: '1411',
			software: SOFTWARE,
			site: SITE
		},
		dataType: 'json',
		success: function(resp) {
			$scope.englishTests = resp;
			$scope.$apply();
		}
	});
	$scope.testSets = [];
	jQuery.ajax({
		type: 'post',
		url: FL_API_URL +'/common/getTestSets', 
		data: {
			categoryId: '1416',
			software: SOFTWARE,
			site: SITE
		},
		dataType: 'json',
		success: function(resp) {
			$scope.testSets = buildBottomTree(resp);
			$scope.$apply();
		}
	});	
	$scope.realTestSets = [];
	jQuery.ajax({
		type: 'post',
		url: FL_API_URL +'/common/getTestSets', 
		data: {
			categoryId: '1414',
			software: SOFTWARE,
			site: SITE
		},
		dataType: 'json',
		success: function(resp) {
			$scope.realTestSets = buildBottomTree(resp);
			$scope.$apply();
		}
	});
	$scope.inPage = function(index, page, pageSize) {
		return (index >= page * pageSize) && (index < (page + 1) * pageSize);
	};
	$scope.totalPage = function(numberOfItem, pageSize) {
		var rs = Math.ceil(numberOfItem / pageSize);
		return rs;
	};
	$scope.range = function(min, max, step) {
		var rs = [];
		for(var i = min; i <= max; i+= step) {
			rs.push(i);
		}
		return rs;
	};
	$scope.selectEnglishTestPage = function(page) {
		$scope.selectedEnglishTestPage = page;
		$scope.$apply();
	};
	$scope.selectTestPage = function (page) {
		$scope.selectedTestPage = page;
		$scope.$apply();
	};
	$scope.selectTestSetPage = function (page) {
		$scope.selectedTestSetPage = page;
		$scope.$apply();
	};
	$scope.topics = [];
	$scope.subject = {};
	
	$scope.loadSubject = function() {
		jQuery.ajax({
			type: 'get',
			url: FL_API_URL +'/corecategories/' + subject_id, 
			dataType: 'json',
			success: function(resp) {
				$scope.subject = resp;
				subjectId = resp.id;
				if(resp.id == 51) {
					$scope.subject.level = 3;
				}
				if(resp.id == 164) {
					$scope.subject.level = 3;
				}
				if(resp.id == 157) {
					$scope.subject.level = 3;
				}
				if(resp.id == 50) {
					$scope.subject.level = 3;
				}
				if(resp.id == 59) {
					$scope.subject.level = 3;
				}
				if(resp.id == 88) {
					$scope.subject.level = 1;
				}
				if(resp.id == 54) {
					$scope.subject.level = 3;
				}
				$scope.$apply();
			}
		});	
	};
	
	$scope.loadTopics = function() {
		jQuery.ajax({
			type: 'post',
			url: FL_API_URL +'/subject/getTopics', 
			data: {
				subject_id: subject_id,
				software: SOFTWARE,
				site: SITE
			},
			dataType: 'json',
			success: function(resp) {
				$scope.topics = buildBottomTree(resp);
				console.log($scope.topics);
				$scope.$apply();
			}
		});	
	};
	
	$scope.loadVocabularies = function() {
		jQuery.ajax({
			type: 'post',
			url: FL_API_URL +'/subject/getVocabularies', 
			data: {
				subject_id: subject_id,
				software: SOFTWARE,
				site: SITE
			},
			dataType: 'json',
			success: function(resp) {
				$scope.vocabularies = buildBottomTree(resp);
				$scope.$apply();
			}
		});	
	};
	
	$scope.loadSubject();
	$scope.loadTopics();
	$scope.loadVocabularies();
	
	$scope.selectTopic = function(topic, parentTopic) {
		if(typeof $scope.practiceIntervalId !== 'undefined') {
			clearInterval($scope.practiceIntervalId);
		}
		jQuery('html, body').animate({
			scrollTop: jQuery("#content").offset().top
		}, 500);
		$scope.action = 'practice';
		$scope.step = 'selectTopic';
		$scope.selectedExerciseNum = null;
		$scope.selectedTopic = topic;
		$scope.selectedParentTopic = parentTopic;
		jQuery.ajax({
			type: 'post',
			url: FL_API_URL +'/subject/getExercises', 
			dataType: 'json',
			data: {
				subject_id: subject_id,
				topic_id: topic.id,
				software: SOFTWARE,
				site: SITE
			},
			success: function(resp) {
				$scope.exerciseNums = [];
				for(var i = 0; i < resp; i++) {
					$scope.exerciseNums.push(i);
				}
				
				if(subject_id == 88) {
					$scope.selectExercise(0);
				}
				$scope.$apply();
			}
		});
	};
	$scope.selectedExerciseNum = null;
	$scope.selectExercise = function(exerciseNum) {
		if(typeof $scope.practiceIntervalId !== 'undefined') {
			clearInterval($scope.practiceIntervalId);
		}
		$scope.step = 'selectExercise';
		$scope.selectedExerciseNum = exerciseNum;
		$scope.remaining = {
			minutes: 15,
			seconds: 0
		};
	};
	$scope.startPractice = function() {
		if($scope.selectedTopic.trial == 0 && window.checkPayment !== '1') {
			alert('Bạn cần phải mua phần mềm mới có thể được học bài này');
			return false;
		}
		jQuery.ajax({
			type: 'post',
			url: FL_API_URL +'/subject/getExerciseQuestions', 
			dataType: 'json',
			data: {
				subject_id: subject_id,
				topic_id: $scope.selectedTopic.id,
				exercise_number: $scope.selectedExerciseNum + 1,
				software: SOFTWARE,
				site: SITE
			},
			success: function(resp) {
				$scope.step = 'startPractice';
				$scope.practiceStep = 'startPractice';
				$scope.showAnswersStep = 'startPractice';
				$scope.questions = resp;
				$scope.user_question_answers = {};
				$scope.$apply();
				$scope.practiceIntervalId = setInterval(function() {
					if($scope.remaining.seconds == 0) {
						if($scope.remaining.minutes == 0) {
							$scope.finishPractice();
						} else {
							$scope.remaining.minutes--;
							$scope.remaining.seconds = 59;
						}
					} else {
						$scope.remaining.seconds--;
					}
					$scope.$apply();
				}, 1000);
			}
		});
	};
	$scope.user_question_answers = {};
	$scope.selectAnswer = function(question, answer) {
		$scope.user_question_answers[question.id] = answer.id;
		console.log($scope.user_question_answers);
	};
	
	$scope.shuffle = function (array) {
		let counter = array.length;
		// While there are elements in the array
		while (counter > 0) {
			// Pick a random index
			let index = Math.floor(Math.random() * counter);
			// Decrease counter by 1
			counter--;
			// And swap the last element with it
			let temp = array[counter];
			array[counter] = array[index];
			array[index] = temp;
		}
		return array;
	} 
	$scope.gameEnables = {};
	$scope.gameTypes = ['vdrag', 'vdt', 'vmt', 'sortword', 'vdragimg', 'dragToPart'];
	$scope.checkGame = function(gameType, documentId) {
		jQuery.ajax({
			type: 'get',
			url: FL_API_URL+'/games/?gamecode='+gameType+'&documentId='+documentId+'&software=1&status=1&limit=1',
			dataType: 'json',
			success: function(rep){
				if(rep[0] && rep[0].question != ''){
					$scope.gameEnables[gameType] = true;
				}else{
					$scope.gameEnables[gameType] = false;
				}
				$scope.$apply();
			}
		});
	}
	$scope.setGameVocabulary = function(documentId){
		$scope.gameVocabularys = [];
		var gameTypes = $scope.gameTypes;
		for(let i = 0; i < gameTypes.length; i++){
			$scope.checkGame(gameTypes[i], documentId);
			
		}
	}
	$scope.strip_tags = function (str) {
		str = str.toString();
		return str.replace(/<\/?[^>]+>/gi, '');
	}
	
	//game
	gameScoreByPage = [];
	trueWordByPages = [];
	$scope.gameScoreByPage = [];
	$scope.trueWordByPages = [];
	$scope.dataCells = [];
	$scope.dataTopics = [];
	$scope.gamePage = 1;
	$scope.gameType = '';
	$scope.gameWords = function (gameType) {
			jQuery('#pageGame').val(1);
			var documentId = $scope.selectedVocabulary.id;
			var cateId = $scope.subject.id;
			$scope.gameType = gameType;
			if(documentId && gameType) {
				if (typeof timer != 'undefined') {
					timer.stopCount();
				}
				if(gameType == 'vdrag'){
					jQuery.ajax({
						type: 'get',
						url: FL_API_URL +'/games?gamecode='+gameType+'&documentId='+documentId+'&software=1&status=1&limit=1', 
						dataType: 'json',
						success: function(data){
							var question = data[0].question;
							var wordByPage = question.split('*****');
							var dataCells = [];
							var dataTopics = [];
							var allTrueWord = [];
							for(var i = 0; i < wordByPage.length; i++){
								var words = wordByPage[i].split(/\r\n|\r|\n|\<br \/\>|\<br\/\>/);
								var objcells = [];
								var objTopics = []; 
								for(var j=0; j < words.length; j++){
									if(words[j] && words[j] != ''){
										var ex_cell = words[j].split(':');
										var cell = {type: ex_cell[0], name: ex_cell[1]};
										var topic = {type: ex_cell[0], name: ex_cell[0]};
										objcells.push(cell);
										objTopics.push(topic);
										allTrueWord.push(ex_cell[0]);
									}
									
								}
								dataCells.push(objcells);
								dataTopics.push(objTopics);
							}
							$scope.dataCells = dataCells;
							$scope.dataTopics = dataTopics;

							jQuery.ajax({
								type: "Post",
								data: {documentId:documentId, gameType:gameType, cateId:cateId, dataCells: dataCells, dataTopics: dataTopics, allTrueWord: allTrueWord, page: $scope.gamePage},
								url:'/document/game/vdrag.php',
								success: function(data){

									jQuery('#resGame').html(data);
									
								}
							});
						}
					});
					
				}else if(gameType == 'vmt'){
					jQuery.ajax({
						type: 'get',
						url: FL_API_URL +'/games?gamecode='+gameType+'&documentId='+documentId+'&software=1&status=1&limit=1', 
						dataType: 'json',
						success: function(data){
							var question = data[0].question;
							var wordByPage = question.split('*****');
							var dataWords = [];
							for(var i = 0; i < wordByPage.length; i++){
								var words = wordByPage[i].split('-----');
								for(var j = 0; j < words.length; j++){
									var trueWord = $scope.strip_tags(words[2]);
									trueWord.trim();
									var strWords = $scope.strip_tags(words[1]);
									strWords.trim();
									var allWords = strWords.split(',').map(function(item) {
										return item.trim();
									});;
									var img = (/src=[\'"]([^\'"]*)[\'"]/gi).exec(words[0]);
									var objWord = {allWords: allWords, trueWord: trueWord, img: img[1]};
								}
								dataWords.push(objWord);
							}
							//console.log(dataWords);

							jQuery.ajax({
								type: "Post",
								data: {documentId:documentId, gameType:gameType, cateId:cateId, dataWords: dataWords, page: $scope.gamePage},
								url:'/document/game/vmt.php',
								success: function(data){

									jQuery('#resGame').html(data);
									
								}
							});
						}
					});
				}else if(gameType =='vdragimg'){
					jQuery.ajax({
						type: 'get',
						url: FL_API_URL +'/games?gamecode='+gameType+'&documentId='+documentId+'&software=1&status=1&limit=1', 
						dataType: 'json',
						success: function(data){
							var question = data[0].question;
							var dataWords = [];
							var allTrueWord = [];
							var wordByPage = question.split('*****');
							for(var i = 0; i < wordByPage.length; i++){
								var words = wordByPage[i].split(/\r\n|\r|\n|\<br \/\>|\<br\/\>/);
								var objcells = [];
								var objTopics = [];
								for(var j = 0; j < words.length; j++){
									if(words[j] && words[j] != ''){
										var ex_cell = words[j].split('*');
										var img = (/src=[\'"]([^\'"]*)[\'"]/gi).exec(ex_cell[0]);
										var word = ex_cell[1].trim();
										var cell = {type: img[1], name: word};
										var topic = {type: img[1], name: img[1]};
										objcells.push(cell);
										objTopics.push(topic);
										allTrueWord.push(word);
									}
								}
								dataWords.push({topic: objTopics, word: objcells});	
							}

							jQuery.ajax({
								type: "Post",
								data: {documentId:documentId, gameType:gameType, cateId:cateId, dataWords: dataWords, allTrueWord: allTrueWord, page: $scope.gamePage,
								software: SOFTWARE,
								site: SITE
							},
								url:'/document/game/vdragimg.php',
								success: function(data){

									jQuery('#resGame').html(data);
									
								}
							});

						}
					});	
				}else if(gameType =='vdt'){
					jQuery.ajax({
						type: 'get',
						url: FL_API_URL +'/games?gamecode='+gameType+'&documentId='+documentId+'&software=1&status=1&limit=1', 
						dataType: 'json',
						success: function(data){
							var question = data[0].question;
							var dataWords = [];
							var arrWords = question.split('*****');
							for(var i = 0; i < arrWords.length; i++){
								if(arrWords[i].trim() == ''){
									continue;
								}
								var parts = arrWords[i].split('-----');
								console.log(arrWords[i]);
								if(parts.length == 2) {
									var words = parts[1].replace(/<br \/>/gi, '');
									words = words.trim();
									var img = (/href=[\'"]([^\'"]*)[\'"]/gi).exec(parts[0]);
									var href = img[1].trim();
									var objWord = {trueWord: words, hreffix: href, href: href};
									dataWords.push(objWord);
								}
							}
							jQuery.ajax({
								type: "post",
								data: {documentId:documentId, gameType:gameType, cateId:cateId, dataWords: dataWords},
								url:'/document/game/vdt.php',
								success: function(data){

									jQuery('#resGame').html(data);
									
								}
							});

						}
					});	
				}else if(gameType == 'sortword'){
					jQuery.ajax({
						type: 'get',
						url: FL_API_URL +'/games?gamecode='+gameType+'&documentId='+documentId+'&software=1&status=1&limit=1', 
						dataType: 'json',
						success: function(data){
							var question = data[0].question;
							var arrWrods = question.split('-----');
							var dataWords = [];
							for(var i=0; i < arrWrods.length; i++){
								dataWord = [];
								arrWord = arrWrods[i].split('===');
								for(var j=0; j < arrWord.length; j++){
									var img = arrWord[0].replace(/<br \/>/gi, '');
									var word = $scope.strip_tags(arrWord[1])
									word.trim();
									dataWord.push(word);
									dataWord.push(img);
									
								}
								dataWords.push(dataWord);
							}
							jQuery.ajax({
								type: "Post",
								data: {documentId:documentId, gameType:gameType, cateId:cateId, dataWords: dataWords,
								software: SOFTWARE,
								site: SITE
							},
								url:'/document/game/sortword.php',
								success: function(data){

									jQuery('#resGame').html(data);
									
								}
							});
						}
					});	
				}else if(gameType == 'dragToPart'){
					jQuery.ajax({
						type: 'get',
						url: FL_API_URL +'/games?gamecode='+gameType+'&documentId='+documentId+'&software=1&status=1&limit=1', 
						dataType: 'json',
						success: function(data){
							var question = data[0].question;
							var dataWords = [];
							var arrWords = question.split('-----');
							for (var i= 0; i < arrWords.length; i++) {
								if(arrWords[i].trim() == ''){
									continue;
								}
								var parts = arrWords[i].split('===');
								if(parts.length == 2) {
									var words = parts[1].replace(/<br \/>/gi, '');
									words = words.trim();
									var img = (/src=[\'"]([^\'"]*)[\'"]/gi).exec(parts[0]);
									var src = img[1];
									var objWord = {words: words, src: src};
									dataWords.push(objWord);
								}
							}
							jQuery.ajax({
								type: "Post",
								data: {documentId:documentId, gameType:gameType, cateId:cateId, dataWords: dataWords,
								software: SOFTWARE,
								site: SITE
							},
								url:'/document/game/dragtopart.php',
								success: function(data){

									jQuery('#resGame').html(data);
									
								}
							});
						}
					});	
				}
				
			}
			

		}
	//select vocabulary
	$scope.selectVocabulary = function(vocabulary) {
		if(typeof $scope.practiceIntervalId !== 'undefined') {
			clearInterval($scope.practiceIntervalId);
		}
		jQuery('html, body').animate({
			scrollTop: jQuery("#content").offset().top
		}, 500);
		jQuery("#resGame").html('');
		$scope.action = 'vocabulary';
		$scope.selectedVocabulary = vocabulary;
		selectedVocabularyId = vocabulary.id;
		$scope.setGameVocabulary(vocabulary.id);
	};
	$scope.finishPractice = function() {
		if(typeof $scope.practiceIntervalId !== 'undefined') {
			clearInterval($scope.practiceIntervalId);
		}
		console.log($scope.user_question_answers);
		$scope.practiceStep = 'finishPractice';
		$scope.totalQuestions = $scope.questions.length;
		$scope.totalRights = 0;
		$scope.questions.forEach(function(question) {
			if($scope.isRightAnswer(question)) {
				$scope.totalRights++;
			}
		});
		$scope.totalWrongs = $scope.totalQuestions - $scope.totalRights;
		jQuery('#resultModal').modal('show');
		var userId = window.sessionUserId;
		var startTime = serverTime;
		var duringTime = 15 * 60 - ($scope.remaining.minutes * 60 + $scope.remaining.seconds);
		var stopTime = serverTime + duringTime;
		var questions = [];
		$scope.questions.forEach(function(question){
			var answerId = 0;
			if(typeof $scope.user_question_answers[question.id] !== 'undefined') {
				answerId = $scope.user_question_answers[question.id];
			}
			questions.push({
				questionId: question.id,
				answerId: answerId,
				status: $scope.isRightAnswer(question) ? 1: 0
			});
		});
		jQuery.ajax({
			type: 'post',
			url: FL_API_URL + '/subject/updateUserBooks',
			data: {
				userId:  userId,
				subject_id: $scope.subject.id,
				topic_id: $scope.selectedTopic.id,
				exercise_number: $scope.selectedExerciseNum+1,
				questions: questions,
				quantity_question: $scope.totalQuestions,
				mark: $scope.totalRights,
				startTime: startTime,
				duringTime: duringTime,
				stopTime: stopTime,
				lang: $scope.language || 'en',
				software: SOFTWARE,
				site: SITE
			},
			success: function(resp) {
				
			}
		});
	};

	$scope.getQuestion = function(questionId) {
		var question = null;
		$scope.questions.forEach(function(q) {
			if(q.id == questionId || parseInt(q.id) == parseInt(questionId)) {
				question = q;
			}
		});
		return question;
	};
	
	$scope.showAnswers = function() {
		$scope.showAnswersStep = 'showAnswers';
	};
	
	$scope.getExplaination = function(question) {
		var explaination = null;
		question.ref_question_answers.forEach(function(answer) {
			if(answer.status == 1 || answer.status == '1' ) {
				explaination = answer.recommend;
			}
		});
		if(!explaination || explaination == '') {
			explaination = question.explaination;
		}
		return explaination;
	};
	$scope.report = {};
	$scope.reportError = function(question) {
		console.log($scope.report.content);
		console.log(question);
	};
	$scope.isRightAnswer = function(question) {
		var rightId = null;
		question.ref_question_answers.forEach(function(answer) {
			if(answer.status == 1 || answer.status == '1' ) {
				rightId = answer.id;
			}
		});
		if(typeof $scope.user_question_answers[question.id] != 'undefined') {
			if(rightId == $scope.user_question_answers[question.id]) {
				return true;
			}
		}
		return false;
	};

	var question_audios = {};
	var current_sound = null;
	var current_sound_url = null;
	
	$scope.read_question = function(questionId) {
		var url = 'http://s1.nextnobels.com/3rdparty/Filemanager/source/practice/all/'+questionId+'.mp3';

		if (current_sound) {
			current_sound.pause();
			current_sound.currentTime = 0;
			current_sound.onended();
		}
		if (current_sound_url == url) {
			current_sound_url = null;
			return;
		} else {
			current_sound_url = url;
		}
		jQuery('#sound-' + questionId).removeClass('fa-volume-up').addClass('fa-volume-off');
		if (1 || typeof question_audios[url] == 'undefined') {
			sound = new Audio(url);
			sound.loop = false;
			question_audios[url] = sound;
			sound.onended = function () {
				jQuery('#sound-' + questionId).removeClass('fa-volume-off').addClass('fa-volume-up');
			};
		}
		current_sound = question_audios[url];
		fetch(url)
			.then(function () {
				question_audios[url].play();
			});

	}

	$scope.register = {};
	$scope.doRegister = function (url) {
		if (!$scope.register.username || !$scope.register.name || !$scope.register.password || !$scope.register.repassword || !$scope.register.phone || !$scope.register.email || !$scope.register.sex || !$scope.register.areacode) {
			return false;
		}
		$scope.register.url = url;
		$scope.register.software = SOFTWARE;
		$scope.register.site = SITE;
		if ($scope.register.password == $scope.register.repassword) {
			jQuery.post(FL_API_URL + '/register/userRegister', $scope.register, function (resp) {
				$scope.register.success = resp.success;
				$scope.register.message = resp.message;
				$scope.$apply();
				if (resp.success) {
					window.location = resp.url;
				}
			});

		} else {
			$scope.register.success = 0;
			$scope.register.message = "Mật khẩu tài khoản nhập lại không chính xác";

		}

	};
	$scope.login = {};
	$scope.doLogin = function (url) {
		if (!$scope.login.username || !$scope.login.password) {
			return false;
		}
		$scope.login.url = url;
		$scope.login.software = SOFTWARE;
		$scope.login.site = SITE;
		jQuery.post(FL_API_URL + '/login/userLogin', $scope.login, function (resp) {
			$scope.login.success = resp.success;
			$scope.login.message = resp.message;
			$scope.$apply();
			if (resp.success) {
				window.location = resp.url;
			}

		});
	};
	// get AreaCode
	$scope.areaCodes = [];
	jQuery.ajax({
		url: FL_API_URL + '/register/getAreaCode', success: function (resp) {
			$scope.areaCodes = resp;
			$scope.$apply();
		}
	});

	$scope.katex = function(str) {
		var rs = str.replace(/\[\/[^\/]+\/\]/g, function(exp) {
			console.log(exp);
			exp = exp.replace('[/', '').replace('/]', '');
			console.log(exp);
			return katex.renderToString(exp, {
				throwOnError: false
			});
		});
		return rs;
	};
}]);