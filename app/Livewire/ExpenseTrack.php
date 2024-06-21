<?php

namespace App\Livewire;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseTrack extends Component
{
    use WithPagination, LivewireAlert;

    public function delete_expense(Expense $expense)
    {
        $expense->delete();

        $this->alert('success', 'Berhasil Menghapus Catatan Pengeluaran!', [
            'position' => 'bottom-right',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        return view('livewire.expense-track', [
            'expenses' => Expense::latest()->paginate(20),
        ]);
    }
}
