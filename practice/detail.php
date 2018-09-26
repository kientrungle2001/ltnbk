<div class="full practice pb-5">
	<div class="container mt-4 mb-3">
		<div class="row redirect">
			&nbsp; &nbsp;
			<a href="/#practice">
			{{translate('Practice')}}
			</a>
			
			&nbsp; &nbsp; &gt; &nbsp; &nbsp;
			<a href="/detail.php?subject_id={{subject.id}}">{{translate(subject, 'category.name')}}</a>
			
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-3">
				<div class="main-shadow full" style="height: 600px; overflow-y: scroll;">
					<ul  class="nav nav-pills" id="pills-tab" role="tablist" style="background: #ddd;">
					  <li class="nav-item w-50">
					    <a style="border-radius: 5px 0px 0px 0px;" class="nav-link title-pr active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{translate('Practice')}}</a>
					  </li>
					  <li class="nav-item w-50">
					    <a style="border-radius: 0px 5px 0px 0px;" class="nav-link title-pr" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{translate('Vocabulary')}}</a>
					  </li>
					 
					</ul>
					<div class="tab-content" id="pills-tabContent">
					  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
					  	<ul  class="list-group menu-practice">
							<li class="list-group-item list-group-topic-item" ng-repeat="topic in topics | orderBy: 'ordering'" style="padding-bottom: 0" ng-class="{'active': selectedParentTopic === topic, 'no-top-bottom-padding': topic.displayAtSite==2}"> 
							<div ng-hide="topic.displayAtSite==2">
							<a href="#" style="position:relative;" onclick="return false;" ng-click="selectTopic(topic, topic)">{{translate(topic, 'category.name')}}</a>
								<i class="float-right fa fa-caret-down" aria-hidden="true" ng-show="topic.children.length > 0" style="position: absolute; top: 15px; right: 5px;"></i>
							</div>

								<div ng-show="subject.level==4">
									<ul class="list-group lv2" style="margin-left: -20px;margin-right: -20px;" ng-repeat="subTopic in topic.children">
										<li class="list-group-item" ng-repeat="subTopic2 in subTopic.children" ng-class="{'active sub-active': selectedTopic===subTopic2}">
											<a href="#" ng-click="selectTopic(subTopic2, topic)" onclick="return false;">{{translate(subTopic2, 'category.name')}}</a>
										</li>
									</ul>
								</div>
								<div ng-show="subject.level==3">
									<ul class="list-group lv2" style="margin-left: -20px;margin-right: -20px;">
										<li class="list-group-item" ng-class="{'active sub-active': selectedTopic===subTopic}" ng-repeat="subTopic in topic.children | orderBy: 'ordering'">
											<a href="#" ng-click="selectTopic(subTopic, topic)" onclick="return false;">{{translate(subTopic, 'category.name')}}</a>
										</li>
									</ul>
								</div>
							</li>
						</ul>
					  </div>
					  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
					  	<ul class="list-group vocabulary">
						  <li class="list-group-item" ng-repeat="vocabulary in vocabularies" ng-class="{'active sub-active': selectedVocabulary===vocabulary}"><a href="#" ng-click="selectVocabulary(vocabulary)" onclick="return false;">{{vocabulary.title_tdn || vocabulary.title}}</a></li>
						</ul>
					  </div>
					 
					</div>
				</div>
				
			</div>
			<div class="col-12 col-md-9">
				<div id="content" class="main-shadow full" ng-show="checkIsLogedIn()">
					<h2 class="text-center title">
					<span ng-hide="selectedTopic">Các chuyên đề</span>
					<span ng-show="selectedTopic">{{translate(selectedParentTopic, 'category.name')}} - {{translate(selectedTopic, 'category.name')}}</span>
					
					</h2>

					<div class="text-center guide" ng-show="action == 'practice' && !selectedTopic"><i class="fa fa-star" aria-hidden="true"></i> Hãy chọn chuyên đề để luyện tập <i class="fa fa-star" aria-hidden="true"></i></div>
					<div class="text-center guide" ng-show="action=='practice' && selectedTopic && subject_id != 88"><i class="fa fa-star" aria-hidden="true"></i> Hãy chọn bài để luyện tập <i class="fa fa-star" aria-hidden="true"></i></div>

					<div class="practice-content p-3 full" ng-show="action=='practice'">
						<div class="row" ng-show="subject_id != 88">
							<div class="col-12 col-md-2" ng-repeat="exerciseNum in exerciseNums" ng-click="selectExercise(exerciseNum)">
								<div class="btn lesson full mb-3 btn-primary" ng-class="{'active': selectedExerciseNum === exerciseNum}">Bài {{exerciseNum+1}}</div>
							</div>
						</div>
						
						<div class="do-practice full">
							
							<div ng-show="selectedExerciseNum !== null">
							
							<div class="name-detail text-center" ng-show="subject_id != 88">
								Bài {{selectedExerciseNum+1}}	
							</div>
							<div class="name-detail text-center" ng-show="subject_id == 88">
								{{translate(selectedTopic, 'category.name')}}
							</div>
							
							<div class="text-center">
								<div  class="time">
									<img src="http://fulllook.com.vn/Themes/Songngu3/skin/images/watch.png">
									<div id="countdown" class="num-time robotofont" style="color: rgb(255, 0, 0);">{{remaining.minutes}}:{{remaining.seconds}}</div>
								</div>
							</div>
							
							<div class="text-center" ng-show="step==='selectExercise'">
								<button class="btn btn-primary btn-lg" ng-click="startPractice()"> Bắt Đầu Làm Bài </button>
							</div>
							
							<div ng-show="step==='startPractice'">
							
							<div id="question" class="item">
							<p ng-bind-html="selectedTopic.content | sanitizer"></p>
							<div ng-repeat="question in questions">
								<div class="question full">
									<div class="item cau">
										<div class="stt">Câu:  {{$index+1}}</div>
										<span id="sound-{{question.id}}" class="btn volume fa fa-volume-up" ng-click="read_question( question.id );"
										ng-show="question.hasAudio"></span>
									</div>

									<div class="nobel-list-md choice">
										<div class="row">
											<div class="col" ng-show="language != 'vn'">
												<div class="ptnn-title full" mathjax-bind="question.name" ></div>
											</div>
											<div class="col" ng-show="language == 'vn' || language == 'ev'">
												<div class="ptnn-title full" mathjax-bind="question.name_vn" ></div>
											</div>
										</div>
									
										<table class="full">
											<tbody>
												<tr ng-repeat="answer in question.ref_question_answers" ng-class="{'bg-primary text-white': showAnswersStep=='showAnswers' && answer.status==1}">
													<td style="padding: 10px;">
														<input type="radio" class="float-left" name="question_answers_{{question.id}}" value="{{answer.id}}" ng-model="user_answers[question.id]" ng-disabled="practiceStep=='finishPractice'" ng-change="selectAnswer(question, answer)" />
														<div class="row">
														<div class="col" ng-show="language != 'vn'">
														<span class="answers_{{question.id}}_{{answer.id}}} pl10" mathjax-bind="answer.content" ></span>
														</div>
														<div class="col" ng-show="language=='vn'">
														<span class="answers_{{question.id}}_{{answer.id}}} pl10" mathjax-bind="answer.content_vn" ></span>
														</div>
														<div class="col" ng-show="language=='ev'">
														<span class="answers_{{question.id}}_{{answer.id}}} pl10" mathjax-bind="answer.content_vn"></span>
														</div>
														</div>

													</td>
												</tr>
												<tr class="bg-success text-white" ng-show="showAnswersStep=='showAnswers' && isRightAnswer(question)">
													<td style="padding: 10px;">
														Bạn đã trả lời đúng
													</td>
												</tr>
												<tr class="bg-warning text-white" ng-show="showAnswersStep=='showAnswers' && !isRightAnswer(question)">
													<td style="padding: 10px;">
														Bạn đã trả lời sai
													</td>
												</tr>
											</tbody>
										</table>
								
										<a href="#mobile-explan-{{question.id}}" class="explanation top10 btn btn-success btn-show-exp" data-toggle="collapse" ng-show="showAnswersStep=='showAnswers'">Xem lí giải
										</a>
								
										<div id="mobile-explan-{{question.id}}" class="collapse lygiai top10 item" ng-show="showAnswersStep=='showAnswers'">
											<div class="item mb-2" mathjax-bind="getExplaination(question)"></div>
									
											<div class="item">
												<div class="btn btn-danger" data-toggle="modal" data-target="#report{{question.id}}">
													Báo lỗi			
												</div>
										
												<div class="modal fade" id="report{{question.id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												  <div class="modal-dialog" role="document">
													<div class="modal-content">
													  <div class="modal-header">
														<button style="right: 15px;" type="button" class="close absolute" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

														<h4 class="modal-title" id="myModalLabel{{question.id}}">Báo lỗi</h4>
													  </div>
													  <div class="modal-body">
														 <div class="w100p">
															<label for="contentError{{question.id}}">Nội dung:</label>
															<textarea style="height: 150px !important;" id="contentError{{question.id}}" name="contentError" class="form-control" ng-model="report.content"></textarea>
														  </div>
											 
													  </div>
													  <div class="modal-footer">
														
														<button ng-click="reportError(question);" type="button" class="btn btn-primary">Báo lỗi</button>
													  </div>
													</div>
												  </div>
												</div>
										
											</div>
											<!--end report-->
									
										</div>
										<!--lí giải -->
									</div>
								</div>
								<div class="line-question">
								</div>
								<!--end question-->
							</div>
								
							</div>

							<div class="text-center full mb-3 relative">				
								<button id="finish-choice" class="btn btn-primary btt-practice " name="finish-choice" ng-click="finishPractice()" ng-disabled="practiceStep=='finishPractice'"><span class="fa fa-check"></span>
									Hoàn thành
								</button>
								<button id="view-result" class="btn btt-practice btn-success" data-toggle="modal" data-target="#resultModal" name="view-result"  ng-show="practiceStep=='finishPractice'"><span class="fa fa-list-alt"></span>
									Xem kết quả
								</button>
								<button id="show-answers" class="btn btt-practice btn-danger " name="show-answers" ng-click="showAnswers();" ng-show="practiceStep=='finishPractice'" ng-disabled="showAnswersStep=='showAnswers'"><span class="fa fa-check"></span>
								Xem đáp án
								</button>
							</div>

							</div>
							
							</div>

						</div>			

					</div>
					
					<div class="practice-content p-3 full" ng-show="action=='vocabulary'">
						<div class="do-practice full" ng-show="selectedVocabulary.trial == 1 || checkIsPaid()">
							<div class="name-detail text-center">
							{{selectedVocabulary.title}}
							</div>


							<ul class="nav nav-tabs" id="tabDocument" role="tablist">
							  <li class="nav-item">
							    <a class="nav-link title-pr active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Từ vựng</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link title-pr" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Kiểm tra từ vựng</a>
							  </li>
							
							</ul>
							<div class="tab-content" id="tabDocumentContent">
							  	<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
									<div class="text-justify pt-2 adjust-table table-responsive" mathjax-bind="parseTranslate(selectedVocabulary.content)">
									</div>
							  	</div>
								<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								
									<div class="item text-center pt-2">
										<input type="hidden" id="pageGame" name="pageGame" value="1">
										
										<span ng-repeat="game in gameTypes">
											<button  ng-click="gameWords(game);" ng-class="{'active': gameType===game}" ng-disabled="true!==gameEnables[game]" class="btn v_game btn-warning">Game {{$index +1}}</button>
										</span>
										
										<div class="item" id="resGame">
											<img class="item" src="http://s1.nextnobels.com/default/skin/nobel/test/themes/default/media/bg_game.jpg">
										</div>
									</div>

									<script type="text/javascript">
										
									</script>

								</div>
							  
							</div>

							
						</div>
						<div class="do-practice full" ng-hide="selectedVocabulary.trial == 1 || checkIsPaid()">
							<h2 class="text-center guide">Bạn phải <a href="/about.php#guide">mua phần mềm</a> mới được xem bài học này</h2>
						</div>

					</div>
					
					<img class="img-fluid full" src="/assets/images/bg-huongdan.png" />
				</div>

				<div class="main-shadow full" ng-hide="checkIsLogedIn()">
					<h2 class="text-center guide">Bạn phải <a href="#" onclick="return false" data-toggle="modal" data-target="#loginRegisterModal">đăng nhập</a> mới có thể học bài</h2>
					<img class="img-fluid full" src="/assets/images/bg-huongdan.png" />
				</div>
			</div>
		</div>
	</div>
