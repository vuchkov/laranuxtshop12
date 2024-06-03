<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Order::factory(10)->create();
        $order = Order::create([
            'reference' => '',
            'products' => '1|1|1|2',
            'email' => 'user@user.com',
            'total_price' => 19.99,
            'paid' => false,
        ]);
        /*Order::update([
            'id' => $order->id,
            'reference' => $order->getReferenceNumberAttribute(),
        ]);*/
    }
}
