$langMap = {
	en: {
		'Class': 'Class'
	},
	vn: {
		'Class': 'Lớp',
		'Practice': 'Luyện tập',
		'Vocabulary': 'Từ vựng'
	}
};
flApp = angular.module('flApp', ["ngSanitize", "ngJaxBind"]);

flApp.filter('sanitizer', ['$sce', function($sce) {
        return function(url) {
            return $sce.trustAsHtml(url);
        };
}]);
flApp.filter('translate', ['$sce', function($sce) {
        return function(str) {
			if(str) {
				return $sce.trustAsHtml(str.replace(/\[start\](.*)\[end\]/g, '<button class="btn btn-primary" data-toggle="collapse" onclick="jQuery(this).next().collapse(\'toggle\')">Dịch</button><div class="collapse"><div class="card card-body">$1</div></div>'))
			};
			return '';
        };
}]);

flApp.filter('repeat', ['$sce', function($sce) {
    return function(number, str) {
		return number ? str.repeat(number) : '';
	};
}]);

flApp.filter('gift', ['$sce', function($sce) {
        return function(str) {
			if(str) {
				var result = '';
				var strs = str.split('=====');
				result += strs[0];
				if(typeof strs[1] !== 'undefined') {
					result += '<button class="btn btn-primary" data-toggle="collapse" onclick="jQuery(this).next().collapse(\'toggle\')">Lyrics</button><div class="collapse"><div class="card card-body">'+strs[1]+'</div></div>';
				}
				if(typeof strs[2] !== 'undefined') {
					result += '<div><strong>Questions:</strong> ' + strs[2] + '</div>';
				}
				return $sce.trustAsHtml(result);
			};
			
			return '';
        };
}]);
flApp.filter('toDate', function() {
    return function(input) {
        return new Date(input);
    }
})