</div>

<!--show result-->
<div class="modal" role="dialog" id="resultModal" aria-labelledby="gridSystemModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button style="right: 15px;" type="button" class="close absolute" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h3 class="modal-title text-center title-blue" id="gridSystemModalLabel"><b>Kết quả làm bài</b></h3>
			</div>
			
			<div class="modal-body">
				<div class="row">
						<div class="col-md-8 question_true control-label">Số câu trả lời đúng </div> 
						<div class="col-md-4 num_true title-blue">{{totalRights}}</div>
				</div>	
				<div class="row">	
					<div class="col-md-8 question_false control-label">Số câu trả lời sai </div> 
					<div class="col-md-4 num_false title-red">{{totalWrongs}}</div>
				</div>
				<div class="row">
					<div class="col-md-8 question_total control-label">Tổng số câu </div> 
					<div class="col-md-4 num_total">{{totalQuestions}}</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class=" full text-center">
					<button class="btn btn-sm btn-danger top10" onclick="window.location='/#practice'"> 
						<span >Chọn môn khác</span> 
						<span class="glyphicon glyphicon-arrow-left"></span>
					</button>
					<button id="show-answers-on-dialog" class="btn btn-sm btn-danger top10 " name="show-answers"  ng-click="showAnswers();" ng-show="practiceStep=='finishPractice'" ng-disabled="showAnswersStep=='showAnswers'" type="button" onclick="jQuery('#resultModal').modal('hide');">
						<span class="glyphicon glyphicon-check"></span>
						Xem đáp án							
					</button>
					<button type="button" class="btn btn-sm btn-success top10" onclick="jQuery('#resultModal').modal('hide'); jQuery(window).scrollTop(0)">
						<span class="glyphicon glyphicon-arrow-right hidden-xs"></span> Làm bài khác
					</button>
				</div>
			</div>
		</div>
	</div>
