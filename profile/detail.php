
<div class="full practice pb-5">
	<div class="container mt-4 mb-3">
		<div class="main-shadow full p-3">
			<div class="full  p-3 mb-3">
				<h4 class="text-center t-weight">THÔNG TIN CÁ NHÂN</h4>				
				<div class="row">
					<div class="col-md-4">
						<img src="{{userDetail.avatar}}?t=<?php echo time();?>" alt="avatar" class="rounded-circle" alt="Cinque Terre" width="256" height="256">
						<br>
						
					</div>
					<div class="col-md-8" >
						<!--show infor -->
						<div class="full" ng-hidden="editInfor">
							<ul class="list-unstyled" >
								<li><strong>Họ và tên:</strong> {{userDetail.name}}</li>
								<li><strong>Nick name:</strong> {{userDetail.username}}</li>
								<li><strong>Ngày sinh:</strong> {{userDetail.birthday | date:"MM/dd/yyyy"}}</li>
								<li ng-hidden="userDetail.sex"><strong>Giới tính:</strong> Nữ</li>
								<li ng-show="userDetail.sex"><strong>Giới tính:</strong> Nam</li>
								<li><strong>Địa chỉ:</strong> {{userDetail.address}}</li>
								<li><strong>Trường:</strong>{{userDetail.schoolname}} </li>
								<li><strong>Lớp:</strong> {{userDetail.classname}}</li>
																					
								<li ng-if="<?php echo $_SESSION['checkPayment']; ?>"><strong>Thời hạn sản phẩm từ ( <?php echo $_SESSION['paymentDate']; ?> đến <?php echo $_SESSION['expiredDate']; ?> )</strong></li>
								<button type="button" class="btn btn-primary" ng-click="editInforUser()">Sửa thông tin</button>
							</ul>							
							
						</div>
						<!--edit infor -->
						<div class="full bg-light" ng-show="editInfor" >
							<!--edit infor -->
							<form >
							  <div class="form-row">
							    <div class="form-group col-md-4">
							      <label for="name">Họ và Tên(*) :</label>
							      <input type="text" class="form-control" ng-model="userDetail.name" required placeholder="Họ và Tên">
							    </div>
							    <div class="form-group col-md-3">
							      <label for="phone">Điện thoại (*) :</label>
							      <input type="text" class="form-control" ng-model="userDetail.phone" required placeholder="Điện thoại">
							    </div>
							    <div class="form-group col-md-3">
							      <label for="inputState">Giới tính: </label>
							      <select ng-model="userDetail.sex" required  class="form-control" >
							        <option value="1" ng-selected="userDetail.sex==1">Nam</option>
							        <option value="0" ng-selected="userDetail.sex==0">Nữ</option>
							      </select>
							    </div>
							  </div>
							  <div class="form-row">
							  	<div class="form-group col-md-4">
									<label for="inputAddress2">Ngày sinh: </label>
							    	<input type="date" class="form-control" ng-model="userDetail.birthday"  placeholder="Ngày sinh" required >
								</div>
							  	<div class="form-group col-md-6">
								    <label for="inputAddress">Địa chỉ :</label>
								    <input type="text" class="form-control" ng-model="userDetail.address" required placeholder="Quận 1- TPHCM">
								</div>
								
							  </div>
							  <div class="form-row">
							    <div class="form-group col-md-4">
							      <label for="school">Trường :</label>
							      <input type="text" class="form-control" ng-model="userDetail.schoolname" required placeholder="Trường học">
							    </div>
							    <div class="form-group col-md-3">
							      <label for="class">Lớp :</label>
							      <input type="text" class="form-control" ng-model="userDetail.classname" required placeholder="Lớp học">
							    </div>
							    <div class="form-group col-md-3">
							      <label for="input">Tỉnh(TP): </label>
							      <select ng-model="userDetail.areacode"class="form-control">
							        <option value="{{areaCode.id}}" ng-repeat="areaCode in areaCodes" required ng-selected="areaCode.id==userDetail.areacode">{{areaCode.name}}</option>						        
							      </select>
							    </div>
							  </div>
							  <div class="form-group alert alert-success" ng-show="success" ng-bind-html="message"></div>
							  <button ng-click="editUser()" class="btn btn-primary">Cập nhật</button>
							  <button type="button" ng-click="cancelEditUser()" class="btn btn-secondary">Hủy</button>
							</form>	

							<hr />
						</div>
						
						<!--edit password -->
						<div class="full bg-light" ng-show="editInfor" >
							<form>
							  <div class="form-row">
							    <div class="form-group col-md-4">
							      <label for="name">Mật khẩu cũ(*) :</label>
							      <input type="password" class="form-control" ng-model="editPassword.oldPassword"  placeholder="Mật khẩu cũ" required>
							    </div>
							    
							  </div>
							  <div class="form-row">
							  	<div class="form-group col-md-4">
							      <label for="password">Mật khẩu mới (*) :</label>
							      <input type="password" class="form-control" ng-model="editPassword.newPassword"  placeholder="Mật khẩu mới" required>
							    </div>
							    <div class="form-group col-md-4">
							      <label for="password">Nhập lại mật khẩu mới (*) :</label>
							      <input type="password" class="form-control" ng-model="editPassword.reNewPassword" placeholder="Mật khẩu mới" required>
							    </div>							    
							  </div>
							  <div class="form-group alert" ng-class="{'alert-danger': editPassword.success==0, 'alert-success': editPassword.success==1}" ng-show="editPassword.message" ng-bind-html="editPassword.message">

							 </div>
							  <button ng-click="changePassword()" class="btn btn-primary">Cập nhật</button>
							  <button type="button" class="btn btn-secondary" ng-click="cancelEditUser()">Hủy</button>
							</form>

							<hr />

						</div>

						

						<!--edit avatar -->
						<div class="full bg-light" ng-show="editInfor" >
							<form enctype="multipart/form-data">				
								<div class="clearfix">
								  	<img src="" id="avatarPreview" alt="" class="rounded-circle" alt="Cinque Terre" width="304" height="304">
								  </div>
								<div class="custom-file">
																	  
								  <input type="file" id="avatar" class="custom-file-input" id="customFile" accept="image/*" ng-model="userAvatar" maxsize="50" required onchange="previewImg(this)" />
								  <label class="custom-file-label" for="customFile">{{inputFile}}</label>
								   <span ng-show="form.files.$error.maxsize">Files must not exceed 50 KB </span>
								  
								</div>
								<div class="form-group alert" ng-class="{'alert-danger': editAvatar.success==0, 'alert-success': editAvatar.success==1}" ng-show="editAvatar.message" ng-bind-html="editAvatar.message">

							 </div>
								<button type="submit" ng-click="changeAvatar()" class="btn btn-primary">Cập nhật</button>
								  <button type="button" class="btn btn-secondary" ng-click="cancelEditUser()">Hủy</button>
							</form>
						</div>
						
					</div>
				</div>
			</div>
			<div class="full bg-light p-3 mb-3">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" id="luyentap-tab" data-toggle="tab" href="#luyentap" role="tab" aria-controls="luyentap" aria-selected="true">Luyện tập các môn</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link  id="tienganh-tab" data-toggle="tab" href="#tienganh" role="tab" aria-controls="tienganh" aria-selected="true">Ôn luyện tiếng Anh </a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="deluyentap-tab" data-toggle="tab" href="#deluyentap" role="tab" aria-controls="deluyentap" aria-selected="false">Ôn luyện tổng hợp</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" id="thithu-tab" data-toggle="tab" href="#thithu" role="tab" aria-controls="thithu" aria-selected="false">Thi thử Trần Đại Nghĩa</a>
				  </li>	
				  <li class="nav-item">
				    <a class="nav-link" id="tdn-tab" data-toggle="tab" href="#tdn" role="tab" aria-controls="tdn" aria-selected="false">Đề thi Trần Đại Nghĩa các năm</a>
				  </li>	
				  <li class="nav-item">
				    <a class="nav-link" id="testAll-tab" data-toggle="tab" href="#testAll" role="tab" aria-controls="tdn" aria-selected="false">Tất cả</a>
				  </li>			  
				</ul>
			</div>
			
			<div class="tab-content pt-2  mb-5" id="myTabContent">
			  	<div class="tab-pane fade show active bg-light" id="luyentap" role="tabpanel" aria-labelledby="luyentap-tab" >
			  		<h5>Bài luyện tập các môn học</h5>
			  		<table class="table table-bordered">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Môn học</th>
					      <th scope="col" style="width: 30%;">Chủ đề</th>
					      <th scope="col">Bài</th>
					      <th scope="col">Điểm</th>
					      <th scope="col">Ngôn ngữ</th>
					      <th scope="col">Thời gian làm bài</th>
					      <th scope="col">Ngày</th>
					      
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="lesson in lessons">
					      <th scope="row">{{$index +1}}</th>
					      <td >{{getSubject(lesson.categoryId)}}</td>
					      <td ng-bind="lesson.name"></td>
					      <td><a href="/book.php?id={{lesson.id}}">Bài {{lesson.exercise_number}}</a></td>
					      <td ng-bind="lesson.mark"></td>
					      <td ng-bind="lesson.lang"></td>
					      <td ng-bind="lesson.duringTime"></td>
					      <td >{{lesson.startTime| date:'MM/dd/yyyy @ h:mma'}}</td>
					    </tr>					    
					    
					  </tbody>
					</table>
					<nav aria-label="...">
					  <ul class="pagination">
					    <li class="page-item" ng-class="{'active': lessonPageSelected === 0}">
					      <a class="page-link" ng-click="lessonPage(0)"> Trang đầu </a>
					    </li>
					    <li class="page-item" ng-repeat="lessonItem in lessonQuantity" ng-class="{'active': lessonPageSelected == lessonItem}">
					    	<a class="page-link" ng-click="lessonPage(lessonItem)">{{lessonItem+1}}</a>
					    </li>
					    			    
					    
					  </ul>
					</nav>
			  	</div>
			  	<div class="tab-pane fade bg-light" id="deluyentap" role="tabpanel" aria-labelledby="deluyentap-tab">
			  		Ôn luyện tổng hợp
			  		<table class="table table-bordered">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Đề thi</th>					      
					      <th scope="col">Điểm</th>
					      <th scope="col">Ngôn ngữ</th>
					      <th scope="col">Thời gian làm bài</th>
					      <th scope="col">Ngày</th>
					      
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="test in historyTests">
					      <th scope="row">{{$index +1}}</th>
					      <td><a href="/book.php?id={{test.id}}">{{test.name}}</a></td>
					      <td ng-bind="test.mark"></td>
					      <td ng-bind="test.lang"></td>
					      <td ng-bind="test.duringTime"></td>
					      <td >{{test.startTime| date:'MM/dd/yyyy @ h:mma'}}</td>
					      
					    </tr>					    
					    
					  </tbody>
					</table>
					<nav aria-label="...">
					  <ul class="pagination">
					    <li class="page-item " ng-class="{'active': testPageSelected === 0}">					      
					      	<a class="page-link"  ng-click="testPage(0)">Trang đầu</a>      
					  	  
					    </li>
					    <li class="page-item"  ng-class="{'active': testPageSelected === testitem}" ng-repeat="testitem in testQuantity">
					    	<a class="page-link"  ng-click="testPage(testitem)">{{testitem+1}}</a>
					    </li>
					    
					  </ul>
					</nav>
			  	</div>

			  	<div class="tab-pane fade bg-light" id="tienganh" role="tabpanel" aria-labelledby="tienganh-tab">
			  		Ôn luyện tiếng Anh
			  		<table class="table table-bordered">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Đề thi</th>					      
					      <th scope="col">Điểm</th>
					      <th scope="col">Ngôn ngữ</th>
					      <th scope="col">Thời gian làm bài</th>
					      <th scope="col">Ngày</th>
					      
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="testE in testEnglish">
					      <th scope="row">{{$index +1}}</th>
					      <td><a href="/book.php?id={{testE.id}}">{{testE.name}}</a></td>
					      <td ng-bind="testE.mark"></td>
					      <td ng-bind="testE.lang"></td>
					      <td ng-bind="testE.duringTime"></td>
					      <td >{{testE.startTime| date:'MM/dd/yyyy @ h:mma'}}</td>
					      
					    </tr>					    
					    
					  </tbody>
					</table>
					<nav aria-label="...">
					  <ul class="pagination">
					    <li class="page-item " ng-class="{'active': testEPageSelected === 0}">					      
					      	<a class="page-link"  ng-click="testEPage(0)">Trang đầu</a>      
					  	  
					    </li>
					    <li class="page-item"  ng-class="{'active': testEPageSelected === testEitem}" ng-repeat="testEitem in testEQuantity">
					    	<a class="page-link"  ng-click="testEPage(testEitem)">{{testEitem+1}}</a>
					    </li>
					    
					  </ul>
					</nav>
			  	</div>

			  	<div class="tab-pane fade bg-light" id="thithu" role="tabpanel" aria-labelledby="thithu-tab" >
			  		Đề thi thử
			  		<table class="table table-bordered">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Đề thi</th>					      
					      <th scope="col">Điểm</th>
					      <th scope="col">Ngôn ngữ</th>
					      <th scope="col">Thời gian làm bài</th>
					      <th scope="col">Ngày</th>
					      
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="tdnTest in tdnTests">
					      <th scope="row">{{$index +1}}</th>
					      <td><a href="/book.php?id={{tdnTest.id}}">{{tdnTest.name}}</a></td>
					      <td ng-bind="tdnTest.mark"></td>
					      <td ng-bind="tdnTest.lang"></td>
					      <td ng-bind="tdnTest.duringTime"></td>
					      <td >{{tdnTest.startTime| date:'MM/dd/yyyy @ h:mma'}}</td>
					      
					    </tr>					    
					    
					  </tbody>
					</table>
					<nav aria-label="...">
					  <ul class="pagination">
					    <li class="page-item" ng-class="{'active': tdnTestPageSelected === 0}">					      
					      	<a class="page-link"  ng-click="tdnTestPage(0)">Trang đầu</a>      
					  	  
					    </li>
					    <li class="page-item" ng-class="{'active': tdnTestPageSelected === tdnTestitem}" ng-repeat="tdnTestitem in tdnTestQuantity">
					    	<a class="page-link"   ng-click="tdnTestPage(tdnTestitem)">{{tdnTestitem +1}}</a>
					    </li>					   
					    
					  </ul>
					</nav>
				</div>

				<div class="tab-pane fade bg-light" id="tdn" role="tabpanel" aria-labelledby="tdn-tab" >
			  		Đề thi chính thức các năm
			  		<table class="table table-bordered">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Đề thi</th>					      
					      <th scope="col">Điểm</th>
					      <th scope="col">Ngôn ngữ</th>
					      <th scope="col">Thời gian làm bài</th>
					      <th scope="col">Ngày</th>
					      
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="tdnRealTest in tdnRealTests">
					      <th scope="row">{{$index +1}}</th>
					      <td><a href="/book.php?id={{tdnRealTest.id}}">{{tdnRealTest.name}}</a></td>
					      <td ng-bind="tdnRealTest.mark"></td>
					      <td ng-bind="tdnRealTest.lang"></td>
					      <td ng-bind="tdnRealTest.duringTime"></td>
					      <td >{{tdnRealTest.startTime| date:'MM/dd/yyyy @ h:mma'}}</td>
					      
					    </tr>					    
					    
					  </tbody>
					</table>
					<nav aria-label="...">
					  <ul class="pagination">
					    <li class="page-item" ng-class="{'active': tdnRealTestPageSelected === 0}">					      
					      	<a class="page-link"  ng-click="tdnRealTestPage(0)">Trang đầu</a>      
					  	  
					    </li>
					    <li class="page-item" ng-class="{'active': tdnRealTestPageSelected === tdnRealTestitem}" ng-repeat="tdnRealTestitem in tdnRealTestQuantity">
					    	<a class="page-link"   ng-click="tdnRealTestPage(tdnRealTestitem)">{{tdnRealTestitem +1}}</a>
					    </li>					   
					    
					  </ul>
					</nav>
				</div>

				<div class="tab-pane fade bg-light" id="testAll" role="tabpanel" aria-labelledby="testAll-tab" >
			  		Tổng hợp các bài thi
			  		<table class="table table-bordered">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Đề thi</th>					      
					      <th scope="col">Điểm</th>
					      <th scope="col">Ngôn ngữ</th>
					      <th scope="col">Thời gian làm bài</th>
					      <th scope="col">Ngày</th>
					      
					    </tr>
					  </thead>
					  <tbody>
					    <tr ng-repeat="testAll in testAlls">
					      <th scope="row">{{$index +1}}</th>
					      <td><a href="/book.php?id={{testAll.id}}">{{testAll.name}}</a></td>
					      <td ng-bind="testAll.mark"></td>
					      <td ng-bind="testAll.lang"></td>
					      <td ng-bind="testAll.duringTime"></td>
					      <td >{{testAll.startTime| date:'MM/dd/yyyy @ h:mma'}}</td>
					      
					    </tr>					    
					    
					  </tbody>
					</table>
					<nav aria-label="...">
					  <ul class="pagination">
					    <li class="page-item" ng-class="{'active': testAllPageSelected === 0}">					      
					      	<a class="page-link"  ng-click="testAllPage(0)">Trang đầu</a>      
					  	  
					    </li>
					    <li class="page-item" ng-class="{'active': testAllPageSelected === testAllitem}" ng-repeat="testAllitem in testAllQuantity">
					    	<a class="page-link"   ng-click="testAllPage(testAllitem)">{{testAllitem +1}}</a>
					    </li>					   
					    
					  </ul>
					</nav>
				</div>
				
			</div>
		</div>
	</div>
</div>

<script>
	function previewImg(userAvatar) {
		var reader = new FileReader();
		reader.onloadend = function() {
		  	var base64_avatar = reader.result;
		    jQuery('#avatarPreview').attr('src', base64_avatar);

		}
  		reader.readAsDataURL(userAvatar.files[0]);
	}
</script>
