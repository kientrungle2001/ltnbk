
<div class="full practice pb-5">
	<div class="container mt-4 mb-3">
		<div class="main-shadow full p-3">
			<div class="mb-4">
				<h2 class="text-center"><a href="">Fulllook</a></h2>
				Full Look là phần mềm khảo sát và năng lực toàn diện bằng tiếng Anh cho học sinh tiểu học.
				Sản phẩm này hữu ích cho học sinh tham gia các kỳ thi: Kỳ khảo sát năng lực vào lớp 6
				Trường THCS Chuyên Trần Đại Nghĩa, kỳ thi lấy chứng chỉ Flyer Cambridge hay kỳ thi IOE toàn quốc...
			</div>
			

			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item">
			    <a class="nav-link active" id="mucdich-tab" data-toggle="tab" href="#mucdich" role="tab" aria-controls="mucdich" aria-selected="true">Mục đích</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="doingu-tab" data-toggle="tab" href="#doingu" role="tab" aria-controls="doingu" aria-selected="false">Đội ngũ biên soạn và cố vấn</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="cautruc-tab" data-toggle="tab" href="#cautruc" role="tab" aria-controls="cautruc" aria-selected="false">Cấu trúc phần mềm</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" id="tienich-tab" data-toggle="tab" href="#tienich" role="tab" aria-controls="tienich" aria-selected="false">Tiện ích</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link btn-danger text-white" id="huongdan-tab" data-toggle="tab" href="#huongdan" role="tab" aria-controls="huongdan" aria-selected="false">Hướng dẫn mua sản phẩm</a>
			  </li>
			</ul>
			<div class="tab-content pt-2  mb-5" id="myTabContent">
			  	<div class="tab-pane fade show active bg-light" id="mucdich" role="tabpanel" aria-labelledby="mucdich-tab" ng-bind-html="tabs.proposal">
			  	</div>
			  	<div class="tab-pane fade bg-light" id="doingu" role="tabpanel" aria-labelledby="doingu-tab" ng-bind-html="tabs.authors">
			  	</div>
			  	<div class="tab-pane fade bg-light" id="cautruc" role="tabpanel" aria-labelledby="cautruc-tab" ng-bind-html="tabs.structure">
				</div>
				<div class="tab-pane fade bg-light" id="tienich" role="tabpanel" aria-labelledby="tienich-tab" ng-bind-html="tabs.advantage">
				</div>
				<div class="tab-pane fade bg-light" id="huongdan" role="tabpanel" aria-labelledby="huongdan-tab" ng-bind-html="tabs.guide">
				</div>
			</div>


			<div id="guide" class="full bg-light p-3 mb-3">
				<h4 class="text-center t-weight">Hướng dẫn mua sản phẩm Full Look</h4>
				<h5 class="text-center t-weight">Phần mềm FullLook giá <span class="label label-danger ">700.000 đồng</span> cho 1 năm sử dụng </h5>

				<p><strong>Bước 1:</strong> Bạn đăng ký tài khoản của mình <a class="font-weight-bold" href="#" data-toggle="modal" data-target="#loginRegisterModal">Tại đây</a></p>
				<p><strong>Bước 2:</strong> Bạn có thể mua phần mềm theo hai cách</p>
					<div class="row">
						
						<div class="col-md-11">
							<ul>
								<li>Cách 1: Đặt mua thẻ FullLook <a class="font-weight-bold" href="#ordercardfl"> Tại đây</a></li>
								<li>Cách 2: Thanh toán bằng chuyển khoản ngân hàng <a class="font-weight-bold" href="#bankfl"> Tại đây</a></li>
								<li>Cách 3: Thanh toán tại văn phòng công ty <a href="#officefl" class="font-weight-bold"> Tại đây</a></li>
							</ul>
							<p></p>
						</div>
					</div>
			</div>


			<div class="full bg-light p-3 mb-3" id="ordercardfl">
				<div class="text-center">
				      <div class="btn btn-success mb-3">ĐẶT MUA THẺ FULLOOK</div>
				</div>    
			   	<div class="mb-3">
				     <span> <strong>Chú ý: </strong>Để đặt mua thẻ bạn vui lòng điền đầy đủ các thông tin bên dưới. 
				      Sau khi đặt mua thẻ chúng tôi sẽ gọi lại cho bạn để xác nhận thông tin 
				      Chúng tôi sẽ gửi thẻ đến đúng địa chỉ như bạn đã đăng ký 
				     </span> 
			  	</div>
				
				<form style="width: 60%; margin: 0px auto;" id="orderCardFormFL"  method="post">
		     		
					<div class="form-group">
					    <label for="txtname">Họ và tên:</label>
					    <input type="text" class="pm_paycard_input form-control" cols="62" name="txtname" ng-model="order.fullname" placeholder="Điền họ tên" required>
					</div>
					<div class="form-group">
					    <label for="txtquantity">Số lượng thẻ:</label>
					    <input type="number" class="pm_paycard_input form-control" cols="62" id="txtquantity" name="txtquantity" placeholder="Số lượng thẻ" ng-model="order.quantity" required>
					</div>
					<div class="form-group">
					    <label for="txtname">Số điện thoại:</label>
					    <input type="text" class="pm_paycard_input form-control" cols="62" name="txtphone" placeholder="Điền số điện thoại" ng-model="order.phone" required>
					</div>
					<div class="form-group">
					    <label for="txtaddress">Địa chỉ nhận thẻ:</label>
					    <textarea class="form-control" id="txtaddress" name="txtaddress" placeholder="Địa chỉ nhận thẻ" cols="62" rows="3" ng-model="order.address" required></textarea>
					</div>
					<div class="form-group alert" ng-class="{'alert-danger': order.success==0, 'alert-success': order.success==1}" ng-show="order.message" ng-bind-html="order.message">
					</div>
		         	<input type="submit" id="ordercard_button" class="btn btn-success" ng-click="doOrder()" value=" ĐẶT MUA">			
		         	
		        </form> 
		             
		   </div>		   
			
		   <div class="full bg-light p-3 mb-3" id="paycardfl">
				<div class="text-center">
				    <div class="btn btn-danger mb-3">NẠP THẺ FULLOOK</div>
				</div>  
			    <div class="mb-3 text-center">
			      <span><strong>Chú ý: </strong>Bạn hãy cào thẻ và  điền mã kích hoạt vào ô bên dưới rồi nhấn "Nạp thẻ" để hoàn thành.</span>
			    </div>

			      <form style="width: 60%; margin: 0px auto;" id="paycardflForm" method="post">
			      		<div class="form-group">
						    <label for="flcardId">Nhập mã kích hoạt:</label>
						    <input type="text" ng-model="paycard.pincard" autocomplete="off" class="pm_paycard_input form-control" id="flcardId" required  name="flcardId" placeholder="Nhập mã kích hoạt">							
						</div>
			           
			            <div class="form-group alert " ng-class="{'alert-danger': paycard.success==0, 'alert-success': paycard.success==1}" ng-show="paycard.message" ng-bind-html="paycard.message">

						</div>		      		
			            <input type="submit" class="btn btn-danger" ng-click="payCardFl('<?php echo FL_URL ?>')" value=" NẠP THẺ">
			      </form>				
			</div>

			<div class="full bg-light p-3 mb-3" id="bankfl">
				<div class="text-center mb-3">
				      <div class="btn btn-info mb-3">CHUYỂN KHOẢN NGÂN HÀNG</div>
				</div>  
				
				<div class="row mb-3" ng-repeat="bank in banks">
					<div class="col-12 col-md-3 offset-md-1">
						<img ng-src="{{bank.image}}" alt="bank.name" class="img-thumbnail img-responsive">
					</div>
					<div class="col-12 col-md-7">
						<dl>
							<dt>{{bank.name}}</dt>
							<dd>Số tài khoản: {{bank.account}}</dd>
							<dd>Chủ tài khoản: {{bank.owner}}</dd>
							<dd>Chi nhánh: {{bank.branch}}</dd>
						</dl>
					</div>
				</div>				

				<ul class="pd-30"><strong>CHÚ Ý</strong>	
					<li>
					<strong>Cần ghi chính xác thông tin của chủ tài khoản và chi nhánh ngân hàng</strong> của Công ty CP Giáo dục Phát triển Trí tuệ và Sáng tạo Next Nobels. Trường hợp chuyển tiền qua SMS Banking, nếu tên công ty quá dài, chỉ được viết tắt cụm : Công ty Cổ phần (CT CP), không được viết tắt những từ còn lại. Đặc biệt, tên Next Nobels có chữ “s” ở cuối.
					
					</li>
					<li><strong>Nội dung chuyển tiền: Cần ghi ngắn gọn, đúng cấu trúc:</strong> Full look, tên đăng nhập trên FullLook, số điện thoại liên hệ của bạn. Ví dụ: <strong>Full Look, gaubeo, 0936 738 986 </strong>. <br>
					<strong>Tránh ghi nội dung dài như: Nguyễn Văn A, mua tài khoản Full Look, tên đăng nhập: nguyenvana, điện thoại: 0989xxxxxx</strong> bởi vì tin nhắn ngân hàng thông báo việc có người chuyển tiền vào tài khoản của chúng tôi rất ngắn nên nếu bạn ghi nội dung chuyển tiền dài, <strong>chúng tôi thường không nhận được đầy đủ thông tin trong nội dung bạn viết</strong> đặc biệt là thông tin về số điện thoại và tài khoản đăng nhập của bạn. Trong trường hợp đó, chúng tôi thường không kích hoạt được tài khoản cho bạn luôn. </li>
					<!--li>Nếu bạn chuyển tiền qua máy ATM phải ghi đầy đủ: Tên sản phẩm, số điện thoại của bạn, tên đăng nhập của bạn trên Nextnobels.com(ví dụ: FULL LOOK 0996896968 fantbitt)</li-->
					<li>Bạn vui lòng giữ lại biên nhận chuyển khoản. Lưu ý: Khách hàng chuyển tiền vào tài khoản ngân hàng Đông Á vui lòng gọi điện cho trung tâm sau khi chuyển tiền</li>
					<li>Chúng tôi kiểm tra các giao dịch chuyển khoản liên tục. Khi nhận được thông tin giao dịch của bạn chúng tôi sẽ xác nhận và kích hoạt tài khoản ngay cho bạn</li>
				</ul><br>
				Trân trọng!

			</div>	

			<div class="full bg-light p-3 mb-3" id="officefl">
				<div class="text-center">
				      <div class="btn btn-warning  mb-3">THANH TOÁN TẠI VĂN PHÒNG</div>
				</div>
				<dl>
					<dt>Công ty Cổ phần Giáo dục Phát triển Trí tuệ và Sáng tạo Next Nobels</dt>
					<dd>Địa chỉ: Số 6 Ngõ 115 Nguyễn Khang, Phường Yên Hòa, Cầu Giấy, Hà Nội</dd>
					<dd>Số điện thoại: <strong>0936 73 89 86</strong> Hoặc <strong>0965 90 91 95</strong></dd>
					<dd><i>Ghi chú: Trung tâm mở cửa tất cả các ngày trong tuần</i></dd>
				</dl>  
			</div>	
	
			
		</div>
	</div>
</div>
<script>	
		SOFTWARE = '<?php echo SOFTWARE?>';
		SITE = '<?php echo SITE?>';
</script>