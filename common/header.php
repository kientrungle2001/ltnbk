<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.2/angular.min.js" integrity="sha256-ruP2+uorUblSeg7Tozk75u8TaSUKRCZVvNV0zRGxkRQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.2/angular-sanitize.min.js" integrity="sha256-FnMl43xSx3jHmcs7t2LJ3htfsCeo99XORPvzOVQN/tw=" crossorigin="anonymous"></script>

<script type="text/javascript">
			(function(ng){
				'use strict';
				var app = angular.module('ngJaxBind', []);

				app.directive("mathjaxBind", function() {
					return {
						restrict: "A",
						controller: ["$scope", "$element", "$attrs",
							function($scope, $element, $attrs) {
								$scope.$watch($attrs.mathjaxBind, function(texExpression) {
									$element.html(texExpression);
									if(typeof MathJax != 'undefined'){
                            
										MathJax.Hub.Queue(["Typeset", MathJax.Hub, $element[0]]);
									}
								});
							}]
					};
				});
			}(angular));
		</script>

<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
	<script type="text/x-mathjax-config"> 
		MathJax.Hub.Config({
			showMathMenu: false,
			showProcessingMessages: false,
			jax: ["input/TeX", "output/HTML-CSS"],
			tex2jax: {
		    	inlineMath: [['[\/','\/]'], ['\\(','\\)']],
                preview: "none"
		    }
		}); 
	</script>        
