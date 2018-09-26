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
					
					<div class="full bdbot mb-3">
						<h3 class="text-center">{{subject.name}}</h3>
						<table class="table">
							<thead>
							  <tr>
								<th>Tên tài liệu</th>
								<th>Ngày gửi lên</th>
								<th>Dung lượng</th>
								<th>Lượt tải</th>
								<th>Tải về</th>
							  </tr>
							</thead>
							<tbody>
								<tr ng-repeat="doc in docs">
									<td><a href="/documentDetail.php?document_id={{doc.id}}">{{doc.title}}</a></td>
									<td>{{doc.created}}</td>
									<td>0</td>
									<td>0</td>
									<td><a href="{{doc.file}}">Tải về</a></td>
								</tr>
							</tbody>
						</table> 
						<p class="float-right"><a href="/documentList.php?subject_id={{subject.id}}">Xem thêm</a></p>
					</div>

				</div>
				<div class="col-12 col-md-2 pl-0">
					<?php include('common/right.php'); ?>

				</div>
			</div>
		</div>
		
	</div>
</div>
