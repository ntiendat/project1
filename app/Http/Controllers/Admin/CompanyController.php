<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Media;
use Illuminate\Http\Request;
use Session;
use Carbon\Carbon;
use Auth;

class CompanyController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin\company  $company
     * @return \Illuminate\Http\Response
     */
    
    public function edit()
    {
        $company = Company::all();
        $media = Media::where('type',1)->get();
        $media_share = Media::where('type',1)->get();
        $pro_media_fa = Media::join('company','company.favicon', '=', 'media.id')
            ->select('media.url')->first();
        $pro_media_logo = Media::join('company','company.logoicon', '=', 'media.id')
            ->select('media.url')->first();    

        //dd($pro_media_fa);
        return view('Admin.Company.edit',compact('company','media','media_share','pro_media_fa','pro_media_logo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,
      [
        'name'=>'required',
        'address'=>'required',
        'hotline'=>'required|numeric|max:999999999999999',
        'email'=>'required|email|max:255',
        'copyright'=>'required',
        'facebook'=>'required',
        'twitter'=>'required',
        'youtube'=>'required',
        'iframe_map'=>'required',
      ],
      [
       'name.required'=>'Tên không được trống',
       'address.required'=>'Địa chỉ không được trống',
       'hotline.required'=>'Số điện thoại không được trống',
       'email.email'=>'Phải định dạng email',
       'email.max'=>'Tối đa 255 kí tự',
       'email.required'=>'email không được trống',
       'hotline.numeric'=>'Phải là kiểu số',
       'hotline.max'=>'Không được quá 15 kí tự số',
       'copyright.required'=>'copyright không được trống',
       'facebook.required'=>'facebook không được trống',
       'twitter.required'=>'twitter không được trống',
       'youtube.required'=>'youtube không được trống',
       'iframe_map.required'=>'Địa chỉ map không được trống'
      ]);
        $data = $request->all();
        $id = $request['id'];
        $company = Company::where('id',$id)->update(
            array(
            'name' =>$request['name'],
            'address' =>$request['address'],
            'favicon'  => $request['favicon'],
            'logoicon'  => $request['logoicon'],
            'hotline'  => $request['hotline'],
            'email' =>$request['email'],
            'facebook'  => $request['facebook'],
            'copyright' =>$request['copyright'],
            'twitter'  => $request['twitter'],
            'youtube' =>$request['youtube'],
            'iframe_map'  => $request['iframe_map'],
            'user_id'  => Auth::id(),
            'created_at' =>Carbon::now()
            )
        );

        return response()->json($data);
    }

}