<div class="full header">
    <nav id="topNav" class="navbar p-3 fixed-to navbar-expand-md ">
        <a class="navbar-brand mx-auto" href="/"><img src="/assets/images/logo.png" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
           <i class="fa fa-bars text-white" aria-hidden="true"></i>
        </button>
        <div class="container">
            <div class="navbar-collapse fs14 cl-green collapse">
                <ul class="navbar-nav menu-top1">
                    <li class="nav-item">
                        <img src="/assets/images/hotline.png"/> Hotline: 0936 738 986
                    </li>
                    <!-- <li class="nav-item">
                        &nbsp;
                        <select class="select-top" ng-model="language" ng-change="changeLanguage()">
                            <option value="" ng-selected="language==''" disabled="disabled">{{translate('Select language')}}</option>
                                                <option value="en" ng-selected="language=='en'">English</option>
                                                <option value="vn" ng-selected="language=='vn'">Tiếng Việt</option>
                            <option value="ev" ng-selected="language=='ev'">Song ngữ</option>
                        </select>
                    </li> -->
                    <!-- <li class="nav-item">
                         &nbsp;
                        <select class="select-top" ng-model="grade" ng-change="changeGrade()">
                            <option value="" disabled="disabled">{{translate('Select class')}}</option>
                                                <option value="3" ng-selected="grade=='3'">{{translate('Class')}} 3</option>
                                                <option value="4" ng-selected="grade=='4'">{{translate('Class')}} 4</option>
                                                <option value="5" ng-selected="grade=='5'">{{translate('Class')}} 5</option>
                        </select>
                    </li> -->
                    
                </ul>
                <ul class="navbar-nav menu-top2 ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/about.php#guide"><img src="/assets/images/cart.png"/> Mua ngay</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="/about.php#paycardfl"><img src="/assets/images/pay.png"/> Nạp thẻ</a>
                    </li>
                    <?php if(!isset($_SESSION['userId'])) :?>
                     <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#loginRegisterModal"><img src="/assets/images/dn.png"/> Đăng nhập</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#loginRegisterModal"><img src="/assets/images/dk.png"/> Đăng kí</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <span class="navbar-text">Xin chào </span> <a class="btn btn-primary text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['name'] ?></span> </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/profile.php" class="dropdown-item">Trang cá nhân</a>
                            <a href="/profile.php#luyentap" class="dropdown-item">Lịch sử học tập</a>
                            <div class="dropdown-divider"></div>
                            <a href="/logout.php" class="dropdown-item">Đăng xuất</a>
                        </div>
                    </li>
                <?php endif ?>
                </ul>
            
            </div>
        </div>
        
    </nav>

    <nav class="navbar fix-menu navbar-expand-lg container main-menu mt-2 bg-white">
        <button class="navbar-toggler" data-target="#navigation" data-control="navigation" data-toggle="collapse">
            <i class="fa fa-bars text-primary" aria-hidden="true"></i>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="nav navbar-nav">
				<li class="nav-item">
                    <a href="/" class="nav-link">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="/about.php" data-toggle="dropdown" class="nav-link dropdown-toggle">Về phần mềm</a>
                    <ul class="dropdown-menu">
						<li style="padding-left: 25px;"><a href="/about.php">Giới thiệu</a></li>
						<li><a href="/about.php#guide">Hướng dẫn mua</a></li>
						<li><a href="/news_list.php?id=147">Hướng dẫn sử dụng</a></li>
					</ul>
                </li>
                <!-- <li class="nav-item dropdown">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link">Chọn Ngôn Ngữ</a>
                                    <ul class="dropdown-menu">
                                        <li style="padding-left: 25px;" ng-click="language='en';selectLanguage('en')"><a href="#">Tiếng Anh</a></li>
                                        <li><a href="#" ng-click="language='vn';selectLanguage('vn')">Tiếng Việt</a></li>
                                        <li><a href="#" ng-click="language='ev';selectLanguage('ev')">Song Ngữ</a></li>
                                    </ul>
                                </li> -->
                
                <li class="nav-item dropdown">
                    <a href="/#practice" class="nav-link dropdown-toggle">Luyện các môn</a>
                    <div class="dropdown-menu mega pr-3">
                        <div class="box-practice pr-0 text-center" ng-repeat="subject in subjects">
                            <a href="/detail.php?subject_id={{subject.id}}" class="subjectclick" data-subject="{{subject.id}}" data-alias="{{subject.name}}" data-class="5">
                                <div style="font-size: 16px;" class="white text-uppercase relative">
                                    <div class="full">
                                        <img ng-src="http://s1.nextnobels.com{{subject.img}}" alt="{{subject.name}}" class=" img-fluid center-block">
                                    </div>
                                    <div class="text-mega text-center full absolute">{{translate(subject, 'category.name')}}</div>
                                </div>
                            </a>
                        </div>
	                </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/#tonghop">Luyện tiếng anh</a>
                    <div style="right: 0px !important; left: auto;" class="mega dropdown-menu  p-3">
                        <div class="row pl-3" ng-init="selectedEnglishTestPage = 0">
                            <div class="col-12 col-md-2 pl-0" ng-repeat="test in englishTests" ng-show="inPage($index, selectedEnglishTestPage, 30)">
                                <a href="/test.php?test_id={{test.id}}&category_id=1411">
                                    <div class="btn text-lta full mb-3 btn-primary">{{translate(test,'test.name')}} {{test.trial? ' - Free': ''}}</div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <nav aria-label="Navigation">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item" ng-repeat="page in range(1, totalPage(englishTests.length, 30), 1)" 
                                        ng-click="selectEnglishTestPage(page-1)"
                                        ng-class="{'active': selectedEnglishTestPage == page-1}"
                                        ><a href="#" class="page-link" onclick="return false;">{{page}}</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/#tonghop">Luyện tổng hợp</a>
                    <div style="right: 0px !important; left: auto;" class="mega dropdown-menu  p-3">
                        <div class="row pl-3" ng-init="selectedTestPage = 0">
                            <div class="col-12 pl-0 col-md-2" ng-repeat="test in tests" ng-show="inPage($index, selectedTestPage, 30)">
                            <a href="/test.php?test_id={{test.id}}&category_id=1412">
                                <div class="btn text-lta full mb-3 btn-primary">{{translate(test, 'test.name')}} {{test.trial? ' - Free': ''}}</div>
                            </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <nav aria-label="Navigation">
                                    <ul class="pagination text-lta justify-content-center">
                                        <li class="page-item" ng-repeat="page in range(1, totalPage(tests.length, 30), 1)" 
                                        ng-click="selectTestPage(page-1)"
                                        ng-class="{'active': selectedTestPage == page-1}"
                                        ><a href="#" class="page-link" onclick="return false;">{{page}}</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="/#thithu" class="nav-link dropdown-toggle">Thi thử Nguyễn Bỉnh Khiêm</a>
                    <div style="right: 0px !important; left: auto;" class="mega dropdown-menu  p-3">
                        <div class="row" ng-init="selectedTestSetPage = 0">
                            <div class="w20p full-xs" ng-repeat="testSet in testSets | orderBy: 'ordering'" ng-show="inPage($index, selectedTestSetPage, 15)">
                                <a class="full btn btn-primary mb-3 text-lta" href="/testSet.php?category_id=1416&test_set_id={{testSet.id}}">{{translate(testSet, 'test.name')}}</a>
                               
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <nav aria-label="Navigation">
                                    <ul class="pagination text-lta justify-content-center">
                                        <li class="page-item" ng-repeat="page in range(1, totalPage(testSets.length, 15), 1)" 
                                        ng-click="selectTestSetPage(page-1)"
                                        ng-class="{'active': selectedTestSetPage == page-1}"
                                        ><a href="#" class="page-link" onclick="return false;">{{page}}</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </li>
                <?php if(0): ?>
                <li class="nav-item">
                    <a href="/document.php" class="nav-link">Kinh nghiệm</a>
                </li>
                <li class="nav-item">
                    <a href="/gift.php" class="nav-link">Giải trí</a>
                </li>
                <?php endif; ?>
                
            </ul>
        </div>
    </nav>
</div>
<?php require 'login.php';?>
<script>    
        SOFTWARE = '<?php echo SOFTWARE?>';
        SITE = '<?php echo SITE?>';
</script>
