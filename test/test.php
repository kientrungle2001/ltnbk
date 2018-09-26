<div class="full practice pt-4 pb-5">

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-3">
				<div class="main-shadow full">
					<div class="full">
						<div style="border-radius: 5px 0px 0px 0px;" class="nav-link text-center title-pr text-white bg-primary">
						{{translate(category, 'category.name')}}</div>
					</div>
					
				  	<ul class="list-group full vocabulary">
					  <li class="list-group-item" ng-repeat="test in tests" ng-show="language=='vn'" ng-class="{'active sub-active': test==selectedTest}"><a href="#" ng-click="selectTest(test)" onclick="return false;">{{test.name || test.name_en}} {{test.trial? ' - Free': ''}}</a></li>
					  <li class="list-group-item" ng-repeat="test in tests" ng-show="language!='vn'" ng-class="{'active sub-active': test==selectedTest}"><a href="#" ng-click="selectTest(test)" onclick="return false;">{{test.name_en || test.name}} {{test.trial? ' - Free': ''}}</a></li>
					</ul>
				</div>
				
			</div>
			<div class="col-12 col-md-9">
				<div class="main-shadow full">
					<h2 class="text-center title">{{translate(category, 'category.name')}}</h2>
					<div class="practice-content p-3 full">
						<div class="do-practice full" ng-show="step=='selectTest'" style="text-align: center; padding-top: 50px;">
							<h2>{{translate(selectedTest, 'test.name')}}</h2>
							<p><strong>Dạng đề</strong>: {{selectedTest.trytest === 2 ? 'Tự luận': 'Trắc nghiệm'}}</p>
							<p><strong>Số lượng câu hỏi</strong>: {{selectedTest.quantity || 24}}</p>
							<p><strong>Thời gian làm bài</strong>: {{selectedTest.time || 45}} phút</p>
							<button ng-click="doTest()" class="btn btn-primary btn-lg">Bắt đầu làm</button>
						</div>
						<div class="do-practice full" ng-show="step=='doTest'">
							<div class="text-center">
								<h2>{{translate(selectedTest, 'test.name')}}</h2>
								<p><strong>Dạng đề</strong>: {{selectedTest.trytest === 2 ? 'Tự luận': 'Trắc nghiệm'}}</p>
								<p><strong>Số lượng câu hỏi</strong>: {{selectedTest.quantity || 24}}</p>
								<p><strong>Thời gian làm bài</strong>: {{selectedTest.time || 45}} phút</p>
							</div>
							<div class="text-center">
								<div  class="time">
									<img src="http://fulllook.com.vn/Themes/Songngu3/skin/images/watch.png">
									<div id="countdown" class="num-time robotofont" style="color: rgb(255, 0, 0);">{{remaining.minutes}}:{{remaining.seconds}}</div>
								</div>
							</div>
							
							<div class="item" ng-repeat="question in questions">
								<div class="question full">
									<div class="item cau">
										<div class="stt">Câu:  {{$index + 1}}</div>
										<span id="sound-{{question.id}}" class="btn volume fa fa-volume-up" ng-click="read_question( question.id );"
										ng-show="question.hasAudio"></span>
									</div>

									<div class="nobel-list-md choice">
										<div class="row">
											<div class="col" ng-show="language!='vn'">
												<div class="ptnn-title full" mathjax-bind="question.name"> 
												</div>
											</div>
											<div class="col" ng-show="language=='vn' || language=='ev'">
												<div class="ptnn-title full" mathjax-bind="question.name_vn"> 
												</div>
											</div>
										</div>

										<table class="table">
											<tbody>
												<tr ng-repeat="answer in question.ref_question_answers" ng-class="{'bg-primary text-white': showAnswersStep=='showAnswers' && answer.status}">
													<td style="padding: 10px;">
														<input id="answer_question_{{question.id}}_{{answer.id}}" name="user_answers[{{question.id}}]" type="radio" ng-model="user_answers[question.id]" ng-change="selectAnswer(question, answer)" class="float-left" value="{{answer.id}}" />
														<div class="row">
															<div class="col" ng-show="language!='vn'">
																<label class="inline" mathjax-bind="answer.content" for="answer_question_{{question.id}}_{{answer.id}}">
																</label>
															</div>
															<div class="col" ng-show="language=='vn' || language=='ev'">
																<label class=" inline" mathjax-bind="answer.content_vn" for="answer_question_{{question.id}}_{{answer.id}}">
																</label>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>

										<div class="clearfix text-white p-1" ng-show="showAnswersStep=='showAnswers' && isRightAnswer(question)" ng-class="{'bg-success': isRightAnswer(question)}">Bạn đã làm đúng câu này</div>

										<div class="clearfix text-white p-1" ng-show="showAnswersStep=='showAnswers' && !isRightAnswer(question)" ng-class="{'bg-warning': !isRightAnswer(question)}">Bạn đã làm sai câu này</div>
								
										<a href="#mobile-explan-{{question.id}}" class="explanation top10 btn btn-success btn-show-exp" 
												data-toggle="collapse" ng-show="showAnswersStep=='showAnswers'">Xem lí giải
										</a>
								
										<div id="mobile-explan-{{question.id}}" class="collapse lygiai top10 item" 
												ng-show="showAnswersStep=='showAnswers'">
											<div class="item mb-2" mathjax-bind="getExplaination(question)">
											</div>
									
											<div class="item">
												<div class="btn btn-danger" data-toggle="modal" data-target="#report474">
													Báo lỗi			
												</div>
										
												<div class="modal fade" id="report474" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												  <div class="modal-dialog" role="document">
													<div class="modal-content">
													  <div class="modal-header">
														<button style="right: 15px;" type="button" class="close absolute" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

														<h4 class="modal-title" id="myModalLabel">Báo lỗi</h4>
													  </div>
													  <div class="modal-body">
														 <div class="w100p">
															<label>Nội dung:</label>
															<textarea style="height: 150px !important;" id="contentError474" name="contentError" class="form-control" ng-model="report[question.id]"></textarea>
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

							<div class="text-center full mb-3 relative">				
								<button id="finish-choice" class="btn btn-primary btt-practice" name="finish-choice" 
									ng-click="finishTest();" ng-disabled="testStep=='finishTest'"><span class="fa fa-check"></span>
									Hoàn thành					
								</button>
								<button id="view-result" class="btn btt-practice btn-success" 
									data-toggle="modal" data-target="#resultModal" 
									name="view-result" 
									ng-show="step=='doTest' && testStep=='finishTest'"><span class="fa fa-list-alt"></span>
									Xem kết quả					
								</button>
								<button id="show-answers" class="btn btt-practice btn-danger " name="show-answers" 
									ng-click="showAnswers();" 
									ng-show="step=='doTest' && testStep=='finishTest'"
									ng-disabled="showAnswersStep=='showAnswers'"
									 ><span class="fa fa-check"></span>
									Xem đáp án
								</button>
							</div>
						</div>			
					</div>

					<!--show result-->
					<div class="modal" role="dialog" id="resultModal" aria-labelledby="resultModalLabel" aria-hidden="false">
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
										<button id="show-answers-on-dialog" class="btn btn-sm btn-danger top10 " name="show-answers" 
											ng-click="showAnswers()" onclick="jQuery('#resultModal').modal('hide');" type="button"
											ng-disabled="showAnswersStep=='showAnswers'">
											<span class="glyphicon glyphicon-check"></span>
											Xem đáp án							
										</button>
										<button type="button" class="btn btn-sm btn-success top10" onclick="jQuery('#resultModal').modal('hide'); jQuery(window).scrollTop(0);">
											<span class="glyphicon glyphicon-arrow-right hidden-xs"></span> Làm bài khác
										</button>
										
									</div>
								</div>
							</div>
						</div>
					</div>

					<img class="img-fluid full" src="/assets/images/bg-huongdan.png">
				</div>
			</div>
		</div>
	</div>
</div>

<style>
.text-white {color: white !important;}
.list-group-test-set-item {background-color: #bbb;}
.list-group-test-set-item.active {background-color: #fbd65b;}
.list-group-item.sub-active {background-color: #ffe693;}
.list-group-item.sub-active > a {color: #333;}
.inline {display: inline;}
</style>
<script>	
		SOFTWARE = '<?php echo SOFTWARE?>';
		SITE = '<?php echo SITE?>';
</script>