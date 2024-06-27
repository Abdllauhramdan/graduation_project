<?php


namespace App\Http\Controllers;

use App\Http\Requests\SalesOperationRequest;
use App\Http\Resources\SalesOperationResource;
use App\Models\Sales_operation;
use App\Models\Medicine;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Mail\SendBillMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\MedicineResource;
use Illuminate\Http\Request;


class SalesOperationController extends Controller
{
    use ApiResponseTrait, NotificationTrait;



    /**
     * Constructor for SalesOperationController.
     */
    public function __construct()
    {
        $this->middleware(['permission:view-sales-operations'], ['only' => ['index']]);
        $this->middleware(['permission:view-sales-operation'], ['only' => ['show']]);
        $this->middleware(['permission:update-sales-operation'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-sales-operation'], ['only' => ['destroy']]);
        $this->middleware(['permission:restore-sales-operation'], ['only' => ['restore']]);
        $this->middleware(['permission:force-delete-sales-operation'], ['only' => ['forceDelete']]);
        $this->middleware(['permission:remove-medicine-from-sales-operation'], ['only' => ['removeMedicine']]);
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function index()
    {
        try {
            $salesOperations = Sales_operation::all(); // تغيير النموذج إلى النموذج المحدث Sales_operation
            return $this->customeResponse(SalesOperationResource::collection($salesOperations), "Done", 200); // تغيير الاستجابة إلى customResponse
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Store a new sales operation.
     *
     * @param SalesOperationRequest $request The request object containing the sales operation data.
     * @throws \Exception If there is insufficient stock for a medicine.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the created sales operation.
     */
    public function store(SalesOperationRequest $request)
    {
        DB::beginTransaction();
        try {
            $totalPrice = 0;


            $salesOperation = Sales_operation::create([
                'date' => now(),
                'user_id' => $request->user_id,
                'quantity_sold' => 0,
                'total_price' => 0,
            ]);

            if ($request->has('medicines')) {
                foreach ($request->medicines as $medicineId => $details) {
                    $medicine = Medicine::findOrFail($medicineId);
                    if ($medicine->quantity < $details['quantity']) {
                        throw new \Exception("Insufficient stock for medicine ID: $medicineId");
                    }

                    $medicine->decrement('quantity', $details['quantity']);
                    $totalPrice += $medicine->selling_price * $details['quantity'];
                    $salesOperation->quantity_sold += $details['quantity'];

                    // إرفاق الدواء بعملية البيع
                    $salesOperation->medicines()->attach($medicineId, ['quantity' => $details['quantity']]);
                }
            }

            // تحديث إجمالي السعر بعد إرفاق الأدوية
            $salesOperation->total_price = $totalPrice;
            $salesOperation->save();

            // استعادة عملية البيع مع الأدوية المباعة
            $salesOperationWithMedicines = Sales_operation::with('medicines')->findOrFail($salesOperation->id);

            // الآن يمكنك الوصول إلى تفاصيل الأدوية المباعة في عملية البيع
            $medicinesSold = $salesOperationWithMedicines->medicines;

            // يمكنك تحويلها إلى مصفوفة لتكون متوافقة مع الاستخدام الخاص بك
            $medicinesSoldArray = $medicinesSold->toArray();

            DB::commit();

            // إرسال الإشعار باستخدام الـ trait
            // $this->sendNotification(
            //     "New Sales Operation Created",
            //     "A new sales operation has been created.",
            //     [
            //         'sales_operation_id' => $salesOperation->id,
            //         'total_price' => $salesOperation->total_price,
            //         'quantity_sold' => $salesOperation->quantity_sold,
            //         'date' => $salesOperation->date,
            //         'user_id' => $salesOperation->user_id,
            //     ]
            // );

            // إرسال البريد الإلكتروني
            // Mail::to($request->user()->email)->send(new SendBillMail($salesOperation));

            return $this->customeResponse(new SalesOperationResource($salesOperation), 'Sales operation created successfully', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return ($e);
            $this->customeResponse(null, 'Failed to create sales operation', 500, $e->getMessage());
        }
    }

    /**
     * Show a specific sales operation.
     *
     * @param Sales_operation $salesOperation The sales operation to show.
     * @throws \Throwable If an error occurs.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the sales operation.
     */
    public function show(Sales_operation $salesOperation)
    {
        try {
            return $this->customeResponse(new SalesOperationResource($salesOperation), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Update a sales operation with new data.
     *
     * @param SalesOperationRequest $request The request object containing the updated data.
     * @param Sales_operation $salesOperation The sales operation to update.
     * @throws \Exception If there is insufficient stock for a medicine.
     * @return \Illuminate\Http\JsonResponse The JSON response containing the updated sales operation.
     */
    public function update(SalesOperationRequest $request, Sales_operation $salesOperation)
    {
        DB::beginTransaction();
        try {
            $totalPrice = 0;
            $quantitySold = 0;

            $salesOperation->update([
                // 'employee_id' => $request->employee_id,
                'user_id' => $request->user_id,
            ]);

            if ($request->has('medicines')) {
                foreach ($request->medicines as $medicineId => $details) {
                    $medicine = Medicine::findOrFail($medicineId);
                    if ($medicine->quantity < $details['quantity']) {
                        throw new \Exception("Insufficient stock for medicine ID: $medicineId");
                    }

                    $medicine->decrement('quantity', $details['quantity']);
                    $totalPrice += $medicine->selling_price * $details['quantity'];
                    $quantitySold += $details['quantity'];

                    // إضافة الدواء إلى عملية البيع
                    if ($salesOperation->medicines()->where('medicine_id', $medicineId)->exists()) {
                        // إذا كان الدواء موجود بالفعل، زيادة الكمية المباعة
                        $salesOperation->medicines()->updateExistingPivot($medicineId, ['quantity' => DB::raw('quantity + ' . $details['quantity'])]);
                    } else {
                        // إذا لم يكن الدواء موجود، قم بإضافته
                        $salesOperation->medicines()->attach($medicineId, ['quantity' => $details['quantity']]);
                    }
                }
            }

            $salesOperation->total_price = $totalPrice;
            $salesOperation->quantity_sold = $quantitySold;
            $salesOperation->save();

            DB::commit();
            return $this->customeResponse(new SalesOperationResource($salesOperation), 'Sales operation updated successfully', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return ($e);

            return $this->customeResponse(null, 'Failed to update sales operation', 500, $e->getMessage());
        }
    }



    /**
     * Deletes a sales operation.
     *
     * @param Sales_operation $salesOperation The sales operation to be deleted.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating the success or failure of the deletion.
     */
    public function destroy(Sales_operation $salesOperation)
    {
        try {
            $salesOperation->delete();
            return $this->customeResponse(null, 'Sales operation deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "There is something wrong in server", 500);
        }
    }


    /**
     * Restores a sales operation.
     *
     * @param string $id The ID of the sales operation to restore.
     * @throws \Throwable If an error occurs while restoring the sales operation.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating the success or failure of the restoration.
     */
    public function restore(String $id)
    {
        try {
            $salesOperation = Sales_operation::withTrashed()->findOrFail($id);
            if (!$salesOperation->trashed()) {
                return $this->customeResponse(null, 'Sales operation is not deleted. No need to restore.', 404);
            }

            $salesOperation->restore();
            return $this->customeResponse(new SalesOperationResource($salesOperation), 'Sales operation restored successfully', 200);
        } catch (\Throwable $th) {
            Log::error("Error restoring sales operation: " . $th->getMessage());

            return $this->customeResponse(null, "There is something wrong in server", 500);
        }
    }

    /**
     * Deletes a sales operation forcefully.
     *
     * @param Sales_operation $salesOperation The sales operation to be deleted.
     * @throws \Throwable If an error occurs.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating the success or failure of the deletion.
     */
    public function forceDelete(Sales_operation $salesOperation)
    {
        try {
            $salesOperation->forceDelete();
            return $this->customeResponse(null, 'Sales operation force deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "There is something wrong in server", 500);
        }
    }

    /**
     * Removes a medicine from a sales operation.
     *
     * @param Request $request The HTTP request.
     * @param Sales_operation $salesOperation The sales operation.
     * @param mixed $medicineId The ID of the medicine to remove.
     * @throws \Exception If there is an error removing the medicine.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     */
    public function removeMedicine(Request $request, Sales_operation $salesOperation, $medicineId)
    {
        DB::beginTransaction();
        try {
            // تحقق من وجود الدواء في الفاتورة
            if ($salesOperation->medicines()->where('medicine_id', $medicineId)->exists()) {
                // استرجاع الدواء وكمية الترابط
                $medicine = Medicine::findOrFail($medicineId);
                $quantityDetached = $salesOperation->medicines()->find($medicineId)->pivot->quantity;

                // إزالة الدواء من الفاتورة
                $salesOperation->medicines()->detach($medicineId);

                // إعادة كمية الدواء المحذوف إلى المخزون
                $medicine->increment('quantity', $quantityDetached);

                // تحديث إجمالي سعر الفاتورة
                $totalPriceReduction = $medicine->selling_price * $quantityDetached;
                $salesOperation->total_price -= $totalPriceReduction;
                $salesOperation->save();
            } else {
                return $this->customeResponse(null, 'Medicine not found in this sales operation', 404);
            }

            DB::commit();
            return $this->customeResponse(new SalesOperationResource($salesOperation), 'Medicine removed successfully', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return $this->customeResponse(null, 'Failed to remove medicine', 500, $e->getMessage());
        }
    }
}
