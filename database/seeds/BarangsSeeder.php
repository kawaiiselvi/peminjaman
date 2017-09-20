<?php

use Illuminate\Database\Seeder;
use App\Penanggung;
use App\Barang;
use App\User;
use App\BorrowLog;

class BarangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penanggung1=Penanggung::create(['name'=>'Firman']);
        $penanggung2=Penanggung::create(['name'=>'Agung']);

        $barang1=Barang::create(['title'=>'Mouse','amount'=>3, 'stock'=>2, 'penanggung_id'=>$penanggung1->id]);
        $barang2=Barang::create(['title'=>'Keyboard','amount'=>5, 'stock'=>2, 'penanggung_id'=>$penanggung2->id]);

        $member=User::where('email','member@gmail.com')->first();
        BorrowLog::create(['user_id'=>$member->id, 'barang_id'=>$barang1->id,'is_returned'=>0]);
        BorrowLog::create(['user_id'=>$member->id, 'barang_id'=>$barang2->id,'is_returned'=>0]);
    }
}
