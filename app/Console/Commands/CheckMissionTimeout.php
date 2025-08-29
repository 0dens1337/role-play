<?php

namespace App\Console\Commands;

use App\Enums\MissionStatusEnum;
use App\Models\Mission;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CheckMissionTimeout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-mission-timeout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $updated = DB::table('character_missions')
            ->where('deadline', '<', $now)
            ->where('status', MissionStatusEnum::ACTIVE->value)
            ->update(['status' => MissionStatusEnum::CANCELLED->value]);

        $this->info("Миссий обновлено: {$updated}");
    }
}
