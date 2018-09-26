<?php
$userId = $userName = ''; 
if(isset($_SESSION['userId'])){
	$userId = $_SESSION['userId'];
} 
if(isset($_SESSION['username'])){
	$userName = $_SESSION['username'];
}
?>
<script type="text/javascript">
	var userId = <?= $userId; ?>;
	var username = '<?= $userName; ?>';
</script>
<style>
	.fix-menu{margin-bottom: 15px;}
</style>
<div class="full">
	<div class="container">
		<div class="t-weight text-center btn full mt-3 mb-3 btn-primary">Tài liệu học tập</div>
		<div class="full">
			<div class="row">
				<div class="col-12 col-md-2 pr-0">
					<?php include('common/left.php'); ?>
				</div>
				<div class="col-12 col-md-8">
					
					<div class="faq">
						<h4 class="text-center">Hỏi đáp Kinh Nghiệm Ôn thi vào trường Trần Đại Nghĩa</h4>
						<form role="form" id="createQuestions" method="post" >
							<input type="hidden" id="userId" name="userId" value="<?=$userId;?>">
							<input type="hidden"  id="username" name="username" value="<?=$userName;?>">
							<div class="form-group">
								<textarea type="text" class="form-control" style="height:60px;" id="question" name="question" placeholder="Mời bạn đặt câu hỏi"></textarea>
								<button ng-click="addQuestion()" type="button" class="btn btn-primary comment-button" style="margin-top:5px;">Gửi</button>
							</div>
						  
						</form>


						<div ng-repeat="question in questions" class="card p-3 mb-3 bg-light">
						    <div class="card-heading" >
						      <h4 class="card-title">
								
								<div style="font-size: 16px;" class="text-left">
									<span style="font-size: 16px;" class="badge badge-primary">{{question.username}}</span> {{question.question}}
						 		</div>
								<a  role="button" data-toggle="collapse"  href="#answer-{{$index}}" aria-expanded="false" aria-controls="collapseExample" style="color:blue; font-size: 14px;" class="">
									<button type="button" class="btn-xs btn-primary">Trả lời <span class="badge badge-light">{{question.ref_qusestion_answers.length}}</span></button>
								</a>
								 
						        
						      </h4>
						    </div>
						    <div id="answer-{{$index}}" class="collapse"  >
						      <div class="card card-body">
						        <blockquote>
						        	<div ng-repeat="answer in question.ref_qusestion_answers" class="text-left mb-2">
						        		<span class="badge badge-primary">{{answer.username}}</span>: {{answer.answer}}
						        	</div>
						        	
									<form role="form" method="post" >
										<div class="form-group">
											<div class="clearfix">
												<div style="float: left; width: 100%;">
													<textarea type="text" class="form-control" id="answer{{question.id}}" name="answer" placeholder="Trả lời"></textarea>
												</div>
												<div style="float:right;">
													<button ng-click="addAnswer(question.id)" type="submit" class="btn-xs btn-primary comment-button" style="margin-top:5px;">Trả lời</button>
												</div>
											</div>
										</div>
									</form>
								</blockquote>
							  </div>
						    </div>
						</div>
						<style>.page-item{display: inline-block;} </style>
						<nav aria-label="Page navigation example">
						  <ul style="display: block;" class="pagination">
						    <li class="page-item"><a class="page-link" href="#">Trang</a></li>
						    <li class="page-item" ng-repeat="page in pages" ng-class="{'active': page == curentPage}" ><a ng-click="pageAjax(this, page)" class="page-link" href="#">{{page}}</a></li>
						  </ul>
						</nav>


					</div>

				</div>
				<div class="col-12 col-md-2 pl-0">
					<?php include('common/right.php'); ?>

				</div>
			</div>
		</div>
		
	</div>
</div>
