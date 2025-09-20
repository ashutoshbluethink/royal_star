// Update date and time for all time zones
const updateTimezones = () => {
    const timezones = [
        { id: 'timezone1', timeZone: 'America/New_York' },  // US time zone
        { id: 'timezone2', timeZone: 'Asia/Kolkata' }      // India time zone
    ];

    timezones.forEach(({ id, timeZone }) => {
        const date = new Date();
        const options = {
            timeZone: timeZone,
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric',
            hour12: true
        };
        const formattedDate = new Intl.DateTimeFormat('en-US', options).format(date);
        document.getElementById(id).querySelector('.timezone-time').textContent = formattedDate;
    });
};

setInterval(updateTimezones, 1000); // Update every second
updateTimezones(); // Initial call

// <!-- Full screen Java script -->

const fullscreenBtn = document.getElementById('fullscreen-btn');
const container = document.querySelector('.container');

fullscreenBtn.addEventListener('click', () => {
    if (!document.fullscreenElement) {
        container.requestFullscreen()
            .then(() => {
                container.classList.add('fullscreen');
                fullscreenBtn.style.display = 'none'; // Hide button in full screen
            })
            .catch(err => {
                console.error(`Error attempting to enable full-screen mode: ${err.message}`);
            });
    }
});

document.addEventListener('fullscreenchange', () => {
    if (!document.fullscreenElement) {
        container.classList.remove('fullscreen');
        fullscreenBtn.style.display = 'block'; // Show button again when exiting full screen
    }
});

// // <!-- count dowon script -->

// const timeZoneSys = Intl.DateTimeFormat().resolvedOptions().timeZone;
// //const removedRows = JSON.parse(localStorage.getItem('removedRows') || '[]');

// document.addEventListener('DOMContentLoaded', () => {
//     const updateCountdown = () => {
//         const interviewTimes = document.querySelectorAll('.interview-time');

//         interviewTimes.forEach((element) => {
//             const interviewDate = element.getAttribute('data-interview-date');
//             const interviewTime = element.getAttribute('data-interview-time');

//             const start24HourTime = convertTo24HourFormat(interviewTime);
//             const fullInterviewDateTime = combineDateTime(interviewDate, start24HourTime);
//             const fullInterviewDateTimeEST = element.getAttribute('data-interview-date-est');
//             const fullInterviewDateTimeCST = element.getAttribute('data-interview-date-cst');

//             let interviewDateTime;
//             if (timeZoneSys === "America/Chicago") {
//                 interviewDateTime = new Date(fullInterviewDateTimeCST);
//             } else if (timeZoneSys === "America/New_York") {
//                 interviewDateTime = new Date(fullInterviewDateTimeEST);
//             } else {
//                 interviewDateTime = new Date(fullInterviewDateTime);
//             }

//             const now = new Date();
//             const countdownElement = element.querySelector('.countdown');
//             const timeDifference = interviewDateTime - now;
//             if (timeDifference <= 0) {
//                 countdownElement.textContent = "Time is over";
//                 countdownElement.classList.remove('highlight');
//                // countdownElement.classList.remove('time-over');
//                 countdownElement.style.color = '';

//                 // const rowToUpdate = element.closest('tr');
//                 // if (rowToUpdate) {
//                 //     rowToUpdate.classList.add('time-over'); 

//                 //     setTimeout(() => {
//                 //         const rowId = rowToUpdate.id;
//                 //         if (!removedRows.includes(rowId)) {
//                 //             removedRows.push(rowId);
//                 //             localStorage.setItem('removedRows', JSON.stringify(removedRows));
//                 //         }
//                 //         rowToUpdate.style.display = 'none'; 
//                 //     }, 60000); 
//                 // }
//                 return;
//             }

//             const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
//             const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//             const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
//             const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

//             let countdownText = '';
//             if (days > 1) {
//                 countdownText = `${days} days remaining`;
//             } else if (days === 1) {
//                 countdownText = `1 day remaining`;
//             } else {
//                 countdownText = `${hours}h ${minutes}m ${seconds}s`;
//             }

