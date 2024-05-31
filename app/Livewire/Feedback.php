<?php

namespace App\Livewire;

use Filament\Actions\Action;
use App\Filament\Resources\FeedbackResource;
use App\Models\Feedback as ModelsFeedback;
use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Livewire\Notifications;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action as NotificationsActionsAction;
use Filament\Notifications\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Feedback extends Component implements HasForms
{
    use InteractsWithForms;

    public $name;

    public $email;

    public $phone;

    public $receipt_number;

    public $rating;

    public $title;

    public $description;

    public $date;

    public $feedback;

    public function getFormSchema(): array
    {
        return FeedbackResource::getFormSchema();
    }

    public function getFormModel(): Model|string|null
    {
        return Report::class;
    }

    public function submit()
    {
        $data = $this->form->getState();

        $feedback = ModelsFeedback::create($data);

        $this->form->model($feedback)->saveRelationships();

        if ($feedback) {
            Notification::make('new_feedback')
                ->title('Ada ulasan baru')
                ->body("{$data['name']} - {$data['email']} Silahkan lihat di tab laporan pelanggan")
                ->iconcolor('primary')
                ->icon('heroicon-o-chat-bubble-left-right')
                ->success()
                ->actions([
                    NotificationsActionsAction::make('view')
                        ->button()
                        ->label('Lihat')
                        ->color('info')
                        ->markAsRead()
                        ->url(FeedbackResource::getUrl('view', [$feedback->id])),
                ])->sendToDatabase(User::all());

            Notification::make('success')
                ->title('Berhasil')
                ->body('Ulasan berhasil dikirim')
                ->success()
                ->send();

            $this->redirect(route('feedback'));
        } else {
            Notification::make('failed')
                ->title('Gagal')
                ->body('Ulasan gagal dikirim')
                ->danger()
                ->send();
        };
    }

    public function render()
    {
        return view('livewire.feedback');
    }
}
