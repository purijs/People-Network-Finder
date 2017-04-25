<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;
use App\Tag;
use App\Relation;
use App\Http\Requests;

class RelationController extends Controller
{
    public function store(Request $request) {
    	Relation::create($request->all());
    }

    public function fetch(Request $request) {
    	$person_a_id=intval($request->person_a);
    	$person_b_id=intval($request->person_b);
    	//degree 0 check
    	$degree_none_check_1=Relation::where('people_a',$person_a_id)->where('people_b',$person_b_id)->count();
    	$degree_none_check_2=Relation::where('people_b',$person_a_id)->where('people_a',$person_b_id)->count();
    	if($degree_none_check_1>0 || $degree_none_check_2>0) {
    		$name_a=People::where('id',$person_a_id)->pluck('name');
    		$name_b=People::where('id',$person_b_id)->pluck('name');
    		if($degree_none_check_1>0) {
    			$relation_by=Relation::where('people_a',$person_a_id)->where('people_b',$person_b_id)->pluck('relation_type');
    		}
    		else if($degree_none_check_2>0) {
    			$relation_by=Relation::where('people_b',$person_a_id)->where('people_a',$person_b_id)->pluck('relation_type');
    		}
    		$relationship=Tag::where('id',$relation_by)->pluck('name');
    		//return names and relation, degree always 0
    		return $name_a[0].' and '.$name_b[0].' are directly connected by relation: <b>'.$relationship[0].'</b><br> Degree of relations: 0';
    	} else {
    		//degree >0 check
	    	$temp_a_id=$person_a_id;
	    	$i=1;
	    	$stop=array();
	    	$stop[0]=null;
	    	$foundNormal=false;
			$foundInverse=false;
			$degree=-1;
	    	$count=Relation::all()->count();
	    	$reset=0;
	    	$level=array();
	    	while($stop[0]!=$person_a_id && $i<=$count) {
	    		$temp_b_id=$person_b_id;
	    		$stop=Relation::where('people_b',$person_b_id)->pluck('people_a');
	    		if(!isset($stop[0]))
	    			break;
	    		$person_b_id=$stop[0];
    			$level[$reset]=$temp_b_id;
	    		$level[$reset+1]=$person_b_id;
	    		$i++;
	    		$degree++;
	    		$reset=$reset+2;
	    	}
	    	if(isset($stop[0]) && $stop[0]!=$person_a_id) {
	    		$stop[0]=null;
	    		$i=1;
	    		$person_a_id=$person_b_id;
	    		$person_b_id=$temp_a_id;
	    		$degree=-1;
	    		$reset=0;
	    		$level=array();
	    		$level=null;
	    		while($stop[0]!=$person_a_id && $i<=$count) {
		    		$temp_b_id=$person_b_id;
		    		$stop=Relation::where('people_b',$person_b_id)->pluck('people_a');
		    		$person_b_id=$stop[0];
		    		$level[$reset]=$temp_b_id;
		    		$level[$reset+1]=$person_b_id;
		    		$i++;
		    		$degree++;
		    		$reset=$reset+2;
	    		}
	    		if($stop[0]!=$person_b_id) {
	    			$foundNormal=false;
	    			$foundInverse=false;	
	    		} else {
	    			$foundInverse=true;
	    		}
	    	} else {
	    		if(isset($stop[0]))
	    			$foundNormal=true;
	    		else {
	    			$foundNormal=false;
	    			$foundInverse=false;
	    		}
	    	}
	    	if($foundNormal==true || $foundInverse==true) {
	    		$count=count($level);
	    		$step=1;
	    		$i=0;
	    		$j=1;
	    		$index=0;
	    		$statement=array();
	    		while($step<=$count) {
	    			if($step%2==1) {
	    				$name_a=People::where('id',$level[$i])->pluck('name');
	    				$name_b=People::where('id',$level[$j])->pluck('name');
	    				$relation_by=Relation::where('people_a',$level[$j])->where('people_b',$level[$i])->pluck('relation_type');
	    				$relationship=Tag::where('id',$relation_by)->pluck('name');
	    				$statement[$index]=$name_a[0]." => <b>".$relationship."</b> => ".$name_b[0];
	    				$index++;
	    			}
	    			$i=$i+2;
	    			$j=$j+2;
	    			$step=$step+2;
	    		}
	    		$string="";
	    		for($i=0;$i<count($statement);$i++) {
	    			$string .=$statement[$i].'<br>';
	    		}
	    		$new_string=$string.' <br/>Relation Degree: <b>'.$degree.'</b>';
	    		return $new_string;
	    	} else {
	    		return "No relation exists";
	    	}
    	}
    }
}
