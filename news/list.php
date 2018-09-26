<style>
	.fix-menu{margin-bottom: 15px;}
</style>
<div class="full pt-3">
	<div class="container">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item active" aria-current="page">{{category.name}}</li>
		  </ol>
		</nav>
		<div class="row mb-3" ng-repeat="news in newsLists">
			<div class="col-md-3 col-12">
				<a href="/news_detail.php?id={{news.id}}"><img src="http://s1.nextnobels.com/{{news.img}}" class="img-fluid img-thumbnail" /></a>
			</div>
			<div class="col-md-9 col-12">
				<a href="/news_detail.php?id={{news.id}}">{{news.title}}</a>
			</div>
		</div>
	</div>
</div>		