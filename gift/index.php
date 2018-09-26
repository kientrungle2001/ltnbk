<style>
	.fix-menu{margin-bottom: 15px;}
</style>
<div class="full pt-3">
	<div class="container">
		<div class="full mb-3">
			<div class="row">
				<div class="col-12 col-md-5">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					 
					  	<div class="carousel-inner">

						    <div class="carousel-item" ng-repeat="gift in gifts" ng-class="{'active': $index==0}" ng-click="selectGift(gift)">
						      <img class="d-block  w-100" src="http://s1.nextnobels.com{{gift.img}}" alt="{{gift.title}}">
						      <div class="carousel-caption d-none d-md-block">
							    <h5>{{gift.title}}</h5>
							  </div>
						    </div>
							    
							<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
							    <span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							    <span class="carousel-control-next-icon" aria-hidden="true"></span>
							    <span class="sr-only">Next</span>
							</a>
						</div>
					</div>	
				</div>
				<div class="col-12 col-md-7">
					<div class="row">
						<div class="col-12 col-md-8">
							<div class="row mt-2">
								<div class="col-md-6 col-12 mb-3" ng-click="selectGift(gifts[0])">

									<img class="d-block  w-100" src="http://s1.nextnobels.com{{gifts[0].img}}" alt="{{gifts[0].title}}">
								    <div class="carousel-caption d-none d-md-block">
									    <h5>{{gifts[0].title}}</h5>
									</div>

								</div>
								<div class="col-md-6 col-12 mb-3" ng-click="selectGift(gifts[1])">
									<img class="d-block w-100" src="http://s1.nextnobels.com{{gifts[1].img}}" alt="{{gifts[1].title}}">
							       <div class="carousel-caption d-none d-md-block">
								    <h5>{{gifts[1].title}}</h5>
								   </div>
								</div>
								<div class="col-md-6 col-12 mb-3" ng-click="selectGift(gifts[2])">
									<img class="d-block w-100" src="http://s1.nextnobels.com{{gifts[2].img}}" alt="{{gifts[2].title}}">
							       <div class="carousel-caption d-none d-md-block">
								    <h5>{{gifts[2].title}}</h5>
								   </div>
								</div>
								<div class="col-md-6 col-12 mb-3" ng-click="selectGift(gifts[3])">
									<img class="d-block w-100" src="http://s1.nextnobels.com{{gifts[3].img}}" alt="{{gifts[3].title}}">
							       <div class="carousel-caption d-none d-md-block">
								    <h5>{{gifts[3].title}}</h5>
								   </div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-12">
							<div class="row box-document mb-1">
								<div class="col-md-8">
								<p class="top10">FULL LOOK</p>
								</div>
								<div class="col-md-4">
								<a href="http://s1.nextnobels.com"><img class="image-responsive center-block right-img" src="http://s1.nextnobels.com/default/skin/nobel/test/themes/default/media/full.png"></a>
								</div>
							</div>
							<div class="row box-document mb-1">
								<div class="col-md-8">
								<p class="top10">Luyện viết văn miêu tả</p>
								</div>
								<div class="col-md-4">
								<a href="http://nextnobels.com"><img class="image-responsive center-block right-img" src="http://s1.nextnobels.com/default/skin/nobel/test/themes/default/media/vietvan.png"></a>
								</div>
							</div>
							<div class="row box-document mb-1">
								<div class="col-md-8">
								<p class="top10">Khảo sát năng lực toàn diện</p>
								</div>
								<div class="col-md-4">
								<a href="http://nextnobels.com"><img class="image-responsive center-block right-img" src="http://s1.nextnobels.com/default/skin/nobel/test/themes/default/media/khaosat.png"></a>
								</div>
							</div>
							<div class="row box-document mb-1">	
								
								<div class="col-md-8">
								<p class="top10">Tiếng việt vui</p>
								</div>
								<div class="col-md-4">
								<a href="http://nextnobels.com"><img class="image-responsive center-block right-img" src="http://s1.nextnobels.com/default/skin/nobel/test/themes/default/media/tiengvietvui.png"></a>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end top git-->
		<div class="mb-3 full">
			<div class="row">
				<div class="col-12 col-md-3" ng-repeat="category in categories" ng-class="{'pr-0': $index==3}" ng-click="selectCategory(category)">
					<div class="full menu-git bg-info text-white p-2 text-center" ng-class="{'bg-info': category !== selectedCategory, 'bg-warning': category === selectedCategory}">{{category.name}}</div>
				</div>
			</div>
		</div>
		<!--end menu-git-->
		<div class="mb-3 full">
			<div ng-repeat="gift in gifts" ng-click="selectGift(gift)" ng-show="step=='init'">
				<div class="row">
					<div class="col-md-4 col-12">
						<a onclick="chitiet(184); return false;" href="">
							<img src="http://s1.nextnobels.com{{gift.img}}" class="img-fluid">
						</a>
					</div>
					<div class="col-md-8 col-12 ">
						<h4><a href="">{{gift.title}}</a></h4>
								<p>{{gift.brief}}</p>
						<button class="btn btn-success">Detail</button>
					</div>
				</div>
				<div class="bdbot mt-3 mb-3"></div>
			</div>
			<div ng-repeat="gift in categoryGifts" ng-click="selectGift(gift)" ng-show="step=='selectCategory'">
				<div class="row">
					<div class="col-md-4 col-12">
						<a onclick="chitiet(184); return false;" href="">
							<img src="http://s1.nextnobels.com{{gift.img}}" class="img-fluid">
						</a>
					</div>
					<div class="col-md-8 col-12 ">
						<h4><a href="">{{gift.title}}</a></h4>
								<p>{{gift.brief}}</p>
						<button class="btn btn-success">Detail</button>
					</div>
				</div>
				<div class="bdbot mt-3 mb-3"></div>
			</div>
			<div ng-show="step=='selectGift'">
				<div class="row">
					<div class="col-12 text-center">
						<h4><a href="">{{selectedGift.title}}</a></h4>
						<div ng-bind-html="selectedGift.content | gift"></div>
					</div>
				</div>
				<div class="bdbot mt-3 mb-3"></div>
			</div>
		</div>
	</div>
</div>	
