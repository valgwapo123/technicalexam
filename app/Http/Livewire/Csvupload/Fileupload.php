<?php

namespace App\Http\Livewire\Csvupload;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\ImportCsv;
use App\Imports\Checkheader;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Fileupload as filupload;
class Fileupload extends Component
{

    use WithFileUploads;
    public $action,$Checkheader;

    public $isOpen;
    public $csvfile; 
     public $search, $query;

    public $title,$firstname,$lastname,$mobilenumber,$companyname ,$editid;
    public function render()
    {

         if($this->query !=''){
             $search = '%'.$this->search.'%';
         }else{
               $search = '%'.''.'%';
             
         } 

        $listcsv = filupload::where('title','like', $search)->orwhere('mobilenumber','like', $search)->OrWhere('firstname','like', $search)->OrWhere('lastname','like', $search)->orderBy('id', 'DESC')->paginate(5)->fragment('fileuploads');


        return view('livewire.csvupload.fileupload',compact('listcsv'));
    }

     public function searchitem(){
               $this->search= $this->query;
    }


     public function editdata($id){
        $this->action='update';
        $this->isOpen=true;
        $fileupload = filupload::where('id',$id)->first();
        $this->editid=$id;
        $this->firstname=$fileupload->firstname;
        $this->lastname=$fileupload->lastname;
        $this->mobilenumber=$fileupload->mobilenumber;
        $this->companyname=$fileupload->companyname;
        $this->title=$fileupload->title;
     }

    public function uploadbutton(){
        $this->action='create';
        $this->isOpen=true;

    } 

      public function deleteData($id){
        $this->action='delete';
        $this->isOpen=true;
        $this->editid=$id;


    } 


    public function btndelete(){
          $res=filupload::where('id',$this->editid)->delete();


        session()->flash('status', 'Successfully Delete.');

        redirect()->to('/uploadfile');
    }



    public function btnsave(){

            $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'mobilenumber' => 'required',
            'companyname' => 'required',
            'title' => 'required',


            ],

     
        );


        $data = filupload::find($this->editid);
        $data->firstname = $this->firstname;
        $data->lastname = $this->lastname;
        $data->mobilenumber = $this->mobilenumber;
        $data->companyname = $this->companyname;
        $data->title = $this->title;
        $data->save();

        session()->flash('status', 'Successfully updated.');

        redirect()->to('/uploadfile');

    }

    public function closeModal(){
    
         $this->isOpen=false;
    }


      public function importdata(){



           $this->validate([
            'csvfile' => 'required|mimes:xlsx, csv, xls',
           

        ],
        [
             'csvfile.mimes' => 'The file must be a file of type: xlsx, csv, xls.',
    
        ]
        );


         // session(['schemeid' => $this->contributionid]);


      $this->Checkheader=false;
      
      if(!empty($this->csvfile)){


        $rows = Excel::toArray(new Checkheader, $this->csvfile)[0]; 

      

          if($rows[0][0]=='Title' && $rows[0][1]=='First Name' && $rows[0][2]=='Last Name' && $rows[0][3]=='Mobile Number'  && $rows[0][4]=='Company Name'){


            //   $affected_item_models = DB::table('contribution_schemes')->where('contribution_id',$this->contributionid)
            // ->update(array('status' => '0'));


            
            Excel::import(new ImportCsv, $this->csvfile);



            redirect()->to('/uploadfile');  
           
               
         }else{
               $this->Checkheader=true;  
         }

     
  
          

      }

    

   }
}
