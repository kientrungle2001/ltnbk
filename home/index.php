<div class="full pb-4 pt-2 bg-cloud text-center">
	<a href="/news_list.php?id=1377" class="btn btn-warning">Tin tức</a>
	<a href="/news_list.php?id=147" class="btn btn-info">Hướng dẫn sử dụng</a>
	<a href="/about.php#guide" class="btn btn-danger">Hướng dẫn mua</a>
	<a href="/document.php" class="btn btn-primary">Kinh nghiệm ôn thi</a>
	<a href="/gift.php" class="btn btn-success">Giải trí</a>
	<?php if(isset($_SESSION['userId'])){ ?>
	<a href="/profile.php" class="btn btn-warning">Lịch sử học tập</a>
	<?php } else {
		echo '<button onclick="return alert(\'Đăng nhập để xem lịch sử\');" class="btn btn-warning">Lịch sử học tập</button>';	
	} ?>
</div>
<div id="practice" class="full">
	<div class="container">
		<div style="margin-bottom: 15px;" class="text-center fs40 heading">
		Luyện tập các môn
		</div>
	</div>

	<div class="practice-section container">
		<div class="box-practice text-center" ng-repeat="subject in subjects">
			<a href="/detail.php?subject_id={{subject.id}}" class="subjectclick" data-subject="{{subject.id}}" data-alias="{{subject.alias}}" data-class="5">
				<div class="white text-uppercase relative">
					<div class="full">
						<img ng-src="http://s1.nextnobels.com{{subject.img}}" alt="{{translate(subject, 'category.name')}}" class=" img-fluid center-block">
					</div>
					<div class="top20 text-center full absolute">{{translate(subject, 'category.name')}}</div>
					
				</div>
			</a>
		</div>
	</div>

</div>
<img src="/assets/images/background1.png" alt="" class="full" />

<div id="ontienganh" class="full">
	<div class="container">
		<div class="text-center heading mt-2 mb-4 text-white  fs40">
		Ôn luyện Tiếng anh
		</div>
	</div>
	<div class="container">
		<div class="row" ng-init="selectedEnglishTestPage = 0">
			<div class="col-12 col-md-2" ng-repeat="test in englishTests" ng-show="inPage($index, selectedEnglishTestPage, 30)">
				<a href="/test.php?test_id={{test.id}}&category_id=1411">
					<div class="btn ltth full mb-3 btn-primary">{{translate(test, 'test.name')}} 
					<span ng-show="test.trial==1" class="badge badge-pill badge-danger">Free</span>
					</div>
					
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<nav aria-label="Navigation">
					<ul class="pagination justify-content-center">
						<li class="page-item" ng-repeat="page in range(1, totalPage(englishTests.length, 30), 1)" 
						ng-click="selectEnglishTestPage(page-1)"
						ng-class="{'active': selectedEnglishTestPage == page-1}"
						><a href="#" class="page-link" onclick="return false;">{{page}}</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	
</div>	


<!--end practice -->
<div id="tonghop" class="full">
	<div class="container">
		<div class="text-center heading mt-2 mb-4 text-white  fs40">
		Ôn luyện tổng hợp
		</div>
	</div>
	<div class="container">
		<div class="row" ng-init="selectedTestPage = 0">
			<div class="col-12 col-md-2" ng-repeat="test in tests" ng-show="inPage($index, selectedTestPage, 30)">
			<a href="/test.php?test_id={{test.id}}&category_id=1412">
				<div class="btn ltth full mb-3 btn-primary">{{translate(test, 'test.name')}}
				<span ng-show="test.trial==1" class="badge badge-pill badge-danger">Free</span>
				</div>
				
			</a>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<nav aria-label="Navigation">
					<ul class="pagination justify-content-center">
						<li class="page-item" ng-repeat="page in range(1, totalPage(tests.length, 30), 1)" 
						ng-click="selectTestPage(page-1)"
						ng-class="{'active': selectedTestPage == page-1}"
						><a href="#" class="page-link" onclick="return false;">{{page}}</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	
