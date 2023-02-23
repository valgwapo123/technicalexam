<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Fileupload;
class Maincontroller extends Controller
{

 public function register(Request $request)
    {
        //


        $fields=$request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string',
        
        ]);


             $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
           
        ]);


        $response=[


        'user'=>'Register Successfully',
 
        ];

        return response($response, 201);
    }

         public function login(Request $request){

        $fields=$request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);


        //Check email

        $user=User::where('email',$fields['email'])->first();


        //Checkpassword
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message'=>'Bad Creds'
            ],401);
        }

        $token= $user->createToken('myapptoken')->plainTextToken;

        $response=[
            'message'=>'Sucess',
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'token'=>$token,
        
          
    
        ];

        //   'redirect_link'=>($user->firstlogin == 0) ? 'Setup' : 'Dashboard',

        return response($response, 201);
    }


   public function storecontact(Request $request)
    {
        //


        $fields=$request->validate([
            'title'=>'required|string',
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'mobilenumber'=>'required|string',
            'companyname'=>'required|string',
        
        ]);


        $Fileupload=Fileupload::create([
        'title'=>$request->title,
        'firstname'=>$request->firstname,
        'lastname'=> $request->lastname,
         'mobilenumber'=> $request->mobilenumber,
          'companyname'=> $request->companyname,

        ]);


        $response=[


        'message'=>'Contact Save Successfully',
 
        ];

        return response($response, 201);
    }


     public function deletecontact(Request $request)
    {
        //


        $fields=$request->validate([
            'id'=>'required|string|exists:fileuploads,id',
          
        
        ]);

        $res=Fileupload::where('id',$request->id)->delete();



        $response=[


        'message'=>'Contact delete Successfully',
 
        ];

        return response($response, 201);
    }


         public function updatecontact(Request $request)
    {
        //


        $fields=$request->validate([
            'id'=>'required|string|exists:fileuploads,id',
             'title'=>'required|string',
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'mobilenumber'=>'required|string',
            'companyname'=>'required|string',
          
        
        ]);

        $res=Fileupload::where('id',$request->id)->delete();


        Fileupload::UpdateOrCreate(
                    ['id' => $request->id],
                    [    

                    'title'=>$request->title,
                    'firstname'=>$request->firstname,
                    'lastname'=>$request->lastname,
                    'tin'=>$request->tin,
                    'mobilenumber'=>$request->mobilenumber,
                    'companyname'=>$request->companyname,
                
                    ]
                );


        $response=[


        'message'=>'Contact update Successfully',
 
        ];

        return response($response, 201);
    }

     public function contactdetail(Request $request ,$id)
    {
           $user=Fileupload::where('id',$id)->get();


        $response=[


        'contactinfo'=> $user,

        ];

          return response($response, 201);

    }    
    
}
