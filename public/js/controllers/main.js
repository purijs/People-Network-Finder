angular.module('mj-controller',[])
	.controller('relations-manage', ['$scope','$http','$timeout',function($scope,$http,$timeout){
		$scope.addPeople=false;
		$scope.addTags=false;
		$scope.viewPeople=false;
		$scope.viewTags=false;
		$scope.successMessage=null;
		$scope.activePeople=function() {
			$scope.addPeople=true;
			$scope.addTags=false;
			$scope.viewTags=false;
			$scope.viewPeople=false;
		}
		$scope.activeTags=function() {
			$scope.addPeople=false;
			$scope.viewPeople=false;
			$scope.viewTags=false;
			$scope.addTags=true;
		}
		$scope.managePeople=function() {
			$scope.addPeople=false;
			$scope.addTags=false;
			$scope.viewTags=false;
			$scope.viewPeople=true;
			$scope.itemsList=[];
			$http.get("http://localhost/musejam/public/people_names").then(function(response) {
            	$scope.itemsList.push(response.data);
        	});        	
		}
		$scope.manageTags=function() {
			$scope.addPeople=false;
			$scope.addTags=false;
			$scope.viewPeople=false;
			$scope.viewTags=true;
			$scope.tagList=[];
			$http.get("http://localhost/musejam/public/tag_names").then(function(response) {
            	$scope.tagList.push(response.data);
        	});        	
		}
		//form validations
		$scope.validatePeople=function(peopleInfo) {
			$scope.p_name=peopleInfo.p_name;
			$http({
	          method  : 'POST',
	          url     : '/people',
	          data    : {name:$scope.p_name}
	         })
	          .then(function (response) {
	          	$scope.successMessage="Added!";
	          	$timeout(function () { $scope.successMessage = false; }, 2000);
	          });
		}
		$scope.validateTags=function(tagsInfo) {
			$scope.t_name=tagsInfo.t_name;
			$http({
	          method  : 'POST',
	          url     : '/tag',
	          data    : {name:$scope.t_name}
	         })
	          .then(function (response) {
	          	$scope.successMessage="Added!";
	          	$timeout(function () { $scope.successMessage = false; }, 2000);
	          });
		}
		$scope.validateRelation=function(relationInfo) {
			$scope.person_a=relationInfo.p_name_a;
			$scope.relation=relationInfo.relation;
			$scope.person_b=relationInfo.p_name_b;
			$http({
	          method  : 'POST',
	          url     : '/relation',
	          data    : {people_a:$scope.person_a,people_b:$scope.person_b,relation_type:$scope.relation}
	         })
	          .then(function (response) {
	          	$scope.successMessage="Added!";
	          	$timeout(function () { $scope.successMessage = false; }, 2000);
	          });
		}
		$scope.edit=function(name,id) {
			var element = angular.element( document.querySelector( '#name-'+id ) );
			element.html('<form action="http://localhost/musejam/public/tag/update/'+id+'" method="post"><input type="text" value="'+name+'" name="name"> <input type="submit" class="btn btn-default"></form>')
		}
	}]);
angular.module('mj-controller-1',[])
	.controller('relations-view', ['$scope','$http',function($scope,$http){
		$scope.peoplesList=[];
		$http.get("http://localhost/musejam/public/people_names").then(function(response) {
            $scope.peoplesList.push(response.data);
        });
        $scope.validateViewPeople=function(viewPeople) {
			$scope.relationData=[];
			$scope.person_a=viewPeople.person_a;
			$scope.person_b=viewPeople.person_b;
			$http({
	          method  : 'POST',
	          url     : '/view_relation',
	          data    : {person_a:$scope.person_a,person_b:$scope.person_b}
	         })
	          .then(function (response) {
	          		var element = angular.element( document.querySelector( '#print' ) );
					element.html(response.data);
	          });
		}
	}]);