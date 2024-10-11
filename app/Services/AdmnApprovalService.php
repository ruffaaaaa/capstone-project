<?php

namespace App\Services;

use App\Models\AdminApprovals;
use App\Models\ReservationApprovals;
use Illuminate\Http\Request;

class AdminApprovalService
{
    /**
     * Store or update the admin approval.
     * 
     * @param Request $request
     * @return void
     */
    public function storeApproval(Request $request)
    {
        $request->validate([
            'approval_id' => 'required|exists:reservation_approvals,approvalID',
            'admin_id' => 'required|exists:admin,id',
            'approval_status' => 'required|string|in:Approved,Denied,Pending',
        ]);

        // Step 1: Update or create the admin approval record
        $adminApproval = AdminApprovals::firstOrNew([
            'reservation_approval_id' => $request->approval_id,
            'admin_id' => $request->admin_id,
        ]);

        $adminApproval->approval_status = $request->approval_status;
        $adminApproval->save();

        // Step 2: Handle special logic for specific admin_id (e.g., admin_id == 2)
        if ($request->admin_id == 2) {
            $this->updateFinalStatus($request->approval_id, $request->approval_status);
        }
    }

    /**
     * Update the final status in ReservationApprovals based on admin approval.
     * 
     * @param int $approvalId
     * @param string $approvalStatus
     * @return void
     * @throws \Exception
     */
    protected function updateFinalStatus($approvalId, $approvalStatus)
    {
        // Find the corresponding reservation approval
        $reservationApproval = ReservationApprovals::find($approvalId);

        if ($reservationApproval) {
            if ($approvalStatus === 'Approved') {
                $reservationApproval->final_status = 'Approved';
            } elseif ($approvalStatus === 'Denied') {
                $reservationApproval->final_status = 'Denied';
            } else {
                $reservationApproval->final_status = 'Pending';
            }

            // Save the final status update
            $reservationApproval->save();
        } else {
            throw new \Exception('Reservation approval not found.');
        }
    }
}
