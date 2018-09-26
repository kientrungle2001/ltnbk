<div class="full practice pt-4 pb-5">

	<div class="container">
		<div class="row">
			<div class="col-12 col-md-3">
				<div class="main-shadow full">
					<div class="full">
						<div style="border-radius: 5px 0px 0px 0px;" class="nav-link text-center title-pr text-white bg-primary">
						Xep hang</div>
					</div>
					
				  	<ul class="list-group full vocabulary">
					  <li class="list-group-item" ng-repeat="test in tests" ng-show="language=='vn'" ng-class="{'active': test==selectedTest}"><a onclick="return false;" ng-click="selectTest(test)">{{test.name}}</a></li>
					  <li class="list-group-item" ng-repeat="test in tests" ng-show="language=='en'" ng-class="{'active': test==selectedTest}"><a onclick="return false;" ng-click="selectTest(test)">{{test.name_en}}</a></li>
					</ul>
				</div>
				
			</div>
			<div class="col-12 col-md-9">
                <div class="main-shadow full">
                    <h2 class="text-center title" ng-show="selectedTest">{{selectedTest.name}}</h2>
					<h2 class="text-center title" ng-hide="selectedTest">Hãy chọn một đề</h2>
					<div class="practice-content p-3 full">
                        <table class="table">
                            <tr>
                                <th>Thu hang</th>
                                <th>username</th>
                                <th>Ho ten</th>
                                <th>So cau dung</th>
                                <th>Thoi gian lam bai</th>
                            </tr>
                            <tr ng-repeat="ranking in rankings.rows">
                                <td>{{$index + 1 + numberPage * numberRow}}</td>
                                <td>{{ranking.fullName}}</td>
                                <td>{{ranking.username}}</td>
                                <td>{{ranking.mark}}</td>
                                <td>{{ranking.duringTime}}</td>
                            </tr>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li ng-repeat="page in pageRange(1, pages)" class="page-item" ng-class="{'active': numberPage == page-1}"><a ng-click="selectPage(page)" class="page-link">{{page}}</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>

<style>
.text-white {
	color: white !important;
}
</style>