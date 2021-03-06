<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectProjectTags;

class ProjectProjectTagsController extends Controller
{

    public function index()
    {
    }

    public function store(Request $request)
    {
        ProjectProjectTags::where('project_id', $request->project_id)->delete();
        foreach ($request['tags'] as $t) {
            foreach ($t as $t2) {
                $data1 = new ProjectProjectTags();
                $data1->project_id = $request->project_id;
                $data1->tag_id = $t2;
                $data1->save();
            }
        }
        foreach ($request->clusterTags as $t) {
            if ($t['selected'] == true) {
                $data = new ProjectProjectTags();
                $data->project_id = $request->project_id;
                $data->tag_id = $t['id'];
                $data->budget = $t['budget'];//budget
                $data->main = ($request->mainClusterTag && $t['id'] == $request->mainClusterTag) ? 1 : 0;
                $data->save();
            }
        }
        return ['status' => true, 'data' => $data];
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function recursive_childrens($item)
    {
        if (count($item->childrens) > 0) {
            foreach ($item->childrens as $c) {
                $data = ProjectTags::where('parent_id', $c->id)->get();
                foreach ($data as $d)
                    $d = $this->recursive_childrens($d);
                $c->childrens = $data;
            }
        }
        return $item;
    }
}