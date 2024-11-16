<?php

namespace App\Http\Controllers;
use App\Models\ReservationDetails;
use App\Models\SelectedFacilities;
use App\Models\SupportPersonnels;
use App\Models\Attachment;
use App\Models\Facilities;
use App\Models\Reservee;
use App\Models\Endorser;
use App\Models\Equipment;
use App\Models\AdminSignature;
use App\Models\User;
use App\Models\AdminApprovals;
use App\Models\ReservationApprovals;
use App\Models\AdminRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationCodeMail;
use App\Mail\EndorserNotificationMail;
use App\Mail\ReservationStatusUpdateMail;
use App\Mail\DenialNoteMail;



use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


class ReservationMgmtController extends Controller

{
    //delete
    public function deleteReservation($role_id, $reservedetailsID)
    {
        $reservation = ReservationDetails::find($reservedetailsID);
        $user = Auth::user(); 
        if (!$reservation) {
            return redirect()->route('admin.reservation', ['role_id' => $role_id])->with('error', 'Reservation not found');
        }

        $reservation->delete();

        return redirect()->route('admin.reservation', ['role_id' => $role_id])->with('success', 'Reservation deleted successfully');
    }

    //updatestatus
    private function handleApproval(Request $request, $role_id)
    {
        $request->validate([
            'approval_id' => 'required|exists:reservation_approvals,approvalID',
            'admin_id' => 'required|exists:admin,id',
            'approval_status' => 'required|string|in:Approved,Denied,Pending',
        ]);

        $adminApproval = AdminApprovals::firstOrNew([
            'reservation_approval_id' => $request->approval_id,
            'admin_id' => $request->admin_id,
        ]);

        $adminApproval->approval_status = $request->approval_status;
        $adminApproval->save();

        $reservationApproval = ReservationApprovals::find($request->approval_id);

        if ($reservationApproval) {
            $finalStatus = 'Pending';
            if ($role_id == 1 && $request->approval_status === 'Denied') {
                $finalStatus = 'Denied';
            } elseif ($role_id == 3 && $request->approval_status === 'Approved') {
                $finalStatus = 'Approved';
            }
            $reservationApproval->final_status = $finalStatus;
            $reservationApproval->save();
        
            if ($request->approval_status !== 'Denied') { 
                $reservee = $reservationApproval->reservee;
                if ($reservee && $reservee->reservationDetails) {
                    $eventName = $reservee->reservationDetails->event_name;
                    $reserveeEmail = $reservee->email;
                    $note = $request->note ?? null;
        
                    $roleNames = [
                        1 => ['role' => 'AA', 'name' => 'Ms. Jamaica Quezon'],
                        2 => ['role' => 'CISSO', 'name' => 'Mr. Esmael Larubis'],
                        3 => ['role' => 'GSO', 'name' => 'Ms. Leonila Dolor']
                    ];
        
                    $approvers = AdminApprovals::where('reservation_approval_id', $request->approval_id)
                        ->with('admin')
                        ->get();
        
                    $adminList = [];
                    foreach ($roleNames as $roleId => $roleDetails) {
                        $approver = $approvers->firstWhere('admin.role_id', $roleId);
                        $status = $approver ? $approver->approval_status : 'Pending';
        
                        $adminList[] = [
                            'name' => $roleDetails['name'],
                            'role' => $roleDetails['role'],
                            'status' => $status,
                        ];
                    }
        
                    $admin = User::find($request->admin_id);
        
                    Mail::to($reserveeEmail)->send(new ReservationStatusUpdateMail(
                        $reservationApproval,
                        $request->approval_status,
                        $eventName,
                        $note,
                        $adminList,
                        $admin
                    ));
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Reservation details or Reservee not found.']);
            }
        }
        

        return redirect()->route('admin.reservation', ['role_id' => $role_id])->with('status', 'Approval status updated successfully.');
    }

    public function updateApproval(Request $request, $role_id)
    {
        if (Auth::check()) {
            return $this->handleApproval($request, $role_id);
        }

        return redirect()->back()->withErrors(['error' => 'Unauthorized access.']);
    }
    

    public function cancelReservation($reserveeID)
    {
        $reservationApproval = ReservationApprovals::where('reserveeID', $reserveeID)->first();

        if ($reservationApproval) {
            $reservationApproval->final_status = 'Cancelled';
            $reservationApproval->save();

            return view('cancelled');
        } else {
            return abort(404, 'Reservation not found');
        }
    }

    public function confirmEndorsement($token)
    {
        $endorser = Endorser::where('confirmation_token', $token)->first();

        if (!$endorser) {
            return response()->json(['message' => 'Invalid confirmation token.'], 404);
        }

        $endorser->confirmation = true;
        $endorser->confirmation_token = null; 
        $endorser->save();

        return view('confirmation', ['message' => 'Successfully confirmed. Thank you so much!']);
    }

    public function sendReserveeEmail(Request $request)
    {
        $note = $request->input('note');
        $reserveeID = $request->input('reserveeID'); 

        $reservee = Reservee::where('reserveeID', $reserveeID)->first();

        if ($reservee && $reservee->email) {
            Mail::to($reservee->email)->send(new DenialNoteMail($note));

            return response()->json(['message' => 'Email sent successfully.']);
        }

        return response()->json(['message' => 'Failed to send email. Reservee email not found.'], 404);
    }
    
}
