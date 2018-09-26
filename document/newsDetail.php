<style>
	.fix-menu{margin-bottom: 15px;}
</style>

<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3&appId=1428443070812396";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

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
						
						<h1 class="text-center">{{news.title}}</h1>

						<div class="content" ng-bind-html="news.content">
							
						</div>

						<h4>Luyện thi tiếng Anh kiểu mới vào trường Trần Đại Nghĩa <a href="http://s1.nextnobels.com/">Tại Đây</a></h4>

						<div
						  class="fb-like"
						  data-share="true"
						  data-width="450"
						  data-show-faces="true">
						</div>
						<div class="fb-comments full" data-width="100%" data-href="http://www.nextnobels.com/{{news.alias}}" data-numposts="5"></div>	


						<h4>Tin liên quan</h4>
						<ul class="mb-5">
							<li ng-repeat="newsRelate in newsRelates"><a href="/documentNewsDetail.php?id={{newsRelate.id}}">{{newsRelate.title}}</a></li>
						</ul>

					</div>

				</div>
				<div class="col-12 col-md-2 pl-0">
					<?php include('common/right.php'); ?>

				</div>
			</div>
		</div>
		
	</div>
</div>