</div>	
<img src="/assets/images/background2.png" alt="" class="full" />



<!--end tonghop -->
<div id="thithu" class="full">
	<div class="container">
		<div class="text-center heading mt-2 mb-4 text-white">
			Thi thử Nguyễn Bỉnh Khiêm 
		</div>
	</div>
	<div class="container">
		<div class="row" ng-init="selectedTestSetPage = 0">
			<div class="box-thithu bg-white full-xs" ng-repeat="testSet in testSets | orderBy: 'ordering'" ng-show="inPage($index, selectedTestSetPage, 15)">
				<h3 class="text-center head-box"><a href="/testSet.php?category_id=1416&test_set_id={{testSet.id}}">{{translate(testSet, 'test.name')}}</a></h3>
				<div class="box-body">

					<div class="link-box text-center" ng-repeat="test in testSet.children | orderBy: 'ordering'">
						<a href="/testSet.php?category_id=1416&test_set_id={{testSet.id}}&test_id={{test.id}}" class="text-color">
							{{translate(test, 'test.name')}}  
							<span ng-show="test.trial==1" class="badge badge-pill badge-danger">Free</span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<nav aria-label="Navigation">
					<ul class="pagination justify-content-center">
						<li class="page-item" ng-repeat="page in range(1, totalPage(testSets.length, 15), 1)" 
						ng-click="selectTestSetPage(page-1)"
						ng-class="{'active': selectedTestSetPage == page-1}"
						><a href="#" class="page-link" onclick="return false;">{{page}}</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>
<!--end thithu -->	
<!-- <div class="full bg3">
	<div class="text-white text-center mt-2 mb-3  heading">
		Đề thi Trần Đại Nghĩa các năm
	</div>
	<div class="container">
		<div class="row">
			<div class="box-tdn bg-white full-xs" ng-repeat="testSet in realTestSets">
				<h3 class="text-center head-tdn"><a href="/testSet.php?category_id=1414&test_set_id={{testSet.id}}">{{translate(testSet, 'test.name')}}</a></h3>
				<div class="box-body">
					<div class="link-box text-center" ng-repeat="test in testSet.children | orderBy: 'ordering'">
						<a href="/testSet.php?category_id=1414&test_set_id={{testSet.id}}&test_id={{test.id}}" class="text-color">
							{{translate(test, 'test.name')}}
							<span ng-show="test.trial==1" class="badge badge-pill badge-danger">Free</span>
						</a>
						
					</div>
												
				</div>	
			</div>
		</div>
	</div>
</div> -->
<!--end-->
<img src="/assets/images/lydo.png" alt="" class="full" />

<div class="full bg4">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
				<h3 class="heading text-uppercase text-center mb-3 text-white">đăng ký tư vấn</h3>
				
				<form method="post">
					<div class="form-group mb-4">
					    <input type="text" ng-model="advice.name" class="form-control input" placeholder="Họ tên" required>
					    
					</div>
					<div class="form-group mb-4">
					    <input type="text" ng-model="advice.phone" class="form-control input" placeholder="Số điện thoại" required>					    
					</div>
					<div class="form-group mb-4">
					    <input type="email" ng-model="advice.email" class="form-control input" placeholder="Email" required>
					    
					</div>
					<div class="form-group alert" ng-class="{'alert-danger': advice.success == 0, 'alert-success': advice.success== 1}" ng-show="advice.success" ng-bind-html="advice.message">
						
					</div>
					<div class="form-group text-center">						
						<input type="submit" class="btn dangki" ng-click="registerForAdvice()" value="ĐĂNG KÝ">
						
					</div>
				</form>
			</div>
			<div class="col-12 col-md-6">
				<h3 class="heading text-uppercase mb-3 text-center text-white">Học phí</h3>
				<div class="box-hocphi full text-center">
					<div class="hocphi full">
						Học và ôn thi bằng tiếng Việt,<br>  
						tiếng anh và song ngữ  <br> 
						Chỉ <span class="fs29">700.000</span> VNĐ <br> 
						CHO<span class="fs29">1 năm</span> sử dụng<br> 
					</div>
					
					<a href="/about.php#guide" class="buynow full">
						Mua ngay
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end-->

