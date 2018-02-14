<?php

return [
	'notFoundHandler' => function($c){
		return function($rq, $rs){
			return \geo\common\errors\BadUri::error($rq, $rs);
		};
	},
	'notAllowedHandler' => function($c){
		return function($rq, $rs, $methods){
			return \geo\common\errors\NotAllowed::error($rq, $rs, $methods);
		};
	},
	'phpErrorHandler' => function($c){
		return function($rq, $rs, $error){
			return \geo\common\errors\Internal::error($rq, $rs, $error);
		};
	}];