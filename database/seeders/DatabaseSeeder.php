<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Users
        $users = [
            ['id' => 18, 'name' => 'admin', 'age' => 20, 'divisi' => 'Layanan TI', 'email' => 'admin@gmail.com', 'description' => 'Mr.Admin', 'photo' => 'profile.jpg', 'password' => '$2y$10$ZdWSNZm/a6aB4BWkbUavPOb1EWuens9ENzzAWBiEAv7KhJZLLCeH2', 'username' => 'admin', 'badge' => '12-34', 'level' => 'admin'],
            ['id' => 20, 'name' => 'Im0somn1s', 'age' => 20, 'divisi' => 'Layanan TI', 'email' => 'Im0somn1s@gmail.com', 'description' => 'Mahasiswa', 'photo' => 'man.jpg', 'password' => '$2y$10$EmSyorc5Rv6xQhYtdBKzgunx.46M0kUGNHCyYNQEOq.l7KC6a1oqK', 'username' => 'Im0somn1s', 'badge' => '12-34', 'level' => 'normal_user'],
            ['id' => 21, 'name' => 'Harjay', 'age' => 22, 'divisi' => 'Layanan TI', 'email' => 'harjay@gmail.com', 'description' => 'Mahasiswa', 'photo' => 'woman.jpg', 'password' => '$2y$10$NMR2ag2l2sbK3RToVKFlDunmD0LAYydT5aeiRIHHX0AlqbLWUKnVi', 'username' => '123', 'badge' => '12-34', 'level' => 'normal_user'],
            ['id' => 22, 'name' => 'Elda', 'age' => 19, 'divisi' => 'Layanan TI', 'email' => 'elda@gmail.com', 'description' => 'Mahasiswa', 'photo' => 'woman.jpg', 'password' => '$2y$10$6hw218NMYzZka8nnaqoLOuFXQNEqj8sFZZjtj5nuakWTq1SAXqWvq', 'username' => 'elda', 'badge' => '12-34', 'level' => 'normal_user'],
            ['id' => 24, 'name' => 'arif', 'age' => 20, 'divisi' => 'Layanan TI', 'email' => 'arif@gmail.com', 'description' => 'mahasiswa', 'photo' => 'man.jpg', 'password' => '$2y$10$sB97eTVKPITvUpnUeAKOMuK9gsIDLMkgGOjVhYraY8sLJDVldDBSi', 'username' => 'arif', 'badge' => '12-34', 'level' => 'normal_user'],
            ['id' => 25, 'name' => 'azel', 'age' => 20, 'divisi' => 'Layanan TI', 'email' => 'azel@gmail.com', 'description' => 'Pegawai Pusri', 'photo' => 'woman.jpg', 'password' => '$2y$10$jDN08WKkYr44qEwBhJiaC.lQnmN941XUOwOnbeFGY9WBUos3loepS', 'username' => 'azel', 'badge' => '12-34', 'level' => 'normal_user'],
            ['id' => 26, 'name' => 'hembang', 'age' => 20, 'divisi' => 'Layanan TI', 'email' => 'hembang@gmail.com', 'description' => 'Pegawai Pusri', 'photo' => 'profile.jpg', 'password' => '$2y$10$pLZpIVIyy3g2jMSbSCY00e1pxYfGaiqwEda/xwltt6stiw5V0rxMW', 'username' => 'hembang', 'badge' => '12-34', 'level' => 'normal_user'],
            ['id' => 27, 'name' => 'test', 'age' => 20, 'divisi' => 'Layanan TI', 'email' => 'test@gmail.com', 'description' => 'Pegawai Kontrak', 'photo' => 'man.jpg', 'password' => '$2y$10$KK63diDTvBswAyHIr8ZFiOnd1Cdgq3utyPB9CH/sqiNx/etOkWm3e', 'username' => 'test', 'badge' => '12-34-45', 'level' => 'normal_user'],
            ['id' => 28, 'name' => 'wijaya', 'age' => 20, 'divisi' => 'Layanan TI', 'email' => 'wijaya@gmail.com', 'description' => 'Kontrak 1 tahun 2024-2025', 'photo' => 'man.jpg', 'password' => '$2y$10$kwV8wyIAt1K91uIO5833XuBnnMNfAyY2XyZLjgSWV6O8bN2j6xIvC', 'username' => 'wijaya', 'badge' => '12-34-56', 'level' => 'normal_user'],
            ['id' => 29, 'name' => 'test1', 'age' => 19, 'divisi' => 'test', 'email' => 'test1@gmail.com', 'description' => 'test1', 'photo' => 'Adobe Express - file.png', 'password' => '$2y$10$fzsJw3WGB3YmG..qBjXsK.vtJhv8xaG7x/NENHZqox3LEEzfggX1W', 'username' => 'test1', 'badge' => '', 'level' => 'normal_user'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        // Seed Products
        $products = [
            ['id' => 4, 'name' => 'Keyboard Logitech', 'photo' => 'Logitech-K120.png', 'description' => 'Office Keyboard'],
            ['id' => 5, 'name' => 'FantechATOM63', 'photo' => 'FantechATOM63.png', 'description' => 'Keyboard Gaming'],
            ['id' => 6, 'name' => 'FantechKatanaSVX9s', 'photo' => 'FantechKatanaSVX9s.jpg', 'description' => 'Mouse Gaming'],
            ['id' => 7, 'name' => 'FantechVx6 Phantom ii', 'photo' => 'FantechVx6Phantomii.jpg', 'description' => 'Mouse Gaming'],
            ['id' => 8, 'name' => 'Gamen Titan V', 'photo' => 'gamenTitanV.jpg', 'description' => 'Keyboard Gaming'],
            ['id' => 9, 'name' => 'Logitech B100', 'photo' => 'LogitechB100.jpg', 'description' => 'Office Mouse'],
            ['id' => 10, 'name' => 'Logitech B175', 'photo' => 'LogitechB175.jpg', 'description' => 'Office Mouse Wireless'],
            ['id' => 11, 'name' => 'Redragon P035', 'photo' => 'RedragonP035.jpg', 'description' => 'keyboard hand rest'],
            ['id' => 12, 'name' => 'Rexus MX5.2', 'photo' => 'RexusMX5,2.jpg', 'description' => 'Gaming'],
            ['id' => 13, 'name' => 'Rexus Mx10RGB', 'photo' => 'RexusMx10RGB.jpg', 'description' => 'Gaming Keyboard'],
            ['id' => 15, 'name' => 'Logitech Mouse B100', 'photo' => 'LogitechB100.jpg', 'description' => 'Office Mouse'],
            ['id' => 16, 'name' => 'Logitech B100', 'photo' => 'LogitechB100.jpg', 'description' => 'Keyboard Office Wired'],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }

        // Seed Records
        $records = [
            ['id_records' => 24, 'id_users' => 28, 'id_products' => 9, 'status' => 'good', 'no_serial' => '2348PUBG123', 'no_inventaris' => '555DAWQ2', 'note_record' => '34', 'record_time' => '2025-01-31 14:20:35'],
            ['id_records' => 25, 'id_users' => 28, 'id_products' => 13, 'status' => 'not taken', 'no_serial' => '2348FF', 'no_inventaris' => '343TES', 'note_record' => 'gooof', 'record_time' => '2025-12-06 13:03:42'],
            ['id_records' => 27, 'id_users' => 28, 'id_products' => 10, 'status' => 'not taken', 'no_serial' => '2348FFF', 'no_inventaris' => '54TE', 'note_record' => 'Sudah selesai silakan ambil', 'record_time' => '2025-02-19 08:16:12'],
            ['id_records' => 39, 'id_users' => 27, 'id_products' => 15, 'status' => 'not taken', 'no_serial' => '65EDFF', 'no_inventaris' => '5TEDFED', 'note_record' => 'Silakan Ambil sudah diperbaiki', 'record_time' => '2025-01-29 20:04:38'],
            ['id_records' => 40, 'id_users' => 27, 'id_products' => 5, 'status' => 'good', 'no_serial' => '4ERDW', 'no_inventaris' => 'DSFGHTJ', 'note_record' => 'ga bisa', 'record_time' => '2025-01-29 20:09:07'],
            ['id_records' => 42, 'id_users' => 26, 'id_products' => 11, 'status' => 'good', 'no_serial' => '35EF', 'no_inventaris' => 'RT43WR', 'note_record' => '', 'record_time' => '2025-01-29 19:58:59'],
            ['id_records' => 43, 'id_users' => 22, 'id_products' => 4, 'status' => 'good', 'no_serial' => 'HI67', 'no_inventaris' => '34RE', 'note_record' => '', 'record_time' => '2025-01-29 20:00:42'],
            ['id_records' => 44, 'id_users' => 27, 'id_products' => 4, 'status' => 'decline', 'no_serial' => '23REFED', 'no_inventaris' => '3E2RWE12', 'note_record' => 'tidak bisa diperbaiki', 'record_time' => '2025-02-12 05:50:03'],
        ];

        foreach ($records as $record) {
            \App\Models\Record::create($record);
        }

        // Seed Repairs
        $repairs = [
            ['id_repair' => 70, 'id_user' => 27, 'id_record' => 39, 'note' => '', 'created_at' => '2025-01-27 15:29:05'],
        ];

        foreach ($repairs as $repair) {
            \App\Models\Repair::create($repair);
        }
    }
}
