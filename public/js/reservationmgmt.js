function openModal(reserveeID, reserveeName, person_in_charge_event, contact_details, unit_department_company, date_of_filing, final_status, facilityNames, event_start_date, event_end_date,
    preparation_start_date, preparation_end_date_time, cleanup_start_date_time, cleanup_end_date_time, event_name, max_attendees, pname, ptotal_no, ename, etotal_no,  eastSignatureUrl, cissoSignatureUrl, gsoSignatureUrl, eastApprovalStatus, cissoApprovalStatus, gsoApprovalStatus,attachmentObjects
) {
    
    const modal = document.getElementById('viewModal');

    // Set standard fields
    document.getElementById('reserveeID').innerText = reserveeID;
    document.getElementById('reserveeName').innerText = reserveeName;
    document.getElementById('person').innerText = person_in_charge_event;
    document.getElementById('contact').innerText = contact_details;
    document.getElementById('unit').innerText = unit_department_company;
    document.getElementById('date').innerText = date_of_filing;
    document.getElementById('status1').innerText = final_status;
    document.getElementById('name').innerText = event_name;
    document.getElementById('max').innerText = max_attendees;
    document.getElementById('facilityNames').innerText = facilityNames;



    // Fetching signature file paths and approval statuses

    // Setting the source for the signature images based on approval status
    document.getElementById('eastSignatureImage').src = eastApprovalStatus === 'Approved' ? eastSignatureUrl : '';
    document.getElementById('cissoSignatureImage').src = cissoApprovalStatus === 'Approved' ? cissoSignatureUrl : '';
    document.getElementById('gsoSignatureImage').src = gsoApprovalStatus === 'Approved' ? gsoSignatureUrl : '';

    // Show or hide images based on approval status
    document.getElementById('eastSignatureImage').style.display = eastApprovalStatus === 'Approved' ? 'block' : 'none';
    document.getElementById('cissoSignatureImage').style.display = cissoApprovalStatus === 'Approved' ? 'block' : 'none';
    document.getElementById('gsoSignatureImage').style.display = gsoApprovalStatus === 'Approved' ? 'block' : 'none';


    let attachments = JSON.parse(attachmentObjects); // Parse the JSON string

    const attachmentContainer = document.getElementById('attachmentContainer');
    attachmentContainer.innerHTML = ''; // Clear previous attachments

    // To avoid duplicates, use a Set to track unique URLs
    const uniqueUrls = new Set();

    if (attachments && attachments.length > 0) {
        attachments.forEach((attachment) => {
            if (!uniqueUrls.has(attachment.url)) {
                uniqueUrls.add(attachment.url);
                
                const link = document.createElement('a');
                link.href = attachment.url;           
                link.textContent = attachment.name;     
                link.target = '_blank';                 
                link.classList.add( 'hover:underline');

                attachmentContainer.appendChild(link);   
                attachmentContainer.appendChild(document.createElement('br')); 
            }
        });
    } else {
        attachmentContainer.textContent = "No attachments available";
    }
    
    
    const pnames = pname.split(', ');
    const ptotalNos = ptotal_no.split(', ');
    let personnelOutput = pnames.map((pname, index) => `${pname.trim()} - ${ptotalNos[index].trim()}`).join(', ');
    document.getElementById('pname').innerText = personnelOutput;

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
    var reserveeID = button.getAttribute('data-reservee-id');

    document.getElementById('approval_id').value = approvalId;
    
    document.getElementById('reserveeIDDisplay').innerText = reserveeID; 

    document.getElementById('updateModal').classList.remove('hidden');
    }

function closeStatus() {
    document.getElementById('updateModal').classList.add('hidden');
}

