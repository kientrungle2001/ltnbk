<div id="footer" class="full">
	<div class="footer-gradient">
		<div class="footer-content container">
			<div class="row">
				<div class="col-12 col-md-6">
					<img class="mt-40" src="/assets/images/logofooter2.png" />
					<div class="footer-text">
						Địa chỉ: Nhà số 6, Ngõ 115 Nguyễn Khang, Cầu Giấy, Hà Nội<br/>
						Website: Nextnobels.com<br/>
						Điện thoại: (04)8585 2525<br/>
						Hotline: 0936 738 986
					</div>
				</div>
				<div class="col-12 col-md-2">
					<div class="link-footer">
						<a class="text-uppercase" href="#">Về chúng tôi </a>
						<a href="http://nextnobels.com/ho-so-cong-ty">Hồ sơ công ty </a>
						<a href="http://nextnobels.com/tam-nhin-su-menh-cong-ty">Tầm nhìn, sứ mệnh </a>
						<a href="http://nextnobels.com/nguoi-sang-lap-cong-ty">Người sáng lập</a>
					</div>
					
				</div>
				<div class="col-12 col-md-2">
					<div class="link-footer">
						<a class="text-uppercase" href="#">Truyền thông </a>
						<a href="http://nextnobels.com/bao-chi">Báo chí </a>
						<a href="http://nextnobels.com/fulllook-phan-mem-hoc-song-ngu-anh-viet">Truyền hình </a>
						<a href="#">Full Look</a>
					</div>	
				</div>
				<div class="col-12 col-md-2">
					<div class="link-footer">
						<a class="text-uppercase" href="#">Tin tức </a>
						<a href="http://nextnobels.com/tin-cong-ty">Tin công ty </a>
						<a href="#">Sự kiện nổi bật </a>
						<a href="http://nextnobels.com/thoi-su-hoc-duong">Thời sự học đường</a>
					</div>		
				</div>
			</div>
		</div>
	</div>
	
	<!--img class="img-fluid" src="/assets/images/footer.png" />
	<div class="footer-bottom text-center">
		Bản quyền thuộc về Công Ty Cổ Phần Giáo Dục Phát Triển Trí Tuệ 
	</div-->
</div>

<div class="modal" id="bannerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-uppercase text-center m-0" style=" font-size: 32px; width: 100%; color: #19c3c1;font-family: iCiel;">Next Nobels</h5>
        <button onclick="closePopup();" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="relative">
			<img src="/assets/images/uudai.png" class="img-fluid" alt="">
			<a style="top: 75px; right: 75px;" class="btn btn-warning absolute" href="/news_detail.php?id=198">Xem chi tiết</a>
		</div>
      </div>
      
    </div>
  </div>
</div>
<style>
#hotnew {
    display: none;
    position: fixed;
    right: 5px !important;
    margin: 0px !important;
    bottom: -2px !important;
    padding: 10px !important;
    webkit-box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    -moz-box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    background-color: #fff;
    background-position: bottom right;
    border-radius: 3px;
    webkit-border-radius: 3px;
    cursor: pointer;
	font-weight: bold;

}
.newbox {
    position: fixed;
    right: 5px;
    bottom: 10px;
    width: 250px;
    height: 260px;
    margin: 0px !important;
    z-index: 9999;
    background: url(/assets/images/img.png) no-repeat;
    background-size: 50%;
    -webkit-box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    -moz-box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    box-shadow: 1px 1px 10px 0px rgba(50, 50, 50, 0.75);
    background-color: #fff;
    background-position: bottom right;
}
.tinmoi {
    display: block;
    text-align: center;
    color: #164cfb;
    margin: 0px 0px 4px 0px;
    animation: blink-animation 1s steps(5, start) infinite;
    -webkit-animation: blink-animation 1s steps(5, start) infinite;
}
@keyframes blink-animation {
  to {
    color: red;
  }
}
@-webkit-keyframes blink-animation {
  to {
    color: red;
  }
}

</style>
<div onclick="return opentb();" id="hotnew" class="tinmoi hidden-xs" style="display: block;">Xem tin mới</div>

<div id="newbox" style="width: 320px; height: 270px; display: none;" class="alert alerttb newbox alert-dismissible hidden-xs">
  <button onclick="return closetb();" type="button" class="close"><span aria-hidden="true">×</span></button>
  	<div class="tinmoi">
		&nbsp;&nbsp;--------------- <b class="f16">Mới</b> ------------<br>
		<img src="http://fulllook.com.vn/Default/skin/nobel/test/Themes/Default/media/star.png">
  	</div>
  	<div class="w100p">
		<a href="/news_detail.php?id=197" target="_blank">
		FULL LOOK TRẦN ĐẠI NGHĨA RA MẮT PHIÊN BẢN MỚI
		</a>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script>
		$.noConflict();
	</script>
	<script src="/assets/js/bootstrap.bundle.min.js"></script>
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


	<script src="/assets/array.js"></script>
	<!--script src="/assets/js/locks.js"></script-->

	<script src="/assets/angular/app.js?t=<?php echo time(); ?>"></script>
	<script language="JavaScript">
		<!--
		var dictionaries = "ev_ve";
		// -->
	</script>
	<script language="JavaScript1.2" src="http://vndic.net/js/vndic.js" type='text/javascript'></script>


	<script>
		
		function opentb(){
			jQuery(this).hide();
			jQuery('#newbox').show();
		}
		function closetb(){
			jQuery('#hotnew').show();
			jQuery('#newbox').hide();
		}
		jQuery(function(){
			jQuery('#homeslider').carousel({
		      interval: 10000,
		    });
			jQuery(".nav-item.dropdown").hover(            
				function() {
					jQuery(this).addClass('show');
					jQuery(this).find('.dropdown-menu').css('top', '95%');
					jQuery(this).find('.dropdown-menu').addClass('show');        
				},
				function(){
					jQuery(this).removeClass('show');
					jQuery(this).find('.dropdown-menu').removeClass('show'); 
				}
			);
		});
	    
		jQuery(document).ready(function() {
			if(sessionStorage.getItem('closePopup') != '1') {
				if(window.location.pathname == '' || window.location.pathname == '/' )
				jQuery('#bannerModal').modal('show');
			}
		});
		function closePopup() {
			jQuery('#bannerModal').modal('hide');
			sessionStorage.setItem('closePopup', '1');
		}
		if(typeof URL.prototype.searchParams == 'undefined') {
			var get_inputs = <?php echo (!empty($_GET) ? json_encode($_GET): '{}');?>;
			URL.prototype.searchParams = {
				get: function(key) {
					return get_inputs[key] || null;
				}
			};
		}
	</script>

	



	<!--script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script-->
	
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
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63651240-1', 'auto');
  ga('send', 'pageview');

</script>

