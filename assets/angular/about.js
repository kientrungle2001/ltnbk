flApp.controller('AboutController', ['$scope', function($scope) {
	$scope.title = 'Công ty cổ phần giáo dục và phát triển trí tuệ sáng tạo Next Nobels';
	$scope.language = 'vn';
	$scope.changeLanguage = function() {
		window.localStorage.setItem('language', $scope.language);
	}
	$scope.register = {};
	$scope.doRegister = function(url){
		if(!$scope.register.username || !$scope.register.name || !$scope.register.password || !$scope.register.repassword || !$scope.register.phone || !$scope.register.email || !$scope.register.sex || !$scope.register.areacode){
			return false;
		}		
		$scope.register.url = url;
		$scope.register.software = SOFTWARE;
		$scope.register.site = SITE;
		if($scope.register.password == $scope.register.repassword){
			jQuery.post(FL_API_URL+'/register/userRegister',$scope.register, function(resp) {
				$scope.register.success = resp.success;
				$scope.register.message = resp.message;
				$scope.$apply();
				if(resp.success) {
					window.location = resp.url;
				}
			});
					
		}else{
			$scope.register.success =0;
			$scope.register.message ="Mật khẩu tài khoản nhập lại không chính xác";
			
		}
		
	};
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
	$scope.login = {};
	$scope.doLogin = function(url) {
		if(!$scope.login.username || !$scope.login.password){
			return false;
		}
		$scope.login.url = url;
		$scope.login.software = SOFTWARE;
		$scope.login.site = SITE;
		jQuery.post(FL_API_URL+'/login/userLogin', $scope.login, function(resp) {
			$scope.login.success = resp.success;
			$scope.login.message = resp.message;
			$scope.$apply();
			if(resp.success) {
				window.location = resp.url;
			}
			
		});
	};
	// get AreaCode
	$scope.areaCodes = [];
	jQuery.ajax({url: FL_API_URL +'/register/getAreaCode', success: function(resp) {
		$scope.areaCodes = resp;
		$scope.$apply();
	}});
	$scope.order = {};
	$scope.doOrder =function(){
		if(!$scope.order.fullname|| !$scope.order.quantity || !$scope.order.phone || !$scope.order.address ){
			return false;
		}
		$scope.order.software = SOFTWARE;
		$scope.order.site = SITE;
		jQuery.post(FL_API_URL+'/payment/orderCard', $scope.order, function(data) {
			
		  	if(data) {
		  		$scope.order.success = 1;
		  		$scope.order.message = 'Bạn đã dặt thẻ thành công, chúng tôi sẽ sớm liên hệ lại với bạn!';
		  		$scope.$apply();
		  	}
		});
		
	}
	$scope.paycard = {};
	$scope.payCardFl =function(url){
		
		if(parseInt(sessionUserId) == 0 || sessionUserId ==''){
			$scope.paycard.message ='Bạn phải đăng nhập mới được nạp thẻ';	
			$scope.paycard.success = 0;	
					
		}else{
			
			if(!$scope.paycard.pincard){
				return false;
			}
			$scope.paycard.userId = sessionUserId;	
			$scope.paycard.username = sessionUsername;
			$scope.paycard.software = SOFTWARE;	
			$scope.paycard.site = SITE;

			jQuery.post(FL_API_URL+'/payment/payCard', $scope.paycard, function(dataResult) {
			  	if(dataResult) {
			  		if(parseInt(dataResult.result)== 1){
			  			jQuery.post(url+'/update_paycard.php', dataResult, function(data) {
							
						});
						$scope.paycard.message = dataResult.string;
						$scope.paycard.success = 1;
						$scope.$apply();
						
			  		}else {
			  			$scope.paycard.message = dataResult.string;	
			  			$scope.paycard.success = 0;	
			  			$scope.$apply();		  		
					}
			  	}				
			});			
		}
			
	}
	$scope.grade = window.localStorage.getItem('grade') || '5';
	$scope.changeGrade = function() {
		window.localStorage.setItem('grade', $scope.grade);
	};
	
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
	
	$scope.tabs = {
		proposal: '- Ôn tập, mở rộng kiến thức và đánh giá năng lực toàn diện cho học sinh tiểu học qua các bài luyện tập và hệ thống đề thi thử bằng Tiếng Anh. <br>\
- Phát triển năng lực toàn diện của học sinh :<br>\
+ Khả năng đọc hiểu tiếng Anh<br>\
+ Năng lực tư duy, khả năng phân tích và phán đoán.<br>\
+ Khả năng diễn đạt<br>\
+ Năng lực vận dụng khoa học và hiểu biết xã hội vào cuộc sống.<br>',

		authors: '1. Tiến sĩ Phạm Mai Phương – Tiến sĩ Giáo dục về Ngôn ngữ học ứng dụng, Đại học New South Wales, Australia.<br>\
2. Tiến sĩ Nguyễn Thanh Tùng, giảng viên khoa Ngữ Văn Đại học Sư phạm Hà Nội.<br>\
3. Tiến sĩ ngôn ngữ - Phạm Như Hoa, Trường THCS Cầu Giấy Hà Nội.<br>\
4. Cô Lê Thị Thu Ngân – giáo viên ngữ văn - Phó giám đốc Công ty Cổ phần Giáo dục Phát triển Trí tuệ và Sáng tạo Next Nobels.<br>\
5. Thạc sĩ Trần Thị Mai Phương, Giám đốc Công ty Cổ phần Giáo dục Phát triển Trí Tuệ và Sáng tạo Next Nobels.<br>\
6. Thầy Trần Hữu Hiếu, giáo viên dạy toán giỏi, có nhiều học trò đạt giải cao trong kì thi Violympic toán 5 toàn quốc và nhiều học trò đạt giải trong Cuộc thi Toán Châu Á Thái Bình Dương.<br>\
7. John Rodger – Giảng viên của Đại học FPT, Đại học Hoa Sen Thành Phố Hồ Chí Minh…<br>\
8. Sandra Gannon, Giảng viên Khoa Quốc tế - Đại học Quốc Gia Hà Nội<br>\
9. Markus Lohenstein, nguyên Giảng viên trường Quản trị Du lịch Quốc tế PIHMS (Pacific International Hotel Management School) New Zealand.<br>\
10. Jesscica Laura Boezio - Tốt nghiệp ĐH Rhodes (Grahamstown, South Africa), chuyên ngành Xã hội học và ngôn ngữ; Nhận chứng chỉ CELTA - ĐH Cambridge; Nhiều năm kinh nghiệm giảng dạy Tiếng Anh tại Nam Phi.<br>\
11. Alex Seward (Quốc tịch Mỹ); Thạc sĩ giáo dục; Giảng viên tại trung tâm Anh ngữ ACET; Cựu giám khảo kì thi IELTS.<br>\
12. Th. S Phan Hoài Thư - Giảng viên chính thức khóa đầu tiên thuộc nhóm triển khai chương trình khoa học GLOBE (NASA) tại Việt Nam.<br>\
13. Kasey Hames, Thạc sĩ Sinh học năm 2006. Tiến sĩ Thực vật, côn trùng, và vi sinh vật tương tác đh Missouri năm 2011, hiện là Giảng viên học viện Nông nghiệp Việt Nam<br>\
14. Cô Nguyễn Thu Trang - giáo viên tiếng Anh - tốt nghiệp khoa Sư Phạm Tiếng Anh, Đại học Sư Phạm Hà Nội. <br>\
15. Cô Trần Thị Oanh - giáo viên tiếng Anh - tốt nghiệp khoa Sư Phạm Tiếng Anh, Đại học Sư Phạm Hà Nội. <br>\
16. Cô Hà Thu Ngân - giáo viên tiếng Anh - tốt nghiệp khoa Sư Phạm Tiếng Anh, Đại học Sư Phạm Hà Nội. <br>\
17. Cô Nguyễn Thanh Vân - giáo viên tiếng Anh - tốt nghiệp khoa Sư Phạm Tiếng Anh, Đại học Sư Phạm Hà Nội. <br>\
18. Phùng Thị Tâm - giáo viên Văn - tốt nghiệp khoa Ngữ văn, Đại học Sư Phạm Hà Nội. <br>\
19. Nguyễn Thị Thu Hằng - giáo viên Văn - tốt nghiệp khoa Ngữ văn, Đại học Sư Phạm Hà Nội. <br>\
20. Nguyễn Thị Xuyến - giáo viên Văn - tốt nghiệp khoa Ngữ văn, Đại học Sư Phạm Hà Nội. <br>\
21. Thạc sĩ Nguyễn Thanh Xuân - giảng viên khoa Địa lí, Đại học Sư Phạm Hà Nội. <br>\
22. Đặng Thị Khuyên - giáo viên Địa lí - trường THCS Dương Nội, Hà Nội. <br>\
',

		structure: '<table class="table table-bordered table-sm table-striped">\
					<tbody><tr>\
						<td><b>STT</b></td>\
						<td><b>Các phần chính</b></td>\
						<td><b>Nội dung</b></td>\
					</tr>\
					<tr>\
						<td><b>1.</b></td>\
						<td><b>Phần Luyện tập các môn</b></td>\
						<td>\
						- <b>Hàng ngàn câu hỏi trắc nghiệm các môn học</b> : Toán, Khoa học, Lịch sử, Địa lí… bằng tiếng Anh để ôn tập kiến thức, đánh giá năng lực và rèn luyện tư duy cho HS.<br>\
						- Hệ thống câu hỏi qua các <b>bài nghe, bài quan sát (các tranh ảnh, video) đa dạng về chủ đề</b> dựa trên nền kiến thức các môn học và sự hiểu biết của HS bậc tiểu học. <br>\
						- Hơn 2000 từ vựng chuyên ngành được phân theo các chuyên đề của từng môn học.<br>\
						</td>\
					</tr>\
					<tr>\
						<td><b>2.</b></td>\
						<td><b>Phần Ôn luyện tiếng Anh</b></td>\
						<td>\
						- <b> Gồm 100 đề ôn tập ngữ pháp tiếng Anh </b> tích hợp với các kiến thức hiểu biết xã hội\
						</td>\
					</tr>\
					\
					<tr>\
						<td><b>3.</b></td>\
						<td><b>Phần Ôn luyện tổng hợp</b></td>\
						<td>\
						- <b>Là hệ thống gồm 34 đề </b> ,<b>tổng hợp kiến thức các môn học</b>, giúp học sinh làm quen với các dạng đề thi, ôn luyện kiến thức tổng hợp.	\
						</td>\
					</tr>\
					<tr>\
						<td><b>4.</b></td>\
						<td><b>Phần Thi thử Nguyễn Bỉnh Khiêm</b></td>\
						<td>\
						- Bao gồm <b> 30 đề thi Trắc nghiệm và 30 đề Tự luận bám sát cấu trúc đề khảo sát vào trường Nguyễn Bỉnh Khiêm </b>.	\
						\
						</td>\
					</tr>\
					<tr>\
						<td><b>5.</b></td>\
						<td><b>Kinh nghiệm ôn thi</b></td>\
						<td>\
						Gồm nhiều nội dung :<br>\
						- Cung cấp <b>Tài liệu tham khảo các môn học</b>:<br>\
						+ Mỗi môn học đều có các bài đọc tham khảo bằng tiếng Anh và các câu hỏi hỗ trợ ôn tập kiến thức các thức các môn học bằng tiếng Việt.\
						+ Đặc biệt, cung cấp hệ thống từ vựng cơ bản sắp xếp theo các chủ đề.\
						- Trao đổi các <b>kinh nghiệm ôn thi</b> vào trường Nguyễn Bỉnh Khiêm (Mục hỏi đáp kinh nghiệm ôn thi).\
\
\
						</td>\
					</tr>\
					\
					\
				</tbody></table>',

		advantage: '<ul class="pd-40 list-unstyled left35">\
				    <li>- Học sinh dễ dàng học từ vựng qua các loại game.</li>\
\
					<li>- Chấm điểm và xếp hạng học sinh.</li>\
\
					<li>- Tra cứu từ điển Anh Việt ngay trong phần mềm.</li>\
\
					<li>- Tất cả các câu hỏi luyện tập và đề thi thử đều có đáp án, lý giải.</li>\
\
					<li>-Sản phẩm luôn luôn được nâng cấp, cập nhật cả về số lượng câu hỏi và dạng bài ôn tập.</li>\
				</ul>',

		guide: ''
	};
	$scope.banks = [
	{
		image: 'http://s1.nextnobels.com/default/skin/nobel/themes/story/media/vcb.jpg',
		name: 'Ngân hàng thương mại cổ phần ngoại thương(Vietcombank)',
		account: '0011004237507',
		owner: 'CÔNG TY CỔ PHẦN GIÁO DỤC PHÁT TRIỂN TRÍ TUỆ VÀ SÁNG TẠO NEXT NOBELS',
		branch: 'Sở giao dịch'
	},
	{
		image: 'http://s1.nextnobels.com/default/skin/nobel/themes/story/media/vietin.jpg',
		name: 'Ngân hàng TMCP công thương Việt Nam(Vietinbank)',
		account: '110000145741',
		owner: 'CÔNG TY CỔ PHẦN GIÁO DỤC PHÁT TRIỂN TRÍ TUỆ VÀ SÁNG TẠO NEXT NOBELS',
		branch: 'Thăng Long'
	},
	{
		image: 'http://s1.nextnobels.com/default/skin/nobel/themes/story/media/agri.jpg',
		name: 'Ngân hàng Nông nghiệp và phát triển nông thôn Việt Nam(Agribank)',
		account: '1305201013000',
		owner: 'CÔNG TY CỔ PHẦN GIÁO DỤC PHÁT TRIỂN TRÍ TUỆ VÀ SÁNG TẠO NEXT NOBELS',
		branch: 'Tràng An'
	},
	{
		image: 'http://s1.nextnobels.com/default/skin/nobel/themes/story/media/mb.jpg',
		name: 'Ngân hàng TMCP Quân đội MB',
		account: '0201100316008',
		owner: 'CÔNG TY CỔ PHẦN GIÁO DỤC PHÁT TRIỂN TRÍ TUỆ VÀ SÁNG TẠO NEXT NOBELS',
		branch: 'Nam Trung Yên'
	},
	{
		image: 'http://s1.nextnobels.com/default/skin/nobel/themes/story/media/bidv.jpg',
		name: 'Ngân hàng TMCP Đầu tư và phát triển Việt Nam(BIDV)',
		account: '26010000705319',
		owner: 'CÔNG TY CỔ PHẦN GIÁO DỤC PHÁT TRIỂN TRÍ TUỆ VÀ SÁNG TẠO NEXT NOBELS',
		branch: 'Tây Hà Nội'
	},
	{
		image: 'http://s1.nextnobels.com/default/skin/nobel/themes/story/media/donga.jpg',
		name: 'Ngân hàng TMCP Đông Á',
		account: '014601780001',
		owner: 'CÔNG TY CỔ PHẦN GIÁO DỤC PHÁT TRIỂN TRÍ TUỆ VÀ SÁNG TẠO NEXT NOBELS',
		branch: 'Cầu Giấy'
	},
	];
}]);