<?php

namespace App\View\Components;

use App\Models\Loan;
use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class chartsAdmin extends Component
{
    /**
     * Create a new component instance.
     */
    public $months;
    public $userCounts;
    public $loanCounts;

    public function __construct()
    {
        $this->months = $this->getLast8Months();
        $this->userCounts = $this->getMonthlyUserCounts($this->months);
        $this->loanCounts = $this->getMonthlyLoanCounts($this->months);
    }

    private function getLast8Months()
    {
        $months = [];
        for ($i = 7; $i >= 0; $i--) {
            $months[] = Carbon::now()->subMonths($i)->format('F'); // Nama bulan
        }
        return $months;
    }

    private function getMonthlyUserCounts($months)
    {
        $counts = [];
        foreach ($months as $month) {
            $counts[] = User::whereMonth('created_at', Carbon::parse($month)->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        }
        return $counts;
    }

    private function getMonthlyLoanCounts($months)
    {
        $counts = [];
        foreach ($months as $month) {
            $counts[] = Loan::whereMonth('created_at', Carbon::parse($month)->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        }
        return $counts;
    }

    public function render()
    {
        return view('components.charts-admin');
    }
}
