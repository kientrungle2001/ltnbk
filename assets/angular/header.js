flApp.controller('TestController', ['$scope', function($scope) {
	$scope.tests = [];
	jQuery.ajax({
		type: 'post',
		url: FL_API_URL +'/common/getTests', 
		data: {
			categoryId: '354'
		},
		dataType: 'json',
		success: function(resp) {
			$scope.tests = resp;
			$scope.$apply();
		}
	});
	
}]);