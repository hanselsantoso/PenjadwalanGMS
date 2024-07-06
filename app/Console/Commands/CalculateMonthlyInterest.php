<?php

namespace App\Console\Commands;

use App\Services\InterestService;
use Illuminate\Console\Command;

class CalculateMonthlyInterest extends Command
{
    protected $signature = 'interest:calculate';
    protected $description = 'Calculate monthly interest for all user deposits';

    protected $interestService;

    public function __construct(InterestService $interestService)
    {
        parent::__construct();
        $this->interestService = $interestService;
    }

    public function handle()
    {
        $this->interestService->calculateMonthlyInterest();
        $this->info('Monthly interest calculated successfully.');
    }
}
