document.addEventListener('DOMContentLoaded', function () {
    const dateDisplay = document.getElementById('current-date');
    const today = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = today.toLocaleDateString('en-US', options);
    dateDisplay.textContent = `As of ${formattedDate}`;
});