<div class="full bg5">
	<div class="text-white text-center mt-5 mb-3  heading">
		người dùng nói gì về Full Look?
	</div>
	<div class="full  d-none d-sm-block">
		<div class="container">
			<div id="slidebootstrap" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">	
					<div class="carousel-item active">
						<div class="row">
							<div class="col-md-6 col-12">
							 <div class="thumbnail relative">
							 
								 <p class="text-justify"> Một phần mềm bắt kịp xu hướng đổi mới của nền Giáo dục, đó là xu hướng dạy học, kiểm tra đánh giá theo hướng phát triển năng lực của học sinh. Cái hay nhất của nó là tất cả những nội dung ấy được diễn đạt bằng thứ tiếng Anh vừa đơn giản, vừa chuẩn mực.											 </p>
								 <i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
							  </div>
								
								<div class="media">
								  <div class="media-left">
									<a href="#">
									  
										<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
											<img class="media-object" src="http://www.fulllooksongngu.com/Default/skin/nobel/Themes/Story/media/11.jpg" alt="Sandy" style="width:80px;">
										</div>
									</a>
								  </div>
								  <div class="media-body white text-left">
									<b>Chuyên gia Sandra</b><br> (Giảng viên khoa quốc tế, đại học quốc gia HN)					  </div>
								</div>
							 
							</div>

							<div class="col-12 col-md-6">
							<div class="thumbnail relative">
		      
								<p class="text-justify">
								Các câu hỏi, bài tập của Full Look được thiết kế rất phù hợp với định hướng PHÁT TRIỂN NĂNG LỰC TOÀN DIỆN cho HS Tiểu học, cập nhật với xu hướng đánh giá năng lực trên thế giới. Từ đó, giúp HS có thể kết nối, vận dụng những kiến thức được học trong nhà trường vào xử lí những tình huống thực tiễn trong cuộc sống.
								</p>
								<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
							</div>
							
							
							<div class="media">
							  <div class="media-left">
								<a href="#">
								  
									<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
										<img class="media-object" src="http://www.fulllooksongngu.com/Default/skin/nobel/Themes/Story/media/hoanguyen.jpg" alt="Sandy" style="width:80px;">
									</div>
								</a>
							  </div>
							  <div class="media-body white text-left">
								(TS. Nguyễn Thị Hảo – Chuyên viên nghiên cứu, Viện Khoa học Giáo dục Việt Nam chuyên gia lĩnh vực đọc hiểu trong chương trình đánh giá HS Quốc tế PISA)
							  </div>
							</div>
							
						</div>

						</div>
						
						
						
						
					</div>
					
					<div class="carousel-item">
						<div class="row">
						<div class="col-12 col-md-6">
							<div class="thumbnail relative">
		      
								<p class="text-justify">Lần đầu tiên ở Việt Nam có phần mềm Song ngữ Anh - Việt cho mọi môn học. Đó là xu hướng của giáo dục hiện đại và nhiều trường cấp 2  trên toàn quốc đã thí điểm mô hình này. Việc xây dựng chương trình song ngữ cho cấp Tiểu học là bước đà để các em có thể bắt nhịp với xu hướng mới khi lên cấp 2, giúp các em từng bước tiếp cận kiến thức mới, tránh áp lực dồn tích, tạo nền tảng vững chắc cho quá trình tìm kiếm học bổng và quá trình hoà nhập với môi trường học tập quốc tế sau này.						</p>
								<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
							</div>
							
							
							<div class="media">
							  <div class="media-left">
								<a href="#">
								  
									<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
										<img class="media-object" src="http://www.fulllooksongngu.com/Default/skin/nobel/Themes/Story/media/12.jpg" alt="Sandy" style="width:80px;">
									</div>
								</a>
							  </div>
							  <div class="media-body white text-left">
								<b>Tiến Sĩ Nguyễn Thanh Tùng</b> <br> (Đại học Sư Phạm Hà Nội)					  </div>
							</div>
							
						</div>
						
						<!--2 -->
						<div class="col-sm-5 offset-md-1 col-md-5 col-xs-12">
						  <div class="thumbnail relative">
						  	<p class="text-justify">Đây là cách học Song ngữ cho mọi môn học lần đầu tiên ở Việt Nam. Với 3 chế độ hiển thị ngôn ngữ (Tiếng Anh, Tiếng Việt hoặc Song ngữ) tuỳ người dùng lựa chọn, tôi thấy đây là phần mềm có khả năng ứng dụng cao với nhiều đối tượng HS khác nhau trên toàn quốc. Nội dung các câu hỏi gần gũi thực tế, cập nhật và thiết thực, đặc biệt có sức khơi mở tư duy cho HS.					</p>
							<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
						  </div>
						  <div class="media">
							  <div class="media-left">
							  	<a href="#">
								  
									<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
										<img class="media-object" src="http://www.fulllooksongngu.com/Default/skin/nobel/Themes/Story/media/chinga.png" alt="Sandy" style="width:80px;">
									</div>
								</a>
							  </div>
							  <div class="media-body white text-left">
								<b>Chị Trần Việt Nga</b> <br> (Báo Giáo dục &amp; Thời đại)
							  </div>
						  </div>


						</div>
						
						</div>
					</div>
				<!-- Left and right controls -->
				   <a class="carousel-control-prev" href="#slidebootstrap" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#slidebootstrap" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
			</div>
		</div>
	</div>
	<div class="full d-block d-sm-none">
		<div class="container ">
			<div id="slidebootstrap-mb" class="carousel slide text-center" data-ride="carousel">
				<div class="carousel-inner" role="listbox">	
					<div class="carousel-item active">
							<div class="thumbnail">
								<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
									<img src="http://www.fulllooksongngu.com/Default/skin/nobel/Themes/Story/media/11.jpg" alt="Sandy" style="width:80px;">
								</div>
								<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i>  Một phần mềm bắt kịp xu hướng đổi mới của nền Giáo dục, đó là xu hướng dạy học, kiểm tra đánh giá theo hướng phát triển năng lực của học sinh. Cái hay nhất của nó là tất cả những nội dung ấy được diễn đạt bằng thứ tiếng Anh vừa đơn giản, vừa chuẩn mực.<br>
								<strong><b>Chuyên gia Sandra</b><br> (Giảng viên khoa quốc tế, đại học quốc gia HN)</strong><i class="fa fa-quote-right fa-2x"></i></p>
							</div>
					</div>
					
					<div class="carousel-item">
						
							<div class="thumbnail">
		      
								<p class="text-justify">
								Các câu hỏi, bài tập của Full Look được thiết kế rất phù hợp với định hướng PHÁT TRIỂN NĂNG LỰC TOÀN DIỆN cho HS Tiểu học, cập nhật với xu hướng đánh giá năng lực trên thế giới. Từ đó, giúp HS có thể kết nối, vận dụng những kiến thức được học trong nhà trường vào xử lí những tình huống thực tiễn trong cuộc sống.
								</p>
								<i class="fa absolute care white fa-sort-desc" aria-hidden="true"></i>
							</div>
							
							
							<div class="media">
							  <div class="media-left">
								<a href="#">
								  
									<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
										<img class="media-object" src="http://www.fulllooksongngu.com/Default/skin/nobel/Themes/Story/media/hoanguyen.jpg" alt="Sandy" style="width:80px;">
									</div>
								</a>
							  </div>
							  <div class="media-body white text-left">
								(TS. Nguyễn Thị Hảo – Chuyên viên nghiên cứu, Viện Khoa học Giáo dục Việt Nam chuyên gia lĩnh vực đọc hiểu trong chương trình đánh giá HS Quốc tế PISA)
							  </div>
							</div>
							
							
						</div>
					
					<div class="carousel-item">
						
							<div class="thumbnail">
								<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
									<img src="http://www.fulllooksongngu.com/Default/skin/nobel/Themes/Story/media/12.jpg" alt="Anh Tùng" style="width:80px;">
								</div>
								<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> Lần đầu tiên ở Việt Nam có phần mềm Song ngữ Anh - Việt cho mọi môn học. Đó là xu hướng của giáo dục hiện đại và nhiều trường cấp 2  trên toàn quốc đã thí điểm mô hình này. Việc xây dựng chương trình song ngữ cho cấp Tiểu học là bước đà để các em có thể bắt nhịp với xu hướng mới khi lên cấp 2, giúp các em từng bước tiếp cận kiến thức mới, tránh áp lực dồn tích, tạo nền tảng vững chắc cho quá trình tìm kiếm học bổng và quá trình hoà nhập với môi trường học tập quốc tế sau này.<br>
								<strong><b>Tiến Sĩ Nguyễn Thanh Tùng</b> <br> (Đại học Sư Phạm Hà Nội)</strong><i class="fa fa-quote-right fa-2x"></i>
								</p>
							</div>
						
					</div>
					
					<div class="carousel-item">
						
							<div class="thumbnail">
								<div class="img-circle" style="display: inline-block; width: 80px; height: 80px; overflow: hidden;">
									<img src="http://www.fulllooksongngu.com/Default/skin/nobel/Themes/Story/media/chinga.png" alt="Chị Nga" style="width:80px;">
								</div>
								<p class="text-justify"><i class="fa fa-quote-left fa-2x"></i> Đây là cách học Song ngữ cho mọi môn học lần đầu tiên ở Việt Nam. Với 3 chế độ hiển thị ngôn ngữ (Tiếng Anh, Tiếng Việt hoặc Song ngữ) tuỳ người dùng lựa chọn, tôi thấy đây là phần mềm có khả năng ứng dụng cao với nhiều đối tượng HS khác nhau trên toàn quốc. Nội dung các câu hỏi gần gũi thực tế, cập nhật và thiết thực, đặc biệt có sức khơi mở tư duy cho HS.<br>
								<strong><b>Chị Trần Việt Nga</b> <br> (Báo Giáo dục &amp; Thời đại)</strong><i class="fa fa-quote-right fa-2x"></i>
								</p>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="text-center heading mt-5 mb-3 full text-white">
		THỐNG KÊ
	</div>
	<div class="full mb-5">
		<div class="container mgb50">
			<div class="row">
				<div class="col-md-3 col-12"> 
					<b class="fff223 fs28">19453</b> <span class="fs16 white"> Thành viên </span>	
				</div>		
				<div class="col-md-3 col-12"> 
					<b class="fff223 fs28">1564</b> <span class="fs16 white">
			 		Thành viên mới		</span>	
				</div>	
				<div class="col-md-3 col-12"> 
					<b class="fff223 fs28">4</b> <span class="fs16 white">
					Người đang học trực tuyến		
			 		</span>	
			 	</div>
				<div class="col-md-3 col-12"> 
					<span class="fs16 white">
					Thành viên mới nhất: </span><b class="white">kiennguyenmai</b>
				</div>
			</div>
		</div>
	</div>
</div>
<script>	
		SOFTWARE = '<?php echo SOFTWARE?>';
		SITE = '<?php echo SITE?>';
</script>