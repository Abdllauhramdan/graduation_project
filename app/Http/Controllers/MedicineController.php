<?php

namespace App\Http\Controllers;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Http\Requests\MedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Http\Resources\MedicineResource;;
use Illuminate\Support\Facades\Log;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Traits\MedicineNotificationTrait;
use App\Mail\SendMedicineExpirationMail;




class MedicineController extends Controller
{
    use ApiResponseTrait;
    use UploadFileTrait;
    use MedicineNotificationTrait;


//     function __construct()
// {
//     $this->middleware(['permission:view-medicines'], ['only' => ['index']]);
//     $this->middleware(['permission:create-medicine'], ['only' => ['store']]);
//     $this->middleware(['permission:update-medicine'], ['only' => ['update']]);
//     $this->middleware(['permission:delete-medicine'], ['only' => ['destroy']]);
//     $this->middleware(['permission:restore-medicine'], ['only' => ['restore']]);
//     $this->middleware(['permission:force-delete-medicine'], ['only' => ['forceDelete']]);
// }

    public function index()
    {
        try {
            $medicines = Medicine::all();
            return $this->customeResponse(MedicineResource::collection($medicines), "Done", 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    public function store(MedicineRequest $request)
    {
        try {
            $medicine = Medicine::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'company_name' => $request->company_name,
                'prescription_status' => $request->prescription_status,
                'category_id' => $request->category_id,
                'production_date' => $request->production_date, //?? now(), 
                'expiration_date' => $request->expiration_date, //?? now()->addYear(),
                'purchase_price' => $request->purchase_price ,//?? 0.00,  // استخدم قيمة افتراضية لسعر الشراء
                'selling_price' => $request->selling_price ,//?? 0.00,  // استخدم قيمة افتراضية لسعر البيع
                'med_image' => $request->hasFile('med_image') ? $this->uploadFile($request->file('med_image'), 'medicines_images') : null,
                'alternative' => $request->alternative,
                'description' => $request->description,
                'contraindications' => $request->contraindications,
                'dose' => $request->dose,
                'medicine_shape' => $request->medicine_shape,
                'max_quantity_allowed' => $request->max_quantity_allowed
            ]);
            return $this->customeResponse(new MedicineResource($medicine), 'Medicine created successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->$th ;
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    public function show(Medicine $medicine)
    {
        try {
            

            return $this->customeResponse(new MedicineResource($medicine), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    public function update(MedicineRequest $request, Medicine $medicine)
    {
        try {
            
            $medicine->name = $request->input('name', $medicine->name);
            $medicine->quantity = $request->input('quantity', $medicine->quantity);
            $medicine->company_name = $request->input('company_name', $medicine->company_name);
            $medicine->prescription_status = $request->input('prescription_status', $medicine->prescription_status);
            $medicine->category_id = $request->input('category_id', $medicine->category_id);
            $medicine->production_date = $request->input('production_date', $medicine->production_date);
            $medicine->expiration_date = $request->input('expiration_date', $medicine->expiration_date);
            $medicine->purchase_price = $request->input('purchase_price', $medicine->purchase_price);
            $medicine->selling_price = $request->input('selling_price', $medicine->selling_price);
            $medicine->med_image = $request->hasFile('med_image') ? $this->uploadFile($request->file('med_image'), 'medicines_images') : $medicine->med_image;
            $medicine->alternative = $request->input('alternative', $medicine->alternative);
            $medicine->description = $request->input('description', $medicine->description);
            $medicine->contraindications = $request->input('contraindications', $medicine->contraindications);
            $medicine->dose = $request->input('dose', $medicine->dose);
            $medicine->medicine_shape = $request->input('medicine_shape', $medicine->medicine_shape);
            $medicine->max_quantity_allowed = $request->input('max_quantity_allowed', $medicine->max_quantity_allowed);

            $medicine->save();
            return $this->customeResponse(new MedicineResource($medicine), 'Medicine updated successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
////////////////////////////////////////////
    public function destroy(Medicine $medicine)
    {
        try {
            $medicineName = $medicine->name;
            $expirationDate = $medicine->expiration_date;
            $medicine->delete();
            // إرسال الإشعار والبريد الإلكتروني قبل 15 يومًا من تاريخ انتهاء صلاحية الدواء
            // $this->sendNotificationAndEmailBeforeExpiration($medicineName, $expirationDate);
            return $this->customeResponse(null, 'Medicine deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->$th;
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
    ///////////////////////////////////////////
    public function restore(String $id)
    {
        try {
            $medicine = Medicine::withTrashed()->findOrFail($id);
            if (!$medicine->trashed()) {
                return $this->customeResponse(null, 'Medicine is not deleted. No need to restore.', 404);
            }
    
            $medicine->restore();
            return $this->customeResponse(new MedicineResource($medicine), 'Medicine restored successfully', 200);
        } catch (\Throwable $th) {
            Log::error("Error restoring medicine: " . $th->getMessage());
            return $this->customeResponse(null, "There is something wrong in server", 500);
        }
    }
    

public function forceDelete(Medicine $medicine)
{
    try {
        if ($medicine->trashed()) {
            $medicine->forceDelete();
            return $this->customeResponse("", 'Medicine force deleted successfully', 200);
        }
        return $this->customeResponse(null, 'Medicine is not deleted. Use delete first.', 404);
    } catch (\Throwable $th) {
        Log::error($th);
        return $this->customeResponse(null, "There is something wrong in server", 500);
    }
}

    
}



