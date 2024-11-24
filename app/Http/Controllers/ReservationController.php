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


class ReservationController extends Controller
{
    public function showReservationForm()
    {
        $facilities = Facilities::where('facilityStatus', 'Available')->get();
        return view('make-reservation', compact('facilities'));
    }


    public function storeReservations(Request $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'nameofevent' => 'required',
                'max-attendees' => 'required|numeric',
                'event-start-date' => 'required|date_format:Y-m-d\TH:i',
                'event-end-date' => 'required|date_format:Y-m-d\TH:i',
                'preparation-start-date' => 'nullable|date_format:Y-m-d\TH:i',
                'preparation-end-date' => 'nullable|date_format:Y-m-d\TH:i',
                'cleanup-start-date' => 'nullable|date_format:Y-m-d\TH:i',
                'cleanup-end-date' => 'nullable|date_format:Y-m-d\TH:i',
                'reserveeName' => 'required',
                'email' => 'required|email',
                'person_in_charge_event' => 'required',
                'contact_details' => 'required',
                'unit_department_company' => 'required',
                'date_of_filing' => 'required|date',
                'endorsed_by' => 'nullable',
                'endorser_email' => 'nullable|email',
                'attachments.*' => 'nullable|file',
            ]);
            

            if (connection_aborted()) {
                throw new \Exception("Client connection aborted");
            }

            $eventStartDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['event-start-date'])->format('Y-m-d H:i:s');
            $eventEndDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['event-end-date'])->format('Y-m-d H:i:s');
            $prepStartDate = $validatedData['preparation-start-date'] 
                ? \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['preparation-start-date'])->format('Y-m-d H:i:s') 
                : null;

            $prepEndDate = $validatedData['preparation-end-date'] 
                ? \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['preparation-end-date'])->format('Y-m-d H:i:s') 
                : null;

            $cleanStartDate = $validatedData['cleanup-start-date'] 
                ? \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['cleanup-start-date'])->format('Y-m-d H:i:s') 
                : null;

            $cleanEndDate = $validatedData['cleanup-end-date'] 
                ? \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['cleanup-end-date'])->format('Y-m-d H:i:s') 
                : null;


            $lastReservation = ReservationDetails::latest('reservedetailsID')->first();
            $lastNumericPart = $lastReservation ? (int) $lastReservation->reservedetailsID : 10000;
            $nextNumericPart = $lastNumericPart + 1;
            $reserveeID = 'LSUFRS' . time();

            $reservationDetails = ReservationDetails::create([
                'reservedetailsID' => $nextNumericPart,
                'event_name' => $validatedData['nameofevent'],
                'max_attendees' => $validatedData['max-attendees'],
                'event_start_date' => $eventStartDate,
                'event_end_date' => $eventEndDate,
                'preparation_start_date' => $prepStartDate,
                'preparation_end_date_time' => $prepEndDate,
                'cleanup_start_date_time' => $cleanStartDate,
                'cleanup_end_date_time' => $cleanEndDate,
            ]);

            if (connection_aborted()) {
                throw new \Exception("Client connection aborted");
            }

            $personnelData = [];
            if ($request->has('personnel')) {
                $personnelNames = $request->input('personnel', []);
                $personnelQuantities = $request->input('personnel_no', []);
                foreach ($personnelNames as $index => $pname) {
                    if (!empty($pname) && !empty($personnelQuantities[$index])) {
                        $personnelData[] = [
                            'reservedetailsID' => $nextNumericPart,
                            'pname' => $pname,
                            'ptotal_no' => $personnelQuantities[$index],
                        ];
                    }
                }
            }
            if ($request->has('other_personnel_name') && $request->has('other_personnel_no')) {
                $potherName = $request->input('other_personnel_name');
                $potherQuantity = $request->input('other_personnel_no');
                if (!empty($potherName) && !empty($potherQuantity)) {
                    $personnelData[] = [
                        'reservedetailsID' => $nextNumericPart,
                        'pname' => $potherName,
                        'ptotal_no' => $potherQuantity,
                    ];
                }
            }
            if (!empty($personnelData)) {
                SupportPersonnels::insert($personnelData);
            }

            $equipmentData = [];
            if ($request->has('equipment')) {
                $equipmentNames = $request->input('equipment', []);
                $equipmentQuantities = $request->input('equipment_no', []);
                foreach ($equipmentNames as $index => $name) {
                    if (!empty($name) && !empty($equipmentQuantities[$index])) {
                        $equipmentData[] = [
                            'reservedetailsID' => $nextNumericPart,
                            'ename' => $name,
                            'etotal_no' => $equipmentQuantities[$index],
                        ];
                    }
                }
            }
            if ($request->has('other_equipment_name') && $request->has('other_equipment_no')) {
                $otherName = $request->input('other_equipment_name');
                $otherQuantity = $request->input('other_equipment_no');
                if (!empty($otherName) && !empty($otherQuantity)) {
                    $equipmentData[] = [
                        'reservedetailsID' => $nextNumericPart,
                        'ename' => $otherName,
                        'etotal_no' => $otherQuantity,
                    ];
                }
            }
            if (!empty($equipmentData)) {
                Equipment::insert($equipmentData);
            }

            if ($request->has('facility_checkbox')) {
                $facilityIDs = array_keys($request->input('facility_checkbox'));
                foreach ($facilityIDs as $facilityID) {
                    SelectedFacilities::create([
                        'reservedetailsID' => $nextNumericPart,
                        'facilityID' => $facilityID,
                    ]);
                }
                $facilityNames = Facilities::whereIn('facilityID', $facilityIDs)->pluck('facilityName')->toArray();
                $chosenFacilityList = implode(', ', $facilityNames);
            }

            if ($request->hasFile('attachments')) {
                $files = $request->file('attachments');
                foreach ($files as $file) {
                    $fileName = $file->getClientOriginalName();
                    $file->move(public_path('uploads/attachments'), $fileName);
                    Attachment::create([
                        'reservedetailsID' => $nextNumericPart,
                        'file' => 'uploads/attachments/' . $fileName,
                    ]);
                }
            }

            $reservee = Reservee::create([
                'reserveeID' => $reserveeID,
                'reserveeName' => $validatedData['reserveeName'],
                'reservedetailsID' => $nextNumericPart,
                'person_in_charge_event' => $validatedData['person_in_charge_event'],
                'email' => $validatedData['email'],
                'contact_details' => $validatedData['contact_details'],
                'unit_department_company' => $validatedData['unit_department_company'],
                'date_of_filing' => $validatedData['date_of_filing'],
            ]);

            ReservationApprovals::create([
                'reserveeID' => $reserveeID,
                'final_status' => 'Pending',
            ]);

            if (!empty($validatedData['endorsed_by']) && !empty($validatedData['endorser_email'])) {
                $confirmationToken = Str::random(32);
                Endorser::create([
                    'reserveeID' => $reserveeID,
                    'name' => $validatedData['endorsed_by'],
                    'email' => $validatedData['endorser_email'],
                    'confirmation' => false,
                    'confirmation_token' => $confirmationToken,
                ]);
                Mail::to($validatedData['endorser_email'])->send(new EndorserNotificationMail(
                    $validatedData['endorsed_by'],
                    $validatedData['reserveeName'],
                    $eventStartDate,
                    $validatedData['nameofevent'],
                    $chosenFacilityList ?? '',
                    $confirmationToken
                ));
            }

            DB::commit();

            Mail::to($validatedData['email'])->send(new ReservationCodeMail($reserveeID));

            return response()->json(['message' => 'Reservation saved successfully', 'reservationCode' => $reserveeID]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => 'Failed to save reservation', 'error' => $e->getMessage()], 500);
        }
    }

    


    private function getReservationDetails()
    {
        $reservationDetails = DB::table('reservee')
            ->join('reservation_details', 'reservee.reservedetailsID', '=', 'reservation_details.reservedetailsID')
            ->join('selected_facilities', 'selected_facilities.reservedetailsID', '=', 'reservation_details.reservedetailsID')
            ->join('facilities', 'facilities.facilityID', '=', 'selected_facilities.facilityID')
            ->leftJoin('support_personnel', 'support_personnel.reservedetailsID', '=', 'reservation_details.reservedetailsID')
            ->leftJoin('equipment', 'equipment.reservedetailsID', '=', 'reservation_details.reservedetailsID')
            ->leftJoin('reservation_approvals', 'reservation_approvals.reserveeID', '=', 'reservee.reserveeID')
            ->leftJoin('endorser', 'endorser.reserveeID', '=', 'reservee.reserveeID')
            ->leftJoin('admin_approvals', 'reservation_approvals.approvalID', '=', 'admin_approvals.reservation_approval_id')
            ->leftJoin('admin', 'admin_approvals.admin_id', '=', 'admin.id')
            ->leftJoin('admin_roles', 'admin.role_id', '=', 'admin_roles.id')
            ->leftJoin('reservation_attachments', 'reservation_attachments.reservedetailsID', '=', 'reservation_details.reservedetailsID')
            ->select(
                'reservee.*',
                'reservation_details.*',
                'selected_facilities.*',
                'facilities.*',
                'support_personnel.pname',
                'support_personnel.ptotal_no',
                'equipment.ename',
                'equipment.etotal_no',
                'endorser.name as endorser_name',
                'endorser.confirmation',
                'reservation_approvals.approvalID',
                'reservation_approvals.final_status',
                'admin_approvals.approval_status',
                'admin_approvals.admin_id',
                'admin_roles.name as role_name',
                'reservation_attachments.file as attachment_path'
            )
            ->orderBy('admin_approvals.admin_id', 'desc')
            ->get()
            ->groupBy('reserveeID'); 

        $reservationDetailsCollection = $reservationDetails->values();
        $currentPage = request()->get('page', 1); 
        $perPage = 10; 

        $pagedData = $reservationDetailsCollection->forPage($currentPage, $perPage)->values(); 
        $reservationDetailsPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $reservationDetailsCollection->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

 
        $attachments = $pagedData->pluck('attachment_path')->filter()->unique()->toArray();

        return ['reservationDetails' => $reservationDetailsPaginated, 'attachments' => $attachments];
    }


    public function listReservations($role_id, $isArchived = false)
    {
        if (Auth::check()) {
            $data = $this->getReservationDetails();
            $user = Auth::user();

            $isArchived = filter_var($isArchived, FILTER_VALIDATE_BOOLEAN);

            if ($isArchived) {
                $view = 'dashboard.aa.archive_reservationmgmt';
            } else {
                if ($role_id == 2 || $role_id == 3) {
                    $view = 'dashboard.gso&cisso.reservationmgmt';
                } elseif ($role_id == 1) {
                    $view = 'dashboard.aa.reservationmgmt';
                } else {
                    return redirect()->route('admin.reservation', ['role_id' => $user->role_id])->with('error', 'Invalid role specified');
                }
            }

            return view($view, [
                'reservationDetails' => $data['reservationDetails'],
                'user' => $user,
                'attachments' => $data['attachments'],
            ]);
        }

        return redirect()->route('login');
    }


    public function fetchStatus($reserveeID)
    {
        $reservationApproval = ReservationApprovals::where('reserveeID', $reserveeID)->first();

        if ($reservationApproval) {
            $reservee = $reservationApproval->reservee;

            $reservationDetail = $reservee ? $reservee->reservationDetails : null;

            $adminRoles = AdminRoles::all();
            $adminApprovals = AdminApprovals::where('reservation_approval_id', $reservationApproval->approvalID)
                ->with('admin.role')
                ->get();

            $adminStatuses = $adminRoles->map(function ($role) use ($adminApprovals) {
                $approval = $adminApprovals->firstWhere('admin.role.id', $role->id);

                return [
                    'admin' => $role->name,
                    'status' => $approval->approval_status ?? 'Pending'
                ];
            });

            $chosenFacilities = $reservationDetail ? $reservationDetail->facilities->map(function ($facility) {
                return $facility->facilityName;
            }) : [];

            return response()->json([
                'eventName' => $reservationDetail->event_name ?? 'No event name available',
                'eventStartDate' => $reservationDetail->event_start_date ?? 'No start date available',
                'eventEndDate' => $reservationDetail->event_end_date ?? 'No end date available',
                'reservationStatus' => $reservationApproval->final_status,
                'adminStatuses' => $adminStatuses,
                'chosenFacilities' => $chosenFacilities
            ]);
        }

        return response()->json(['error' => 'No approval data found for this Reservee'], 404);
    }


}

