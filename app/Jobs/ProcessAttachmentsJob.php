<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Attachment;

class ProcessAttachmentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reservationId;
    protected $attachments;

    /**
     * Create a new job instance.
     *
     * @param int $reservationId
     * @param array $attachments
     */
    public function __construct($reservationId, $attachments)
    {
        $this->reservationId = $reservationId;
        $this->attachments = $attachments;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->attachments as $file) {
            // Save the file to the public/uploads/attachments directory
            $fileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/attachments', $fileName, 'public');

            // Save file information in the database
            Attachment::create([
                'reservedetailsID' => $this->reservationId,
                'file' => $filePath,
            ]);
        }
    }
}
