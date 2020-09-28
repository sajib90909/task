<?php

namespace App\Http\Controllers;

use App\Models\segmentLogics;
use App\Models\segments;
use App\Models\subscribers;
use Illuminate\Http\Request;

class segmentController extends Controller
{
    private function saveSegmentLogic($request,$target_value,$segment_id){
        $action_type = 'action_type_'.$target_value;
        $action_column = 'action_column_'.$target_value;
        $logic_type = 'logic_type_'.$target_value;
        $logic_value = 'logic_value_'.$target_value;
        $logic_operator = 'logic_operator_'.$target_value;
        if(empty($action_type) || empty($action_column) || empty($logic_type) || empty($logic_value) || empty($logic_operator)){
            return false;
        }
        $new_segment_logic = new segmentLogics();
        $new_segment_logic->segments_id = $segment_id;
        $new_segment_logic->action_column = $request->$action_column;
        $new_segment_logic->logic_type = $request->$logic_type;
        if($request->$logic_type == 'between'){
            $logic_2nd_value = 'logic_2nd_value_'.$target_value;
            $new_segment_logic->logic_value = $request->$logic_value.','.$request->$logic_2nd_value;
        }else{
            $new_segment_logic->logic_value = $request->$logic_value;
        }
        $new_segment_logic->logic_operator = $request->$logic_operator;
        $new_segment_logic->action_type = $request->$action_type;
        $new_segment_logic->save();
        return true;

    }
    private function logicOperatorText($target_column,$logic,$logic_Value,$operator,$subscribers_data){
        if($operator == 'and'){
            $subscribers_data->where($target_column,$logic,$logic_Value);
        }else{
            $subscribers_data->orWhere($target_column,$logic,$logic_Value);
        }
        return $subscribers_data;
    }
    private function textLogic($subscribers_data,$segmentLogic){
        if($segmentLogic->logic_type == 'is'){
            $subscribers_data = $this->logicOperatorText($segmentLogic->action_column,'=',$segmentLogic->logic_value,$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'is_not'){
            $subscribers_data = $this->logicOperatorText($segmentLogic->action_column,'!=',$segmentLogic->logic_value,$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'starts_with'){
            $subscribers_data = $this->logicOperatorText($segmentLogic->action_column,'like',$segmentLogic->logic_value.'%',$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'ends_with'){
            $subscribers_data = $this->logicOperatorText($segmentLogic->action_column,'like','%'.$segmentLogic->logic_value,$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'contains'){
            $subscribers_data = $this->logicOperatorText($segmentLogic->action_column,'like','%'.$segmentLogic->logic_value.'%',$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'doesnot_starts_with'){
            $subscribers_data = $this->logicOperatorText($segmentLogic->action_column,'not like',$segmentLogic->logic_value.'%',$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'doesnot_end_with'){
            $subscribers_data = $this->logicOperatorText($segmentLogic->action_column,'not like','%'.$segmentLogic->logic_value,$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'doesnot_contains'){
            $subscribers_data = $this->logicOperatorText($segmentLogic->action_column,'not like','%'.$segmentLogic->logic_value.'%',$segmentLogic->logic_operator,$subscribers_data);
        }else{
            return false;
        }
        return $subscribers_data;
    }
    private function logicOperatorDate($target_column,$logic,$logic_Value,$operator,$subscribers_data){
        if($operator == 'and'){
            $subscribers_data->whereDate($target_column,$logic,$logic_Value);
        }else{
            $subscribers_data->orWhereDate($target_column,$logic,$logic_Value);
        }
        return $subscribers_data;
    }
    private function dateLogic($subscribers_data,$segmentLogic){
        if($segmentLogic->logic_type == 'before'){
            $subscribers_data = $this->logicOperatorDate($segmentLogic->action_column,'<',$segmentLogic->logic_value,$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'on'){
            $subscribers_data = $this->logicOperatorDate($segmentLogic->action_column,'=',$segmentLogic->logic_value,$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'after'){
            $subscribers_data = $this->logicOperatorDate($segmentLogic->action_column,'>',$segmentLogic->logic_value.'%',$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'on_or_before'){
            $subscribers_data = $this->logicOperatorDate($segmentLogic->action_column,'<=','%'.$segmentLogic->logic_value,$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'on_or_after'){
            $subscribers_data = $this->logicOperatorDate($segmentLogic->action_column,'>=','%'.$segmentLogic->logic_value.'%',$segmentLogic->logic_operator,$subscribers_data);
        }elseif($segmentLogic->logic_type == 'between'){
            $between_date_value = explode (",", $segmentLogic->logic_value);
            if($segmentLogic->logic_operator == 'and'){
                $subscribers_data->whereBetween($segmentLogic->action_column,[$between_date_value[0],$between_date_value[1]]);
            }else{
                $subscribers_data->orWhereBetween($segmentLogic->action_column,[$between_date_value[0],$between_date_value[1]]);
            }
        }else{
            return false;
        }
        return $subscribers_data;
    }
    public function segmentPage(){
        $segments = segments::all();
        return view('segments',['segments' => $segments]);
    }
    public function showData($target_segment){
        $segment = segments::where('id',$target_segment)->first();
        $subscribers_data = subscribers::where('active',1);
        foreach ($segment->segmentLogic as $segmentLogic){
            if($segmentLogic->action_type == 'date'){
                $subscribers_data = $this->dateLogic($subscribers_data,$segmentLogic);
            }else{
                $subscribers_data = $this->textLogic($subscribers_data,$segmentLogic);
            }
        }
        $subscribers_data = $subscribers_data->get();
        return view('showData',['segment'=>$segment,'subscribers_data'=>$subscribers_data]);
    }
    public function segmentAdd(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:segments',
        ]);
        $error_count = 0;
        $success_count = 0;
        $new_segment = new segments();
        $new_segment->name = $request->name;
        $new_segment->save();
        $new_segment_id = $new_segment->id;
        foreach($request->target_value as $target_value){
            if($this->saveSegmentLogic($request,$target_value,$new_segment_id)){
                $success_count++;
            }else{
                $error_count++;
            }
        }
        if($error_count > 0){
            $msg =  $success_count.' logic save And '.$error_count.' is unsaved';
        }else{
            $msg = 'add successful';
        }
        return redirect('/')->with('message',$msg);
    }

}
