
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Angular MathJax Example</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.2/angular.min.js" integrity="sha256-ruP2+uorUblSeg7Tozk75u8TaSUKRCZVvNV0zRGxkRQ=" crossorigin="anonymous"></script>

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
	                            MathJax.Hub.Queue(["Typeset", MathJax.Hub, $element[0]]);
	                        });
	                    }]
	            };
	        });
		}(angular));
	</script>
	<script>
	  angular.module("ngExampleJax", ["ngJaxBind"]);
	</script>
	<script type="text/javascript" src="//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"> </script>
	<script type="text/x-mathjax-config"> 
		MathJax.Hub.Config({
			tex2jax: {
		    	inlineMath: [['[\/','\/]'], ['\\(','\\)']],
		    	processEscapes: true
		    }
		}); 
	</script>

</head>

<body ng-app="ngExampleJax">
	<span mathjax-bind="exampleText"></span>
	<br>
	<textarea ng-model="exampleText" rows=10 cols=50></textarea>
</body>
</html>