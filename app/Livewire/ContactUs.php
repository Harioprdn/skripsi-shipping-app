<?php

namespace App\Livewire;

use App\Filament\Resources\ReportResource;
use App\Models\Report;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Actions\Action as ActionsAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Livewire\Notifications;
use Filament\Notifications\Actions\Action as NotificationsActionsAction;
use Filament\Notifications\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Action as NotificationsAction;
use Livewire\Component;
use PhpParser\Node\Expr\Cast\String_;

class ContactUs extends Component implements HasForms
{

    use InteractsWithForms;

    public $name;

    public $email;

    public $phone;

    public $subject;

    public $message;

    public function getFormSchema(): array
    {
        return ReportResource::getFormSchema();
    }

    public function getFormModel(): Model|string|null
    {
        return Report::class;
    }

    public function submit()
    {
        $data = $this->form->getState();

        $contact_us = Report::create($data);

        $this->form->model($contact_us)->saveRelationships();

        if ($contact_us) {
            Notification::make('new_report')
                ->title('Ada laporan baru')
                ->body("{$data['name']} - {$data['email']} Silahkan lihat di tab laporan pelanggan")
                ->iconcolor('danger')
                ->icon('heroicon-o-envelope')
                ->success()
                ->actions([
                    NotificationsActionsAction::make('view')
                        ->button()
                        ->label('Lihat')
                        ->color('info')
                        ->markAsRead()
                        ->url(ReportResource::getUrl('view', [$contact_us->id])),
                ])->sendToDatabase(User::all());

            Notification::make('success')
                ->title('Berhasil')
                ->body('Laporan berhasil dikirim')
                ->success()
                ->send();

            $this->redirect(route('contact-us'));
        } else {
            Notification::make('failed')
                ->title('Gagal')
                ->body('Laporan gagal dikirim')
                ->danger()
                ->send();
        };
    }

    public function render()
    {
        return view('livewire.contact-us');
    }
}
