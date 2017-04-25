<!DOCTYPE html>
<html ng-app="musejam">
<head>
	<title>Musejam Relationship Manager</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{!! URL::asset('css/style.css') !!}">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6 first-view">
				<h3>Relationship Builder</h3>
				<hr/>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<a href="#!view" class="btn btn-default">View Relations</a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<a href="#!manage" class="btn btn-primary">Manage Relations</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-offset-3 col-md-6 first-view">
            	<hr>
				<div ng-view></div>
        	</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.1/angular-route.min.js"></script>
	<script src="{!! URL::asset('js/app.js') !!}"></script>
	<script src="{!! URL::asset('js/controllers/main.js') !!}"></script>
</body>
</html>