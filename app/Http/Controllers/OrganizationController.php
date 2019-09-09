<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Organization;
use App\Jobs\SetupInstance;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = Organization::latest()->paginate(20);
        return view('organizations.index',compact('organizations'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'identifier' => 'required',
        ]);
        
        $organization = Organization::create($request->all());
        $organization->status = 'Processing';
        $organization->save();
        //Add into queue the event
        dispatch((new SetupInstance($organization))->delay(Carbon::now()->addSeconds(5)));

        return redirect()->route('organization.index')
                        ->with('success','Organizations created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Organization $organization)
    {
        return view('organizations.show',compact('organization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        return view('organizations.edit',compact('organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        $organization->update($request->all());

        return redirect()->route('organization.index')
                        ->with('success','Organization updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //dd($organization);
        $organization->delete();
        return redirect()->route('organization.index')
                        ->with('success','Organization deleted successfully');
    }
}
