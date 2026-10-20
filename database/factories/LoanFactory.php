<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition(): array
    {
        $loanDate = fake()->dateTimeBetween('-30 days', 'now');
        $dueDate = fake()->dateTimeBetween($loanDate, '+14 days');

        return [
            'loan_code' => 'PJ-' . fake()->unique()->numberBetween(1, 999),
            'book_id' => Book::factory(),
            'member_id' => Member::factory(),
            'loan_date' => $loanDate,
            'due_date' => $dueDate,
            'return_date' => null,
            'status' => 'Dipinjam',
            'days_late' => 0,
            'fine' => 0,
        ];
    }

    public function returned(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'Dikembalikan',
            'return_date' => fake()->dateTimeBetween($attributes['loan_date'], 'now'),
        ]);
    }
}