//             countdownElement.textContent = countdownText;

//             // Highlight if less than 1 hour
//             if (timeDifference <= 14400000) {
//                 countdownElement.classList.add('highlight');
//                 countdownElement.style.color = 'red'; // Change text color to red
//             } else {
//                 countdownElement.classList.remove('highlight');
//                 countdownElement.style.color = ''; // Reset color
//             }
//         });
//     };

//     const convertTo24HourFormat = (time) => {
//         const timeRegex = /^(\d{1,2}):(\d{2})\s?(AM|PM)$/i; // Matches 02:30 PM or 2:30 PM
//         const match = time.match(timeRegex);

//         if (!match) {
//             console.error(`Invalid time format: ${time}`);
//             return '00:00'; // Fallback to prevent crashes
//         }

//         let [_, hour, minute, period] = match;
//         hour = parseInt(hour, 10);

//         if (period.toUpperCase() === 'PM' && hour !== 12) {
//             hour += 12;
//         } else if (period.toUpperCase() === 'AM' && hour === 12) {
//             hour = 0;
//         }

//         return `${hour.toString().padStart(2, '0')}:${minute}`;
//     };

//     const combineDateTime = (date, time) => {
//         const [day, month, year] = date.split('-');
//         return `${year}-${month}-${day}T${time}:00`;
//     };

//     // Remove rows already marked as removed
//     // removedRows.forEach((rowId) => {
//     //     const row = document.getElementById(rowId);
//     //     if (row) {
//     //         row.remove();
//     //     }
//     // });
//     // removedRows.forEach(rowId => {
//     //     const row = document.getElementById(rowId);
//     //     if (row && row.querySelector("td span.time-over")) {
//     //         row.style.display = "none";
//     //     }
//     // });

//     setInterval(updateCountdown, 1000);
//     updateCountdown();
// });

document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('.technology-section');
    console.log('Found sections:', sections);

    if (sections.length === 0) {
        console.error('No .technology-section elements found.');
        return;
    }

    let currentIndex = 0;
    const scrollToSection = () => {
        console.log(`Scrolling to section index: ${currentIndex}`);

        const section = sections[currentIndex];

        if (section) {
            section.classList.add(`section-${currentIndex + 1}`);

            section.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        } else {
            console.error(`Section at index ${currentIndex} is undefined.`);
        }
        currentIndex = (currentIndex + 1) % sections.length;
    };
    scrollToSection();
    setInterval(scrollToSection, 10000);
});


document.addEventListener('DOMContentLoaded', () => {
    const fixedHeader = document.querySelector('.fixed-header-container table');
    const dataTables = document.querySelectorAll('.data-table');

    function syncColumnWidths() {
        const firstTable = dataTables[0];
        if (!firstTable) return;

        const fixedHeaderCols = fixedHeader.querySelectorAll('th');
        const firstTableCols = firstTable.querySelectorAll('th, td');

        fixedHeaderCols.forEach((th, index) => {
            const width = firstTableCols[index].getBoundingClientRect().width;
            th.style.width = `${width}px`;
        });
    }
    window.addEventListener('resize', syncColumnWidths);
    syncColumnWidths();
});
function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function (event) {
    document.querySelectorAll('.custom-modal').forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
}

document.querySelectorAll('td span.highlight').forEach(span => {
    const tr = span.closest('tr');
    if (tr) {
        tr.classList.add('highlight');
    }
});
setTimeout(() => {
    location.reload();
}, 300000);



//#===========JS to Hide the Section with no Data=======
document.addEventListener('DOMContentLoaded', function () {
    const technologySections = document.querySelectorAll('.technology-section');
    technologySections.forEach(section => {
        const tableBody = section.querySelector('.table-body');
        if (tableBody && tableBody.children.length === 0) {
            section.style.display = 'none';
        }
    });
});
