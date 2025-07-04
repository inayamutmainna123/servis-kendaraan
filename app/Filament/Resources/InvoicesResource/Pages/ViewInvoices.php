<?php

namespace App\Filament\Resources\InvoicesResource\Pages;

use App\Filament\Resources\InvoicesResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvoiceMail;


class ViewInvoices extends ViewRecord
{
    protected static string $resource = InvoicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),

            Actions\Action::make('Kirim Struk')
                ->label('Kirim Struk ke Email')
                ->icon('heroicon-o-paper-airplane')
                ->requiresConfirmation()
                ->action(function () {
                    $invoice = $this->record->load('items');
                
                    // Generate PDF dari view blade
                    $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));
                
                    // Kirim email dengan attachment PDF
                    Mail::to($invoice->customer_email)->send(new SendInvoiceMail($invoice, $pdf->output()));
                
                    $this->notify('success', 'Struk berhasil dikirim ke email customer.');
                }),
                

            Actions\Action::make('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->label('Download Struk')
                ->openUrlInNewTab(),
        ];
    }
    
}