</div>


<style>
.list-group-topic-item {background-color: #fff !important;}
.list-group-topic-item.active {background-color: #fbd65b !important;}
.list-group-item.sub-active {background-color: #ffe693 !important;}
.list-group-item.sub-active > a {color: #333 !important;}

.adjust-table table {
	width: 100%;
	border-collapse: collapsed;
}
.adjust-table table td, .adjust-table table th {
	vertical-align: top;
	border: 1px solid grey;
}
.adjust-table table img {
	width: 100%;
	display: flex;
	height: auto;
}
.text-white {
	color: white !important;
}
.no-top-bottom-padding {
	padding-top: 0;
	padding-bottom: 0;
}
.ptnn-title img {
	max-width: 100%;
}
</style>

<script>
var question_audios = {};
var current_sound = null;
var current_sound_url = null;
function read_question(elem, url) {
	if(current_sound) {
		current_sound.pause();
		current_sound.currentTime = 0;
		current_sound.onended();
	}
	if(current_sound_url == url) {
		current_sound_url = null;
		return ;
	} else {
		current_sound_url = url;
	}
	jQuery(elem).removeClass('fa-volume-up').addClass('fa-volume-off');
	if(1 || typeof question_audios[url] == 'undefined') {
		sound = new Audio(url);
		sound.loop = false;	
		question_audios[url] = sound;
		sound.onended = function() {
			jQuery(elem).removeClass('fa-volume-off').addClass('fa-volume-up');
		};
	}
	current_sound = question_audios[url];
	fetch(url)
    .then(function() {
      question_audios[url].play();
    });
	
}
SOFTWARE = '<?php echo SOFTWARE?>';
SITE = '<?php echo SITE?>';
</script>
