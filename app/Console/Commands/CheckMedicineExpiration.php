<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Medicine; // استبدل ذلك بالنموذج المناسب
use App\Http\Traits\MedicineNotificationTrait;

class CheckMedicineExpiration extends Command
{
    use MedicineNotificationTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'medicine:check-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check medicines expiration dates and send notifications and emails if they are close to expiration';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $medicines = Medicine::all();

        foreach ($medicines as $medicine) {
            $this->sendNotificationAndEmailBeforeExpiration($medicine->name, $medicine->expiration_date);
        }

        return 0;
    }
}


// * * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1