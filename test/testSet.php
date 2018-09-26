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
					  <li class="list-group-item list-group-test-set-item" ng-repeat="testSet in leftTestSets" ng-class="{'active': testSet==selectedTestSet}" style="padding: 0">
					  
					  <a href="#" ng-click="selectTestSet(testSet)" style="padding: 15px; display: inline-block;" onclick="return false;">{{translate(testSet, 'test.name')}} {{testSet.trial ? ' - Free': ''}}</a>


					  <ul class="list-group" style="margin: 0;">
					  	<li class="list-group-item" ng-repeat="test in testSet.children" style="border: none !important;" ng-class="{'active sub-active': selectedTest === test}">
						  <a href="#" ng-click="selectTest(testSet, test)" style="border: none;" onclick="return false;">&nbsp;&nbsp;&nbsp;&nbsp; {{translate(test, 'test.name')}} {{test.trial ? ' - Free': ''}}</a>
						</li>
					  </ul>
					  </li>
					</ul>
				</div>
				
			</div>
			<div class="col-12 col-md-9">
				<div class="main-shadow full">
					<h2 class="text-center title" ng-show="selectedTestSet && selectedTest">{{translate(selectedTestSet, 'test.name')}} - {{translate(selectedTest, 'test.name')}}</h2>
					<h2 class="text-center title" ng-hide="selectedTest">Hãy chọn một đề trong {{translate(selectedTestSet, 'test.name')}}</h2>
					<div class="row">
						<div class="col-md-12 text-center pt-5">
							<div ng-show="selectedTestSet && !selectedTest">
								<h2>Chọn một phần để bắt đầu làm</h2>
								<button class="btn btn-primary" ng-repeat="test in selectedTestSet.children" style="margin-right: 15px;" ng-click="selectTest(selectedTestSet, test)">{{translate(test, 'test.name')}}</button>
							</div>
							
						</div>
					</div>
					<div class="practice-content p-3 full">
						<div class="do-practice full" ng-show="step=='selectTest'" style="text-align: center; padding-top: 50px;">
							<h2>{{translate(selectedTestSet, 'test.name')}} - {{translate(selectedTest, 'test.name')}}</h2>
							<p><strong>Dạng đề</strong>: {{selectedTest.trytest === 2 ? 'Tự luận': 'Trắc nghiệm'}}</p>
							<p><strong>Số lượng câu hỏi</strong>: {{selectedTest.quantity || 24}}</p>
							<p><strong>Thời gian làm bài</strong>: {{selectedTest.time || 45}} phút</p>
							<p ng-show="selectedTest.trytest === 2"><strong>Lưu ý: Đề tự luận học sinh chỉ được xem đề và đáp án, phần mềm không chấm bài làm của học sinh</strong></p>
							<button ng-click="doTest()" class="btn btn-primary btn-lg">Bắt đầu làm</button>
						</div>
						<div class="do-practice full" ng-show="step=='doTest'">
							<div class="text-center">
								<h2>{{translate(selectedTestSet, 'test.name')}} - {{translate(selectedTest, 'test.name')}}</h2>
								<p><strong>Số lượng câu hỏi</strong>: {{total_question || 24}}</p>
								<p><strong>Thời gian làm bài</strong>: {{total_time || 45}} phút</p>
								<div  class="time">
									<img src="http://fulllook.com.vn/Themes/Songngu3/skin/images/watch.png">
									<div id="countdown" class="num-time robotofont" style="color: rgb(255, 0, 0);">{{remaining.minutes || 45}}:{{remaining.seconds || 0}}</div>
								</div>
							</div>
							
							<div id="question" class="item" ng-repeat="question in questions">
								<div class="question full">
									<div class="item cau">
										<div class="stt">Câu:  {{$index + 1}}</div>
										<span id="sound-{{question.id}}" class="btn volume fa fa-volume-up" ng-click="read_question( question.id );"
										ng-show="question.hasAudio"></span>
									</div>

									<div class="nobel-list-md choice">
										<div class="row">
											<div class="col" ng-show="language!='vn'">
												<div class="ptnn-title full" mathjax-bind="selectedTest.trytest == 2 ? formatWritting(question.name): question.name"> 
												</div>
											</div>
											<div class="col" ng-show="language=='vn' || language=='ev'">
												<div class="ptnn-title full" mathjax-bind="selectedTest.trytest == 2 ? formatWritting(question.name_vn): question.name_vn"> 
												</div>
											</div>
										</div>
									
										<table class="full">
											<tbody>
												<tr ng-repeat="answer in question.ref_question_answers" ng-class="{'bg-primary text-white': showAnswerStep=='showAnswerStep' && answer.status==1}">
													<td style="padding: 10px;">
														<input type="radio" class="float-left" name="question_answers_{{question.id}}" value="{{answer.id}}" ng-model="user_answers[question.id]" ng-disabled="finishStep=='finishStep'" ng-change="selectAnswer(question, answer)" />

														<div class="row">
															<div class="col" ng-show="language != 'vn'">
																<span class="answers_{{question.id}}_{{answer.id}}} pl10" mathjax-bind="answer.content"></span>
															</div>
															<div class="col" ng-show="language == 'vn' || language == 'ev'">
																<span class="answers_{{question.id}}_{{answer.id}}} pl10" mathjax-bind="answer.content_vn"></span>
															</div>
														</div>

													</td>
												</tr>
												<tr class="bg-success text-white" ng-show="selectedTest.trytest !==2 && showAnswerStep=='showAnswerStep' && isRightAnswer(question)">
													<td style="padding: 10px;">
														Bạn đã trả lời đúng
													</td>
												</tr>
												<tr class="bg-warning text-white" ng-show="selectedTest.trytest !==2 &&showAnswerStep=='showAnswerStep' && !isRightAnswer(question)">
													<td style="padding: 10px;">
														Bạn đã trả lời sai
													</td>
												</tr>
											</tbody>
										</table>
								
										<a href="#mobile-explan-{{question.id}}" class="explanation top10 btn btn-success btn-show-exp" data-toggle="collapse" ng-show="showAnswerStep=='showAnswerStep'">Xem lí giải
										</a>
								
										<div id="mobile-explan-{{question.id}}" class="collapse lygiai top10 item" ng-show="showAnswerStep=='showAnswerStep'">
											<div class="item mb-2" mathjax-bind="getExplaination(question)">
											</div>
									
											<div class="item">
												<div class="btn btn-danger" data-toggle="modal" data-target="#report{{question.id}}">
													Báo lỗi			
												</div>
										
												<div class="modal fade" id="report{{question.id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												  <div class="modal-dialog" role="document">
													<div class="modal-content">
													  <div class="modal-header">
														<button style="right: 15px;" type="button" class="close absolute" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

														<h4 class="modal-title" id="myModalLabel">Báo lỗi</h4>
													  </div>
													  <div class="modal-body">
														 <div class="w100p">
															<label for="exampleInputEmail1">Nội dung:</label>
															<textarea style="height: 150px !important;" id="contentError{{question.id}}" name="contentError" class="form-control" ng-model="report[question.id]"></textarea>
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

							<div class="text-center full mb-3 relative" ng-show="selectedTest.trytest==2">
								<button id="finish-choice" class="btn btn-primary btt-practice " name="finish-choice" ng-click="finishTest()" ng-disabled="finishStep == 'finishStep'"><span class="fa fa-check"></span>
									Xem đáp án
								</button>
							</div>

							<div class="text-center full mb-3 relative" ng-show="selectedTest.trytest !== 2">				
								<button id="finish-choice" class="btn btn-primary btt-practice " name="finish-choice" ng-click="finishTest()" ng-disabled="finishStep == 'finishStep'"><span class="fa fa-check"></span>
									Hoàn thành
								</button>
								<button id="view-result" class="btn btt-practice btn-success" data-toggle="modal" data-target="#resultModal" name="view-result"  ng-show="finishStep == 'finishStep'"><span class="fa fa-list-alt"></span>
									Xem kết quả					
								</button>
								<button id="show-answers" class="btn btt-practice btn-danger " name="show-answers"  ng-show="finishStep == 'finishStep'" ng-disabled="showAnswerStep=='showAnswerStep'" ng-click="showAnswer()"><span class="fa fa-check"></span>
								Xem đáp án					
								</button>
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
											<div class="col-md-8 question_true control-label">Thời gian làm bài </div> 
											<div class="col-md-4 num_true title-blue">{{duringTime}} giây</div>
									</div>	
									
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
									<div class="row">
										<div class="col-md-8 question_total control-label">Xếp hạng </div> 
										<div class="col-md-4 num_total">{{rating}}</div>
									</div>
									<div class="row">
										<div class="col-md-8 question_total control-label">Trên tổng số </div> 
										<div class="col-md-4 num_total">{{totalDoings}}</div>
									</div>
								</div>
								<div class="modal-footer">
									<div class=" full text-center">
										<button id="show-answers-on-dialog" class="btn btn-sm btn-danger top10 " name="show-answers" ng-disabled="showAnswerStep=='showAnswerStep'" ng-click="showAnswer()" data-dismiss="modal" onclick="jQuery('#resultModal').modal('hide'); return false;" type="button">
											<span class="glyphicon glyphicon-check"></span>
											Xem đáp án
										</button>
										<button type="button" class="btn btn-sm btn-success top10" onclick="jQuery('#resultModal').modal('hide'); jQuery(window).scrollTop(0);">
											<span class="glyphicon glyphicon-arrow-right hidden-xs"></span> Làm đề khác
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
.list-group-test-set-item {background-color: #bbb;}
.list-group-test-set-item.active {background-color: #fbd65b;}
.list-group-item.sub-active {background-color: #ffe693;}
.list-group-item.sub-active > a {color: #333;}
.ptnn-title img {max-width: 100%}
</style>
<script>	
		SOFTWARE = '<?php echo SOFTWARE?>';
		SITE = '<?php echo SITE?>';
</script>