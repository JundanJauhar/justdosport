document.addEventListener('DOMContentLoaded', function() {
    // Select all buttons with class btnWaktu
    const waktuButtons = document.querySelectorAll('btnWaktu');

    // Add click event listener to each button
    waktuButtons.forEach(button => {
        let btnBg = false;
        button.addEventListener('click', () => {
            if (!btnBg) {
                button.classList.add('bg-green-600');
                btnBg = true;
            } else {
                button.classList.remove('bg-green-600'); // Remove the green background class
                btnBg = false;
            }
        });
    });
});








document.addEventListener('DOMContentLoaded', (event) => {
    const input = document.getElementById('date-input');
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    input.value = formattedDate;
    const btn = document.getElementById("btn")
    btn.addEventListener(click, () => {
        btn.style.backgroundColor = 'red'
    })

    // Fetch available time slots for today
    fetchTimeSlots(formattedDate);
    
    // Add event listener to fetch available time slots when date changes
    input.addEventListener('change', function() {
        fetchTimeSlots(this.value);
    });
});

function fetchTimeSlots(date) {
    const xhr = new XMLHttpRequest();
    const urlParams = new URLSearchParams(window.location.search);
    const idPilihan = urlParams.get('idPilihan');

    xhr.open('GET', `../includes/waktuPemesanan.php?date=${date}&idPilihan=${idPilihan}`, true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('timeSlots').innerHTML = this.responseText;
        }
    };
    xhr.send();
}
