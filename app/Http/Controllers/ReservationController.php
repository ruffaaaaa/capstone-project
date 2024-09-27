<?php

namespace App\Http\Controllers;

use App\Models\ReservationDetails;
use App\Models\SelectedFacilities;
use App\Models\SupportPersonnels;
use App\Models\Attachment;
use App\Models\Facilities;
use App\Models\Reservee;
use App\Models\Equipment;
use App\Models\ReservationApprovals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationCodeMail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


class ReservationController extends Controller
{
    public function showReservationForm()
    {
        $facilities = Facilities::all();
        return view('make-reservation', compact('facilities'));
    }

    public function storeReservations(Request $request)
    {
        $validatedData = $request->validate([
            'nameofevent' => 'required',
            'max-attendees' => 'required|numeric',
            'event-start-date' => 'required|date_format:Y-m-d\TH:i',
            'event-end-date' => 'required|date_format:Y-m-d\TH:i',
            'preparation-start-date' => 'required|date_format:Y-m-d\TH:i',
            'preparation-end-date' => 'required|date_format:Y-m-d\TH:i',
            'cleanup-start-date' => 'required|date_format:Y-m-d\TH:i',
            'cleanup-end-date' => 'required|date_format:Y-m-d\TH:i',
            'reserveeName' => 'required',
            'email' => 'required|email',
            'person_in_charge_event' => 'required',
            'contact_details' => 'required',
            'unit_department_company' => 'required',
            'date_of_filing' => 'required|date',
            'endorsed_by' => 'required',
            'endorsement_attachment' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $eventStartDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['event-start-date'])->format('Y-m-d H:i:s');
        $eventEndDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['event-end-date'])->format('Y-m-d H:i:s');
        $prepStartDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['preparation-start-date'])->format('Y-m-d H:i:s');
        $prepEndDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['preparation-end-date'])->format('Y-m-d H:i:s');
        $cleanStartDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['cleanup-start-date'])->format('Y-m-d H:i:s');
        $cleanEndDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $validatedData['cleanup-end-date'])->format('Y-m-d H:i:s');

        $lastReservation = ReservationDetails::latest('reservedetailsID')->first();
        $lastNumericPart = $lastReservation ? (int) $lastReservation->reservedetailsID : 10000;
        $nextNumericPart = $lastNumericPart + 1;
        $reserveeID = 'LSUFRS' . time();

        if (!file_exists(public_path('uploads/attachments'))) {
            mkdir(public_path('uploads/attachments'), 0755, true);
        }

        if ($request->hasFile('endorsement_attachment')) {
            $file = $request->file('endorsement_attachment');
            $filePath = $file->move(public_path('uploads/attachments'), $file->getClientOriginalName());
            $validatedData['endorsement_attachment'] = 'uploads/attachments/' . $file->getClientOriginalName();
        }

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
            // Fetch the input values
            $potherName = $request->input('other_personnel_name');
            $potherQuantity = $request->input('other_personnel_no');
        
            // Ensure the checkbox is checked and the inputs are not empty
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
            foreach ($request->input('facility_checkbox') as $facilityID => $checked) {
                SelectedFacilities::create([
                    'reservedetailsID' => $nextNumericPart,
                    'facilityID' => $facilityID,
                ]);
            }
        }

        $attachmentFilenames = [];

        if ($request->hasFile('attachments')) {
            $attachments = $request->file('attachments');

            foreach ($attachments as $attachment) {
                $originalFilename = $attachment->getClientOriginalName();
                $originalFilename = str_replace([' ', ','], ['_', ''], $originalFilename);
                $originalPath = '' . $originalFilename;
                $attachment->move(public_path('uploads/attachments'), $originalFilename);
                $attachmentFilenames[] = $originalPath;
            }
        }

        $attachmentFilenameString = implode(', ', $attachmentFilenames);

        Attachment::create([
            'reservedetailsID' => $nextNumericPart,
            'file' => $attachmentFilenameString,
        ]);

        

        $reservee = Reservee::create([
            'reserveeID' => $reserveeID,
            'reserveeName' => $validatedData['reserveeName'],
            'reservedetailsID' => $nextNumericPart,
            'person_in_charge_event' => $validatedData['person_in_charge_event'],
            'email' => $validatedData['email'],
            'contact_details' => $validatedData['contact_details'],
            'unit_department_company' => $validatedData['unit_department_company'],
            'date_of_filing' => $validatedData['date_of_filing'],
            'endorsed_by' => $validatedData['endorsed_by'],
            'attachment' => $validatedData['endorsement_attachment'],
        ]);

        $approvals = ReservationApprovals::create([
            'reserveeID' => $reserveeID,
            'east_status' => 'Pending', // Make sure these match the column names
            'cisso_status' => 'Pending',
            'gso_status' => 'Pending',
        ]);

       

        Mail::to($validatedData['email'])->send(new ReservationCodeMail($reserveeID));

        return response()->json(['message' => 'Reservation saved successfully', 'reservationCode' => $reserveeID]);
    }

    public function adminReservation(){ 
        if (Auth::check()) {
            $reservationDetails = DB::table('reservee')
                ->join('reservation_details', 'reservee.reservedetailsID', '=', 'reservation_details.reservedetailsID')
                ->join('selected_facilities', 'selected_facilities.reservedetailsID', '=', 'reservation_details.reservedetailsID')
                ->join('facilities', 'facilities.facilityID', '=', 'selected_facilities.facilityID')
                ->leftJoin('support_personnel', 'support_personnel.reservedetailsID', '=', 'reservation_details.reservedetailsID')
                ->leftJoin('equipment', 'equipment.reservedetailsID', '=', 'reservation_details.reservedetailsID')
                ->leftJoin('reservation_approvals', 'reservation_approvals.reserveeID', '=', 'reservee.reserveeID') // Added join
                ->select(
                    'reservee.*', 
                    'reservation_details.*', 
                    'selected_facilities.*', 
                    'facilities.*', 
                    'support_personnel.pname',
                    'support_personnel.ptotal_no',
                    'equipment.ename',
                    'equipment.etotal_no',
                    'reservation_approvals.approvalID', // Select additional fields from reservation_approvals as needed
                    'reservation_approvals.east_status', // Select additional fields from reservation_approvals as needed
                    'reservation_approvals.cisso_status',
                    'reservation_approvals.gso_status',
                    'reservation_approvals.final_status'
                )
                ->distinct('reservee.reserveeID')
                ->get();
    
            return view('dashboard.east.reservationmgmt', compact('reservationDetails'));
        }
    
        return redirect()->route('login');
    }
    
    
    
    public function destroyReservation($reservedetailsID)
    {
        $reservation = ReservationDetails::find($reservedetailsID);
        
        if (!$reservation) {
            return redirect()->route('admin-reservation')->with('error', 'Reservation not found');
        }
    
        $reservation->delete();
    
        return redirect()->route('admin-reservation')->with('success', 'Reservation deleted successfully');
    }

    public function updateReservation(Request $request, $approvalID)
        {
            $request->validate([
                'east_status' => 'required|string|max:255',
            ]);

            $eastApproval = ReservationApprovals::findOrFail($approvalID);
            
            // Update the east_status
            $eastApproval->east_status = $request->input('east_status');
            $eastApproval->save();

            return redirect()->route('admin-reservation')->with('success', 'Reservation updated successfully');
        }

}