<?php

namespace App\Http\Controllers;

use App\Models\ReservationDetails;
use App\Models\SelectedFacilities;
use App\Models\Facilities;
use App\Models\Reservee;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function showReservationForm()
    {
        $facilities = Facilities::all();
        return view('make-reservation', compact('facilities'));
    }

    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'nameofevent' => 'required',
        //     'max-attendees' => 'required|numeric',
        //     'event-start-date' => 'required|date_format:Y-m-d H:i:s',
        //     'event-end-date' => 'required|date_format:Y-m-d H:i:s',
            // 'preparation_start_date' => 'required|date_format:Y-m-d H:i:s',
            // 'preparation_end_date' => 'required|date_format:Y-m-d H:i:s',
            // 'cleanup_start_date' => 'required|date_format:Y-m-d H:i:s',
            // 'cleanup_end_date' => 'required|date_format:Y-m-d H:i:s',
        //     'reserveeName' => 'required',
        //     'email' => 'required|email',
        //     'person_in_charge_event' => 'required',
        //     'contact_details' => 'required',
        //     'unit_department_company' => 'required',
        //     'date_of_filing' => 'required|date',
        //     'endorsed_by' => 'required',
        //     'endorsement_attachment' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            
        // ]);

        $validatedData = $request->validate([
            'nameofevent' => 'required',
            'max-attendees' => 'required|numeric',
            'event-start-date' => 'required|date_format:Y-m-d\TH:i',
            'event-end-date' => 'required|date_format:Y-m-d\TH:i',
            'preparation-start-date' => 'required|date_format:Y-m-d\TH:i',
            'preparation-end-date' =>'required|date_format:Y-m-d\TH:i',
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

        $equipmentData = $request->input('equipment');
        $selectedEquipment = [];

        foreach ($equipmentData as $itemName => $itemInfo) {
            if (isset($itemInfo['selected']) && $itemInfo['selected'] == 'on') {
                // Checkbox is selected, save the item and quantity
                if ($itemName == 'other') {
                    // For the "Other" option, extract name and quantity separately
                    $name = $itemInfo['name'] ?? '';
                    $quantity = isset($itemInfo['quantity']) ? intval($itemInfo['quantity']) : 0;
                    if (!empty($name) && $quantity > 0) {
                        $selectedEquipment[$name] = $quantity;
                    }
                } else {
                    // For regular items, simply store the quantity
                    $quantity = isset($itemInfo['quantity']) ? intval($itemInfo['quantity']) : 0;
                    $selectedEquipment[$itemName] = $quantity;
                }
            }
        }

        foreach ($selectedEquipment as $itemName => $quantity) {
            Equipment::create([
                'name' => $itemName,
                'total_no' => $quantity,
                // Other fields if any
            ]);
        }
    


        
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

        //handle attachments
        if (!file_exists(public_path('uploads/attachments'))) {
            mkdir(public_path('uploads/attachments'), 0755, true);
        }

        if ($request->hasFile('endorsement_attachment')) {
            $file = $request->file('endorsement_attachment');
            $filePath = $file->move(public_path('uploads/attachments'), $file->getClientOriginalName());
            $validatedData['endorsement_attachment'] = 'uploads/attachments/' . $file->getClientOriginalName();
        }
        //end

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

        // Save selected facilities
        if ($request->has('facility_checkbox')) {
            foreach ($request->input('facility_checkbox') as $facilityID => $checked) {
                SelectedFacilities::create([
                    'reservedetailsID' => $nextNumericPart,
                    'facilityID' => $facilityID,
                ]);
            }
        }

        // Create reservee
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
            'status' => 'Pending',
        ]);

        return response()->json(['message' => 'Reservation saved successfully', 'reservationCode' => $reserveeID]);
    }
}
