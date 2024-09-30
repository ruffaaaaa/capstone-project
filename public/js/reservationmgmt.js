function openModal(reserveeID, reserveeName, person_in_charge_event, contact_details, unit_department_company, date_of_filing, endorsed_by, final_status, facilityNames, event_start_date, event_end_date,
    preparation_start_date, preparation_end_date_time, cleanup_start_date_time, cleanup_end_date_time, event_name, max_attendees, pname, ptotal_no, ename, etotal_no) {
    
    const modal = document.getElementById('viewModal');

    // Set standard fields
    document.getElementById('reserveeID').innerText = reserveeID;
    document.getElementById('reserveeName').innerText = reserveeName;
    document.getElementById('person').innerText = person_in_charge_event;
    document.getElementById('contact').innerText = contact_details;
    document.getElementById('unit').innerText = unit_department_company;
    document.getElementById('date').innerText = date_of_filing;
    document.getElementById('endorsed').innerText = endorsed_by;
    document.getElementById('status1').innerText = final_status;
    document.getElementById('name').innerText = event_name;
    document.getElementById('max').innerText = max_attendees;
    document.getElementById('facilityNames').innerText = facilityNames;

    // Format and display personnel (pname - ptotal_no)
    const pnames = pname.split(', ');
    const ptotalNos = ptotal_no.split(', ');
    let personnelOutput = pnames.map((pname, index) => `${pname.trim()} - ${ptotalNos[index].trim()}`).join(', ');
    document.getElementById('pname').innerText = personnelOutput;

    // Format and display equipment (ename - etotal_no)
    const enames = ename.split(', ');
    const etotalNos = etotal_no.split(', ');
    let equipmentOutput = enames.map((ename, index) => `${ename.trim()} - ${etotalNos[index].trim()}`).join(', ');
    document.getElementById('ename').innerText = equipmentOutput;

    const formattedStartDate = new Date(event_start_date);
    const startDateString = formattedStartDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
    const startTimeString = formattedStartDate.toLocaleTimeString('en-US');

    const formattedEndDate = new Date(event_end_date);
    const endDateString = formattedEndDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
    const endTimeString = formattedEndDate.toLocaleTimeString('en-US');

    document.getElementById('eventDate').innerText = `${startDateString} - ${endDateString}`;
    document.getElementById('eventTime').innerText = `${startTimeString} - ${endTimeString}`;

    // Preparation date formatting
    const pformattedStartDate = new Date(preparation_start_date);
    const pstartDateString = pformattedStartDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
    const pstartTimeString = pformattedStartDate.toLocaleTimeString('en-US');

    const pformattedEndDate = new Date(preparation_end_date_time);
    const pendDateString = pformattedEndDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
    const pendTimeString = pformattedEndDate.toLocaleTimeString('en-US');

    document.getElementById('preparationDate').innerText = `${pstartDateString} - ${pendDateString}`;
    document.getElementById('preparationTime').innerText = `${pstartTimeString} - ${pendTimeString}`;

    // Cleanup date formatting
    const cformattedStartDate = new Date(cleanup_start_date_time);
    const cstartDateString = cformattedStartDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
    const cstartTimeString = cformattedStartDate.toLocaleTimeString('en-US');

    const cformattedEndDate = new Date(cleanup_end_date_time);
    const cendDateString = cformattedEndDate.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
    const cendTimeString = cformattedEndDate.toLocaleTimeString('en-US');

    document.getElementById('cleanupDate').innerText = `${cstartDateString} - ${cendDateString}`;
    document.getElementById('cleanupTime').innerText = `${cstartTimeString} - ${cendTimeString}`;


    // Display modal and set close functionality
    modal.style.display = 'block';
    const closeModalButton = document.getElementById('closeButton');
    closeModalButton.addEventListener('click', function() {
        modal.style.display = 'none'; 
    });
}




function openAndPrintModal() {
    document.getElementById('viewModal').style.display = 'block';
    window.print();
    }

    document.getElementById('printButton').addEventListener('click', openAndPrintModal);

    document.getElementById('closeButton').addEventListener('click', function() {
    document.getElementById('viewModal').style.display = 'none';
    });

function openStatus(button) {
    var approvalId = button.getAttribute('data-approval-id');
    
    document.getElementById('approval_id').value = approvalId;

    document.getElementById('updateModal').classList.remove('hidden');
    }

    function closeStatus() {
        document.getElementById('updateModal').classList.add('hidden');
    }
