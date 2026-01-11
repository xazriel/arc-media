<?php

namespace App\Livewire;

use Livewire\Component;

class Contact extends Component
{
    public $name, $email, $organization, $project_type = 'Sponsorship', $message;

    // Aturan validasi sesuai kebutuhan form
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'organization' => 'required',
        'message' => 'required|min:10',
    ];

    public function send()
    {
        $this->validate();

        // Di sini kamu bisa tambahkan logika kirim email atau simpan ke database
        
        session()->flash('message', 'Pesan Anda berhasil dikirim!');
        $this->reset(); // Mengosongkan form setelah kirim
    }

    public function render()
    {
    return view('livewire.contact')->layout('layouts.app');    }
    }