<?php

namespace App\Http\Controllers;

use App\Mail\onIncidenceCreated;
use Illuminate\Http\Request;
use App\Models\Contract\Contract;
use App\Models\Contract\ContractIncident;
use Illuminate\Support\Facades\Mail;
use App\Models\Contract\ContractParticipant;
use App\Models\User;

class IncidenceController extends Controller
{
    public function index(Request $request,$display_id)
    {
        $contractData=Contract::getByDisplayId($display_id);
        if($contractData!=null){
            $incidencesData=ContractIncident::getAllByContractId($contractData->id);
            return view('Contract.indexincidence', [
                'user' => $request->user(),
                'display_id'=>$display_id,
                'contractData'=>$contractData,
                'incidencesData'=>$incidencesData
            ]);
        }else{
            return redirect()->back();
        }

    }
    public function show(Request $request,$display_id,$incidence_id)
    {
        return view('Contract.contract', [
            'user' => $request->user(),
            'display_id'=>$display_id,
            'display_incidence_id'=>$incidence_id
        ]);
    }
    public function new(Request $request,$display_id)
    {   
        $incidence_id=uniqid();
        $contractData=Contract::getByDisplayId($display_id);
        if($contractData!=null){
            return view('Contract.newincidence', [
                'user' => $request->user(),
                'display_id'=>$display_id,
                'contractData'=>$contractData,
                'incidence_id'=>$incidence_id
            ]);
        }else{
            return redirect()->back();
        }

    }
    public function save(Request $request)
    {   
        $incidence=new ContractIncident();
        $incidence->display_id=$_POST['incidence_id'];
        $incidence->contract_id=$_POST['contract_id'];
        $incidence->reported_by=$_POST['reported_by'];
        $incidence->type=$_POST['incident-type'];
        $incidence->description=$_POST['description'];
        $incidence->incident_date=now();
        $incidence->save();

        $owner=ContractParticipant::getContractOnnwer($incidence->contract_id);
        $onwerMail=User::getDataById($owner->user_id);
        Mail::to($onwerMail->email)->send(new onIncidenceCreated($incidence));

        return redirect()->back();
    }

}
