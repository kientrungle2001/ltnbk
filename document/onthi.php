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

						<article class="row post mb-3" ng-repeat="news in newsList">
							<div class="col-md-3 col-12">
								<a href="/documentNewsDetail.php?id={{news.id}}">
								<img class="img-responsive img-thumbnail" src="http://s1.nextnobels.com/{{news.img}}">
									</a>
							</div>
							<div class="col-md-9 col-12">
								<a href="http://s1.nextnobels.com/document/chitiet/99">
									<strong class="entry-title"> 
										{{news.title}}
									</strong>
								</a>
										<p class="article-summary">
											{{news.brief}}			
								</p>
							</div>
								
						</article>
					</div>

				</div>
				<div class="col-12 col-md-2 pl-0">
					<?php include('common/right.php'); ?>

				</div>
			</div>
		</div>
		
	</div>
</div>
