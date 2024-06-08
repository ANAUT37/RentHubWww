<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\BankAccountController;
use App\Models\BankAccount;
use App\Models\Contract\Contract;
use App\Models\User;
use App\Rules\TwoMonthsAfter;
use App\Models\Contract\ContractParticipant;
use App\Models\Contract\ContractAssociatedEnsurance;
use App\Models\Contract\ContractIncident;
use App\Models\Contract\ContractAssociatedService;
use App\Models\Contract\ContractTransaction;
use App\Models\Inmueble;
use App\Models\Contract\ContractRequest;
use App\Models\CreditCard;
use App\Models\DocParticipant;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        $userContracts = Contract::getUserContracts(Auth::user()->id);

        return view('Contract.index', [
            'user' => $request->user(),
            'userContracts' => $userContracts
        ]);
    }
    public function show(Request $request, $display_id)
    {
        $contractData = Contract::getByDisplayId($display_id);
        if($contractData!=null){
            $contractParticipants = ContractParticipant::getParticipantsById($contractData->id);
            $incidencesData = ContractIncident::getAllByContractId($contractData->id);
            $participantsData = [];
            $inmuebleData = Inmueble::getById($contractData->inmueble_id);
            foreach ($contractParticipants as $participant) {
                $data = User::getDataById($participant->user_id);
                array_push($participantsData, $data);
            }
            if (!ContractParticipant::isUserAllowedToSee($contractData->id, Auth::user()->id)) {
                return redirect()->back();
            } else {
                return view('Contract.contract', [
                    'user' => $request->user(),
                    'display_id' => $display_id,
                    'contractData' => $contractData,
                    'contractParticipants' => $contractParticipants,
                    'participantsData' => $participantsData,
                    'inmuebleData' => $inmuebleData,
                    'incidencesData' => $incidencesData
                ]);
            }
        }else{
            return redirect()->back();
        }

    }
    public function request(Request $request, $display_id)
    {
        $requestData = ContractRequest::getByDisplayId($display_id);
        if($requestData->receiver_id==Auth::user()->id){
            $contractData = Contract::getById($requestData->contract_id);
            $inmuebleData = Inmueble::getById($contractData->inmueble_id);
            $ownerId = ContractParticipant::getContractOnnwer($contractData->id);
            $ownerData = User::getDataById($ownerId->user_id);
            $ownerTypedData=User::getTypedData($ownerData->type,$ownerData->id);
            $imageAnuncio=InmuebleController::getInmuebleImages($inmuebleData->id);
            $ensurancesData = ContractAssociatedEnsurance::getContractEnsurances($contractData->id);
            $creditCardData=CreditCard::getUserWalletData($requestData->receiver_id);
            return view('Contract.request', [
                'requestData' => $requestData,
                'display_id' => $display_id,
                'contractData' => $contractData,
                'inmuebleData' => $inmuebleData,
                'listOfImages'=>$imageAnuncio,
                'ownerData' => $ownerData,
                'ensurancesData'=>$ensurancesData,
                'creditCardData'=>$creditCardData,
                'ownerTypedData'=>$ownerTypedData,
            ]);
        }
        return redirect()->back();
        

    }
    public function incidences(Request $request)
    {
        return view('Contract.index', [
            'user' => $request->user(),
        ]);
    }
    public function new(Request $request)
    {
        $userBank = BankAccount::getUserWalletData(Auth::user()->id);
        $userDocs = DocsController::getUserDocs();
        $userInmuebles = InmuebleController::getUserInmuebles();
        return view('Contract.new', [
            'user' => $request->user(),
            'userInmuebles' => $userInmuebles,
            'userDocs' => $userDocs,
            'userBank' => $userBank
        ]);
    }
    public function save(Request $request)
    {
        $messages = [
            'category.required'=>'',
            'bankAccount.required' => 'La cuenta bancaria es obligatoria.',
            'docId.required' => 'La selección de un documento es obligatoria.',
            'inmuebleId.required' => 'La selección de un inmueble es obligatoria.',
            'start.required' => 'La fecha de inicio es obligatoria.',
            'start.date' => 'La fecha de inicio no es una fecha válida.',
            'start.after' => 'La fecha de inicio debe ser posterior a hoy.',
            'end.required' => 'La fecha de finalización es obligatoria.',
            'end.date' => 'La fecha de finalización no es una fecha válida.',
            'end.after' => 'La fecha de finalización debe ser posterior a la fecha de inicio.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'price.min' => 'El precio debe ser mayor o igual a cero.',
            'fianza.required' => 'La fianza es obligatoria.',
            'fianza.numeric' => 'La fianza debe ser un número.',
            'fianza.min' => 'La fianza debe ser mayor o igual a cero.',
            'rules.string' => 'Las reglas deben ser una cadena de texto.',
            'paymentFrequence.required' => 'La frecuencia de pago es obligatoria.',
            'paymentFrequence.string' => 'La frecuencia de pago debe ser una cadena de texto.',
        ];
    
        $validatedData = $request->validate([
            'category'=>'required',
            'start' => 'required|date|after:today',
            'bankAccount' => 'required',
            'docId' => 'required',
            'inmuebleId' => 'required',
            'end' => ['required', 'date', 'after:start', new TwoMonthsAfter('start')],
            'price' => 'required|numeric|min:5',
            'fianza' => 'required|numeric|min:0',
            'rules' => 'nullable|string',
            'paymentFrequence' => 'required|string|max:255',
        ], $messages);
    
        // Crear y guardar el contrato
        $contract = new Contract();
        $contract->display_id = uniqid();
        $contract->category = $validatedData['category'];
        $contract->display_name = "";
        $contract->chat_id = "1";
        $contract->bank_account_id = $validatedData['bankAccount'];
        $contract->document_id = $validatedData['docId'];
        $contract->inmueble_id = $validatedData['inmuebleId'];
        $contract->start_date = $validatedData['start'];
        $contract->end_date = $validatedData['end'];
        $contract->price = $validatedData['price'];
        $contract->bail = $validatedData['fianza'];
        $contract->rules = $validatedData['rules'];
        $contract->payment_frequency = $validatedData['paymentFrequence'];
        $contract->save();
    
        // Guardar los seguros asociados
        $prefix = "seguro-insurance-";
        $i = 0;
        while ($request->has($prefix . "company-name-" . $i)) {
            $seguro = new ContractAssociatedEnsurance();
            $seguro->contract_id = $contract->id;
            $seguro->company_name = $validatedData[$prefix . "company-name-" . $i];
            $seguro->policy_number = $validatedData[$prefix . "policy-number-" . $i];
            $seguro->start_insurance_date = $validatedData[$prefix . "start-date-" . $i];
            $seguro->end_insurance_date = $validatedData[$prefix . "end-date-" . $i];
            $seguro->insured_amount = $validatedData[$prefix . "amount-" . $i];
            $seguro->insurance_cost = $validatedData[$prefix . "price-" . $i];
            $seguro->description = $validatedData[$prefix . "description-" . $i];
            $seguro->contact_information = $validatedData[$prefix . "contact-" . $i];
            $seguro->save();
    
            $i++;
        }
    
        // Guardar el propietario
        $owner = new ContractParticipant();
        $owner->role = "owner";
        $owner->user_id = Auth::user()->id;
        $owner->contract_id = $contract->id;
        $owner->status = "active";
        $owner->save();
    
        // Redirigir a la página de gestión del contrato
        return redirect()->route('/management/contract/'.$contract->display_id);
    }
    
    public function createRequest(Request $request)
    {
        // Validar los datos entrantes
        $validated = $request->validate([
            'contract_id' => 'required',
            'sender_id' => 'required',
            'receiver_id' => 'required',
        ]);
        $display_id=uniqid();
        // Crear la solicitud de contrato
        $contractRequest = ContractRequest::create([
            'display_id'=>$display_id,
            'contract_id' => $validated['contract_id'],
            'sender_id' => $validated['sender_id'],
            'receiver_id' => $validated['receiver_id'],
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $contractRequest->save();

        // Devolver una respuesta JSON
        return response()->json(['data' => $display_id], 200);
    }
    public static function getData($display_id){
        $requestData=ContractRequest::where('display_id',$display_id)->first();
        $contractData=Contract::getById($requestData->contract_id)->first();
        return response()->json([
            'requestData' => $requestData,
            'contractData'=>$contractData
            ], 200);
    }
    public static function requestHandle(Request $request)
    {
        $requestData = ContractRequest::getByDisplayId($request->display_id);
        $contractData= Contract::getById($requestData->contract_id);

        if (!$requestData) {
            return response()->json(['error' => 'Request not found'], 404);
        }
    
        $action = $request->input('action');
        
        if ($action === 'decline') {
            $requestData->status = 'decline';
            $requestData->save();
            
            return response()->json(['data' => 'OK DECLINED'], 200);
        } elseif ($action === 'accept') {
            $contractParticipant = new ContractParticipant();
            if($request->input('payment_process')=='automatic'){
                if (!$request->has('creditCard')) {
                    return response()->json(['error' => 'Debes seleccionar una tarjeta de crédito'], 400);
                }else{
                    $contractParticipant->credit_card_id = $request->input('creditCard');
                }
            }

            $contractParticipant->role = 'tenant';
            $contractParticipant->contract_id = $requestData->contract_id;
            $contractParticipant->user_id = $requestData->receiver_id;
            $contractParticipant->status = 'active';

            $contractParticipant->save();

            $requestData->status = 'accept';
            $requestData->save();
            
            $docParticipant=new DocParticipant();
            $docParticipant->user_id=$requestData->receiver_id;
            $docParticipant->document_id=$contractData->document_id;
            $docParticipant->editable=0;
            $docParticipant->owner=0;
            $docParticipant->save();
            
            return response()->json(['data' => 'OK ACCEPTED'], 200);
        } else {
            return response()->json(['error' => 'Invalid action'], 400);
        }
    }
}
