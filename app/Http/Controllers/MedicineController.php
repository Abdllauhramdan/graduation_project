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


    /**
     * Constructor for the class.
     *
     * This constructor sets up middleware for the class methods.
     * It applies the 'permission:view-medicines' middleware to the 'index' method,
     * the 'permission:create-medicine' middleware to the 'store' method,
     * the 'permission:update-medicine' middleware to the 'update' method,
     * the 'permission:delete-medicine' middleware to the 'destroy' method,
     * the 'permission:restore-medicine' middleware to the 'restore' method,
     * and the 'permission:force-delete-medicine' middleware to the 'forceDelete' method.
     *
     * @return void
     */
    function __construct()
{
    $this->middleware(['permission:view-medicines'], ['only' => ['index']]);
    $this->middleware(['permission:create-medicine'], ['only' => ['store']]);
    $this->middleware(['permission:update-medicine'], ['only' => ['update']]);
    $this->middleware(['permission:delete-medicine'], ['only' => ['destroy']]);
    $this->middleware(['permission:restore-medicine'], ['only' => ['restore']]);
    $this->middleware(['permission:force-delete-medicine'], ['only' => ['forceDelete']]);
}

    /**
     * Retrieves all medicines and returns a custom response.
     *
     * @throws \Throwable description of exception
     * @return Some_Return_Value
     */
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

    /**
     * Store a newly created medicine in the database.
     *
     * @param MedicineRequest $request The request object containing the medicine data.
     * @throws \Throwable If an error occurs during the creation of the medicine.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the created medicine or an error message.
     */
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

    /**
     * Retrieves a specific medicine and returns a custom response.
     *
     * @param Medicine $medicine The medicine to be retrieved.
     * @throws \Throwable If an error occurs.
     * @return \Illuminate\Http\JsonResponse The custom response.
     */
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

    /**
     * Deletes a medicine from the database and sends a notification and email before the expiration date.
     *
     * @param Medicine $medicine The medicine object to be deleted.
     * @throws \Throwable If an error occurs during the deletion process.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the result of the deletion.
     */
public function destroy(Medicine $medicine)
    {
        try {
            $medicineName = $medicine->name;
            $expirationDate = $medicine->expiration_date;
            $medicine->delete();
        
            return $this->customeResponse(null, 'Medicine deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->$th;
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
    ///////////////////////////////////////////

    /**
     * Restores a deleted medicine from the database.
     *
     * @param string $id The ID of the medicine to restore.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the medicine with the given ID is not found.
     * @throws \Throwable If an error occurs during the restoration process.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the restored medicine and a status message.
     */
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
    

    
    /**
     * Force delete a medicine from the database.
     *
     * @param Medicine $medicine The medicine object to be deleted.
     * @throws \Throwable If an error occurs during the force deletion process.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the result of the deletion.
     */
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



