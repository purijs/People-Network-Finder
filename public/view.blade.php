<div class="view" ng-controller="relations-view">
	<div class="row">
		<h4>View Relation Between</h4>
		<form name="viewRelation" onsubmit="return false;" ng-submit="validateViewPeople(viewPeople);">
			<div class="col-md-5 col-sm-5 col-xs-5">
				<select ng-required="true" name="person_a" ng-model="viewPeople.person_a" class="form-control">
					<option value="">--Select Person 1--</option>
					<option ng-repeat="people in peoplesList[0][0]" value="{{ people.id }}">{{ people.name }}</option>
				</select>
			</div>
			<div class="col-md-5 col-sm-5 col-xs-5">
				<select ng-required="true" name="person_b" ng-model="viewPeople.person_b" class="form-control">
					<option value="">--Select Person 2--</option>
					<option ng-repeat="people in peoplesList[0][0]" ng-if="people.id!=viewPeople.person_a" value="{{ people.id }}">{{ people.name }}</option>
				</select>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2">
				<div class="form-group">
					<input type="submit" class="btn btn-primary" ng-show="viewRelation.$valid">
				</div>
			</div>
		</form>
		<hr/>
		<div id="print"></div>
	</div>
</div>