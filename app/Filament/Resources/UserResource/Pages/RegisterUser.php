<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;

class RegisterUser extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Registrasi Pengguna';
    protected static ?string $title = 'Registrasi Pengguna';
    protected static ?string $navigationGroup = 'Pengguna';
    protected static ?int $navigationSort = 8;
    protected static ?string $slug = 'register-user'; // URL: /admin/register-user
    protected static string $view = 'filament.pages.register-user';

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->required()
                ->email()
                ->unique(User::class, 'email'),

            Forms\Components\TextInput::make('password')
                ->label('Password')
                ->required()
                ->password()
                ->minLength(6),
        ];
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Notification::make()
            ->title('User berhasil didaftarkan!')
            ->success()
            ->send();

        $this->form->fill(); // Reset form
    }
}
