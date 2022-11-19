<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jobs = DB::table("job_posts")
        ->join('companies', 'companies.id', '=', 'job_posts.id')
        ->select(
           "job_posts.id as job_id",
           "job_posts.job_title as job_title",
           "job_posts.job_description as job_description",
           "job_posts.salary as salary",
           "job_posts.status as status",
           "job_posts.expire_date as expire_date",
           "job_posts.created_at as created_at",
           "job_posts.updated_at as updated_at",
           "companies.id as company_id",
           "companies.company_name as company_name",
           "companies.company_logo as company_logo",
           "companies.company_address as company_address",
           "companies.company_website as company_website",
           "companies.company_website as company_website",
        )->get();
        $response = [
            'success' => true,
            'data' => $jobs,
            'message' => 'All jobs display successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $job = new JobPost();
        $job->job_title = $request->job_title;
        $job->job_description = $request->job_description;
        $job->salary = $request->salary;
        $job->company_id = $request->company_id;
        $job->expire_date = $request->expire_date;
        $job->save();
        return response()->json([
            'status' => true,
            'message' => 'Job posted!',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $job = DB::table("job_posts")
        ->join('companies', 'companies.id', '=', 'job_posts.id')
        ->select(
           "job_posts.id as job_id",
           "job_posts.job_title as job_title",
           "job_posts.job_description as job_description",
           "job_posts.salary as salary",
           "job_posts.status as status",
           "job_posts.expire_date as expire_date",
           "job_posts.created_at as created_at",
           "job_posts.updated_at as updated_at",
           "companies.id as company_id",
           "companies.company_name as company_name",
           "companies.company_logo as company_logo",
           "companies.company_address as company_address",
           "companies.company_website as company_website",
           "companies.company_website as company_website",
        )->where('job_posts.id', '=', $id)
        ->get();
        $response = [
            'success' => true,
            'data' => $job,
            'message' => 'job display successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $job = JobPost::find($id);
        $job->status = 1;
        $job->save();
        $response = [
            'success' => true,
            'data' => $job,
            'message' => 'job closed successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $job = JobPost::find($id);
        $job->job_title = $request->job_title;
        $job->job_description = $request->job_description;
        $job->salary = $request->salary;
        $job->company_id = $request->company_id;
        $job->expire_date = $request->expire_date;
        $job->save();
        return response()->json([
            'status' => true,
            'job' => $job,
            'message' => 'Job updated!',
        ], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $job = JobPost::find($id);
        $job->delete();
        $response = [
            'success' => true,
            'data' => $job,
            'message' => 'job has been deleted'
        ];
        return Response()->json($response, 200);
    }
}
