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
<div class="full pt-3">
	<div class="container">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="/news_list.php?id={{category.id}}">{{category.name}}</a></li>
		    <li class="breadcrumb-item active" aria-current="page">{{news.title}}</li>
		  </ol>
		</nav>
		<div class="content mb-4" ng-bind-html="news.content">

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
			<li ng-repeat="newsRelate in newsRelates"><a href="/news_detail.php?id={{newsRelate.id}}">{{newsRelate.title}}</a></li>
		</ul>
	</div>
</div>		