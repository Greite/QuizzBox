<?php

return [
	'notFoundHandler' => function($c){
		return function($rq, $rs){
			return \quizz\common\errors\BadUri::error($rq, $rs);
		};
	},
	'notAllowedHandler' => function($c){
		return function($rq, $rs, $methods){
			return \quizz\common\errors\NotAllowed::error($rq, $rs, $methods);
		};
	},
	'phpErrorHandler' => function($c){
		return function($rq, $rs, $error){
			return \quizz\common\errors\Internal::error($rq, $rs, $error);
		};
	}];