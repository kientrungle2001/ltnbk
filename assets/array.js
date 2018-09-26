jQuery.extend(Array.prototype, {
	chunk: function(chunkSize) {
		var R = [];
		for (var i=0; i<this.length; i+=chunkSize)
			R.push(this.slice(i,i+chunkSize));
		return R;
	},
	contains: function(elem) {
		if(typeof elem == 'function') {
			for(var i = 0; i < this.length; i++) {
				if(elem(this[i])) {
					return true;
				}
			}
			return false;
		}
		return this.indexOf(elem) !== -1;
	},
	index: function(elem) {
		if(typeof elem == 'function') {
			for(var i = 0; i < this.length; i++) {
				if(elem(this[i])) {
					return i;
				}
			}
			return -1;
		}
		return this.indexOf(elem);
	},
	clone: function() {
		var rs = [];
		this.forEach(function(item){
			rs.push(item);
		});
		return rs;
	},
	find: function(comparator, first) {
		if(typeof first == 'undefined') {
			first = true;
		}
		if(first) {
			for(var i = 0; i < this.length; i++) {
				if(comparator(this[i])) {
					return this[i];
				}
			}
			return null;
		} else {
			var rs = [];
			for(var i = 0; i < this.length; i++) {
				if(comparator(this[i])) {
					rs.push(this[i]);
				}
			}
			return rs;
		}
	},
	remove: function(index) {
		if(typeof index == 'number'){
			if (index > -1) {
				this.splice(index, 1);
			}
		} else if (typeof index == 'function') {
			for(var i = this.length - 1; i >= 0; i--) {
				if(index(this[i])) {
					this.remove(i);
				}
			}
		} else {
			var realIndex = this.index(index);
			this.remove(realIndex);
		}
	},
	append: function(arr) {
		var that = this;
		if(is_array(arr)) {
			arr.forEach(function(item) {
				that.push(item);
			});
		} else {
			that.push(arr);
		}
		return that;
	},
	randomInt: function() {
		var min = this[0];
		var max = this[1];
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
});

function array() {
	return [];
}

function in_array(elem, arr) {
	return arr.contains(elem);
}

function buildTree(arr, rootId) {
	var rs = [];
	arr.forEach(function(item) {
		if(parseInt(item['parent']) == parseInt(rootId)) {
			rs.push(item);
			item.children = buildTree(arr, item.id);
		}
	});
	return rs;
}

function treefy(tree, treeLevel) {
	var rs = [];
	if(tree && is_array(tree)) {
		tree.forEach(function(treeNode){
			treeNode.treeLevel = treeLevel;
			rs.push(treeNode);
			var subRs = treefy(treeNode.children, treeLevel + 1);
			subRs.forEach(function(sub) {
				rs.push(sub);
			});
		});
	}
	return rs;
}

function buildBottomTree(arr) {
	var indexedTree = {};
	arr.forEach(function(item) {
		indexedTree[item.id] = item;
	});
	var roots = [];
	arr.forEach(function(item) {
		if(parseInt(item['parent']) !== 0) {
			if(typeof indexedTree[item['parent']] !== 'undefined') {
				if(typeof indexedTree[item['parent']]['children'] === 'undefined') {
					indexedTree[item['parent']]['children'] = [];
				}
				indexedTree[item['parent']]['children'].push(item);
			} else {
				roots.push(item);
			}
		} else {
			roots.push(item);
		}
	});
	return roots;
}
function get_class(obj) {
	return obj.constructor.name;
}

function is_a(obj, className) {
	return obj !== null && obj.constructor.name == className;
}
function is_string(obj) {
	return is_a(obj, 'String');
}
function is_numeric(obj) {
	return is_a(obj, 'Number');
}
function is_array(obj) {
	return is_a(obj, 'Array');
}
function is_function(obj) {
	return is_a(obj, 'Function');
}
function is_boolean(obj) {
	return is_a(obj, 'Boolean');
}
function is_object(obj) {
	return is_a(obj, 'Object');
}
function array_map (callback) { // eslint-disable-line camelcase
  //  discuss at: http://locutus.io/php/array_map/
  // original by: Andrea Giammarchi (http://webreflection.blogspot.com)
  // improved by: Kevin van Zonneveld (http://kvz.io)
  // improved by: Brett Zamir (http://brett-zamir.me)
  //    input by: thekid
  //      note 1: If the callback is a string (or object, if an array is supplied),
  //      note 1: it can only work if the function name is in the global context
  //   example 1: array_map( function (a){return (a * a * a)}, [1, 2, 3, 4, 5] )
  //   returns 1: [ 1, 8, 27, 64, 125 ]
  var argc = arguments.length;
  var argv = arguments;
  var obj = null;
  var cb = callback;
  var j = argv[1].length;
  var i = 0;
  var k = 1;
  var m = 0;
  var tmp = [];
  var tmpArr = [];
  var $global = (typeof window !== 'undefined' ? window : global);
  while (i < j) {
    while (k < argc) {
      tmp[m++] = argv[k++][i];
    }
    m = 0;
    k = 1;
    if (callback) {
      if (typeof callback === 'string') {
        cb = $global[callback];
      } else if (typeof callback === 'object' && callback.length) {
        obj = typeof callback[0] === 'string' ? $global[callback[0]] : callback[0];
        if (typeof obj === 'undefined') {
          throw new Error('Object not found: ' + callback[0]);
        }
        cb = typeof callback[1] === 'string' ? obj[callback[1]] : callback[1];
      }
      tmpArr[i++] = cb.apply(obj, tmp);
    } else {
      tmpArr[i++] = tmp;
    }
    tmp = [];
  }
  return tmpArr;
}

function count (mixedVar, mode) {
  //  discuss at: http://locutus.io/php/count/
  // original by: Kevin van Zonneveld (http://kvz.io)
  //    input by: Waldo Malqui Silva (http://waldo.malqui.info)
  //    input by: merabi
  // bugfixed by: Soren Hansen
  // bugfixed by: Olivier Louvignes (http://mg-crea.com/)
  // improved by: Brett Zamir (http://brett-zamir.me)
  //   example 1: count([[0,0],[0,-4]], 'COUNT_RECURSIVE')
  //   returns 1: 6
  //   example 2: count({'one' : [1,2,3,4,5]}, 'COUNT_RECURSIVE')
  //   returns 2: 6
  var key;
  var cnt = 0;
  if (mixedVar === null || typeof mixedVar === 'undefined') {
    return 0;
  } else if (mixedVar.constructor !== Array && mixedVar.constructor !== Object) {
    return 1;
  }
  if (mode === 'COUNT_RECURSIVE') {
    mode = 1;
  }
  if (mode !== 1) {
    mode = 0;
  }
  for (key in mixedVar) {
    if (mixedVar.hasOwnProperty(key)) {
      cnt++;
      if (mode === 1 && mixedVar[key] &&
        (mixedVar[key].constructor === Array ||
          mixedVar[key].constructor === Object)) {
        cnt += count(mixedVar[key], 1);
      }
    }
  }
  return cnt;
}

/**
 * Shuffles array in place. ES6 version
 * @param {Array} a items The array containing the items.
 */
function shuffle(a) {
    for (let i = a.length; i; i--) {
        let j = Math.floor(Math.random() * i);
        [a[i - 1], a[j]] = [a[j], a[i - 1]];
    }
}