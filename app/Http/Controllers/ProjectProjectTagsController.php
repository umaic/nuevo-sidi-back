<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectProjectTags;

class ProjectProjectTagsController extends Controller{

    public function index() {
    }

    public function store(Request $request){
        ProjectProjectTags::where('project_id', $request->project_id)->delete();
        foreach ($request->tags as $t) {
            foreach ($t as $t2) {
                $data = new ProjectProjectTags();
                $data->project_id = $request->project_id;
                $data->tag_id = $t2;
                $data->save();
            }
        }
        return ['status' => true];
    } 

    public function show($id){
    }

    public function update(Request $request, $id){
    }

    public function destroy($id){
    }

    public function recursive_childrens($item){
      if(count($item->childrens) > 0){
        foreach($item->childrens as $c){
          $data = ProjectTags::where('parent_id', $c->id)->get();
          foreach ($data as $d) 
            $d = $this->recursive_childrens($d);
          $c->childrens = $data;
        }
      }
      return $item;
    }
}