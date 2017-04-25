<div class="manage" ng-controller="relations-manage">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<a ng-click="managePeople()" class="btn btn-danger">Manage People</a>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<a ng-click="manageTags()" class="btn btn-danger">Manage Tags</a>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<a ng-click="activePeople()">Add People</a>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<a ng-click="activeTags()">Add Tags</a>
		</div>
	</div>
	<div class="row" ng-show="viewTags">
		<br/>
		<table class="table table-striped tags">
			<caption>Tag's List</caption>
			<tr>
				<th style="text-align:center;">#</th>
				<th style="text-align:center;">Name</th>
				<th style="text-align:center;">Action</th>
			</tr>
			<tr ng-repeat="tag in tagList[0] track by $index">
				<td>{{ $index+1 }}</td>
				<td id="name-{{ tag.id }}">{{ tag.name }}</td>
				<td><a class="btn btn-default" ng-click="edit(tag.name,tag.id)">Edit</a></td>
			</tr>
		</table>
	</div>
	<div class="row" ng-show="viewPeople">
		<br/>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h4>Add a Relation</h4>
			<form name="addRelation" onsubmit="return false;" ng-submit="validateRelation(relationInfo);">
				<div class="alert alert-success" ng-if="successMessage">
					{{ successMessage }}
				</div>
				<div class="form-group">
					This Person <select ng-required="true" name="p_name_a" ng-model="relationInfo.p_name_a" class="form-control">
						<option value="">--Select Person 1--</option>
						<option ng-repeat="person in itemsList[0][0]" value="{{ person.id }}">{{ person.name }}</option>
					</select>
					<br>
					is
					<select ng-required="true" name="relation" ng-model="relationInfo.relation" class="form-control">
						<option value="">--Select Relation Type--</option>
						<option ng-repeat="relation in itemsList[0][1]" value="{{ relation.id }}">{{ relation.name }}</option>
					</select>
					<br>
					Of
					<select ng-required="true" name="p_name_b" ng-model="relationInfo.p_name_b" class="form-control">
						<option value="">--Select Person 2--</option>
						<option ng-repeat="person in itemsList[0][0]" ng-if="person.id!=relationInfo.p_name_a" value="{{ person.id }}">{{ person.name }}</option>
					</select>
				</div>		
				<div class="form-group">
					<input type="submit" class="btn btn-primary" ng-show="addRelation.$valid">
				</div>
			</form>
			<table class="table table-striped">
				<caption>People's List</caption>
				<tr>
					<th style="text-align:center;">#</th>
					<th style="text-align:center;">Name</th>
				</tr>
				<tr ng-repeat="person in itemsList[0][0] track by $index">
					<td>{{ $index+1 }}</td>
					<td>{{ person.name }}</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row" ng-show="addPeople">
		<br/>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<form name="peoples" onsubmit="return false;" ng-submit="validatePeople(peopleInfo);">
				<div class="alert alert-success" ng-if="successMessage">
					{{ successMessage }}
				</div>
				<div class="alert alert-danger" ng-show="peoples.p_name.$touched && peoples.p_name.$invalid">Invalid Name</div>
				<div class="form-group">
					<input ng-required="true" ng-minlength="3" ng-pattern="/^[a-zA-Z ]*$/" type="text" name="p_name" ng-model="peopleInfo.p_name" class="form-control" placeholder="Enter a name">
				</div>		
				<div class="form-group">
					<input type="submit" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	<div class="row" ng-show="addTags">
		<br/>
		<div class="col-md-offset-6 col-md-6 col-sm-6 col-xs-6">
			<form name="tags" onsubmit="return false;" ng-submit="validateTags(tagsInfo);">
				<div class="alert alert-success" ng-if="successMessage">
					{{ successMessage }}
				</div>
				<div class="alert alert-danger" ng-show="tags.t_name.$touched && tags.t_name.$invalid">Invalid Tag</div>
				<div class="form-group">
					<input ng-required="true" ng-minlength="3" ng-pattern="/^[a-zA-Z ]*$/" type="text" name="t_name" ng-model="tagsInfo.t_name" class="form-control" placeholder="Enter a tag">
				</div>		
				<div class="form-group">
					<input type="submit" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>