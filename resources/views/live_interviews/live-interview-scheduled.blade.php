<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Interviews</title>
    <link rel="stylesheet" href="{{ asset('css/live-interview-scheduled.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
    <!-- <marquee style="font-size: 20px; font-weight: bold; color: red; white-space: nowrap;" behavior="scroll" direction="left">
        ⚠️ Website is under maintenance. You may experience issues. ⚠️
    </marquee> -->
    <div class="container">
        <div class="datetime-div" id="datetime">
            <div class="timezone" id="timezone1">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Flag_of_the_United_States.svg" alt="US Flag">
                <span class="timezone-time"></span>
            </div>
            <div class="timezone" id="timezone2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Flag_of_India.svg" alt="India Flag">
                <span class="timezone-time"></span>
            </div>
        </div>
        
        <div id="fixed-header-container" class="fixed-header-container technology-section">
            <table>
                <thead>
                    <tr>
                        <th class="profile"><i class="fa-solid fa-user"></i> Profile</th>
                        <th class="company-name"><i class="fa-solid fa-building"></i> Company Name</th>
                        <th class="time-ist"><i class="fa-solid fa-clock"></i> Time Zone (IST)</th>
                        <th class="time-cst"><i class="fa-solid fa-clock"></i> Time Zone(CST)</th>
                        <th class="time-est"><i class="fa-solid fa-clock"></i> Time Zone (EST)</th>
                        <th class="scheduled-by"><i class="fa-solid fa-user-check"></i> Scheduled By</th>
                        <th class="cutdown-by"><i class="fa-solid fa-hourglass-half"></i> Countdown (IST)</th>
                        <th class="lead-comment"><i class="fa-solid fa-comment"></i> Lead Comment</th>
                    </tr>
                </thead>
            </table>
        </div>
        
        <div class="row">
            @foreach ($groupedLeads as $technologyName => $leads)
                <div class="col-6 technology-section">
                    <div class="technology-header">{{ $technologyName }}</div>
                    <table class="data-table">
                        <tbody class="table-body">
                            @foreach ($leads as $lead)
                                <tr id="row-{{$lead->id}}" class="lead-row">
                                    <td class="profile-name-table">
                                        <p><i class="fa-solid fa-user"> </i> {{ $lead->interviewerLead->firstname ?? 'N/A' }} ({{ strtok($lead->vendor->name ?? 'N/A', ' ') }})</p>
                                    </td>
                                    <td class="company-name-table">
                                        <p>{{ $lead->company->company_name }}</p>
                                    </td>
                                    <td class="time-ist-table">
                                        <?php
                                       
                                            if (!empty(trim($lead->interview_date)) && !empty(trim($lead->interview_time))) {
                                                $dateTimeString = \Carbon\Carbon::parse($lead->interview_date)->format('d-m-Y') . ' ' . $lead->interview_time;
                                                $istTime = \Carbon\Carbon::createFromFormat('d-m-Y h:i A', $dateTimeString, 'Asia/Kolkata');
                                                echo $istTime->format('d M y h:i A');
                                            }
                                        ?>
                                    </td>
                                    <td class="time-est-table">
                                        <?php
                                            $cstDateTime = $istTime->setTimezone('America/Chicago')->format('d M y h:i A');
                                            echo $cstDateTime;
                                        ?>
                                    </td>
                                    <td class="time-cst-table">
                                        <?php
                                            $estDateTime = $istTime->setTimezone('America/New_York')->format('d M y h:i A');
                                            echo $estDateTime;
                                        ?>
                                    </td>
                                    <td style="text-overflow: ellipsis; " class="scheduled-by-table">
                                         <i class="fa-solid fa-user-check"></i>
                                        {{ $lead->createdUserLead->firstname ?? 'N/A' }}
                                    </td>

                                    <td class="interview-time"
                                        data-interview-date="{{ \Carbon\Carbon::parse($lead->interview_date)->format('d-m-Y') }}"
                                        data-interview-time="{{ $lead->interview_time }}"
                                        data-interview-date-est="<?=$estDateTime?>"
                                        data-interview-date-cst="<?=$cstDateTime?>">
                                        <span class="countdown">Loading...</span>
                                    </td>
                                    <td class="lead-comment-table">
                                        <div title="{{ $lead->lead_comment }}">
                                            <p class="lead_comment">
                                                {{ implode(' ', array_slice(explode(' ', $lead->lead_comment), 0, 4)) }}...
                                                <a href="#" class="anc" onclick="openModal('customModal{{ $lead->id }}')">View More</a>
                                            </p>
                                        </div>
                                        <div id="customModal{{ $lead->id }}" class="custom-modal">
                                            <div class="custom-modal-content">
                                                <span class="custom-modal-close" onclick="closeModal('customModal{{ $lead->id }}')">&times;</span>
                                                <h5>All Comments</h5>
                                                <div>
                                                    @foreach ($lead->leadHistories->sortByDesc('created_at') as $history)
                                                        <p><strong>{{ $history->leadCreate_user_name }} ({{ $history->created_at->diffForHumans() }}):</strong></p>
                                                        <p>{{ $history->comment }}</p>
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
    <script>
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

        // Countdown script
        const timeZoneSys = Intl.DateTimeFormat().resolvedOptions().timeZone;

        document.addEventListener('DOMContentLoaded', () => {
            const updateCountdown = () => {
                const interviewTimes = document.querySelectorAll('.interview-time');

                interviewTimes.forEach((element) => {
                    const interviewDate = element.getAttribute('data-interview-date');
                    const interviewTime = element.getAttribute('data-interview-time');

                    const start24HourTime = convertTo24HourFormat(interviewTime);
                    const fullInterviewDateTime = combineDateTime(interviewDate, start24HourTime);
                    const fullInterviewDateTimeEST = element.getAttribute('data-interview-date-est');
                    const fullInterviewDateTimeCST = element.getAttribute('data-interview-date-cst');

                    let interviewDateTime;
                    if (timeZoneSys === "America/Chicago") {
                        interviewDateTime = new Date(fullInterviewDateTimeCST);
                    } else if (timeZoneSys === "America/New_York") {
                        interviewDateTime = new Date(fullInterviewDateTimeEST);
                    } else {
                        interviewDateTime = new Date(fullInterviewDateTime);
                    }

                    const now = new Date();
                    const countdownElement = element.querySelector('.countdown');
                    const timeDifference = interviewDateTime - now;

                    if (timeDifference <= 0) {
                        countdownElement.textContent = "Time is over";
                        countdownElement.classList.remove('highlight');
                        countdownElement.style.color = '';

                        // Remove the entire row if the time is over
                        // const row = element.closest('tr');
                        // if (row) {
                        //     row.remove();
                        // }
                        const row = element.closest('tr');
                        if (row) {
                            row.style.textDecoration = 'line-through'; // Apply cross-out effect
                            row.style.color = 'gray'; // Optional: Change color for better visibility
                        }

                        return;
                    }

                    const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeDifference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

                    let countdownText = '';
                    if (days > 1) {
                        countdownText = `${days} days remaining`;
                    } else if (days === 1) {
                        countdownText = `1 day remaining`;
                    } else {
                        countdownText = `${hours}h ${minutes}m ${seconds}s`;
                    }

                    countdownElement.textContent = countdownText;

                    // Highlight if less than 1 hour
                    if (timeDifference <= 14400000) {
                        countdownElement.classList.add('highlight');
                        countdownElement.style.color = 'red'; // Change text color to red
                    } else {
                        countdownElement.classList.remove('highlight');
                        countdownElement.style.color = ''; // Reset color
                    }
                });
            };

            const convertTo24HourFormat = (time) => {
                const timeRegex = /^(\d{1,2}):(\d{2})\s?(AM|PM)$/i; // Matches 02:30 PM or 2:30 PM
                const match = time.match(timeRegex);

                if (!match) {
                    console.error(`Invalid time format: ${time}`);
                    return '00:00'; // Fallback to prevent crashes
                }

                let [_, hour, minute, period] = match;
                hour = parseInt(hour, 10);

                if (period.toUpperCase() === 'PM' && hour !== 12) {
                    hour += 12;
                } else if (period.toUpperCase() === 'AM' && hour === 12) {
                    hour = 0;
                }

                return `${hour.toString().padStart(2, '0')}:${minute}`;
            };

            const combineDateTime = (date, time) => {
                const [day, month, year] = date.split('-');
                return `${year}-${month}-${day}T${time}:00`;
            };

            setInterval(updateCountdown, 1000);
            updateCountdown();
        });

        // Scroll to section script
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

        // Sync column widths script
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

        // Modal open and close functions
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

        // Highlight rows that are marked as 'highlight'
        document.querySelectorAll('td span.highlight').forEach(span => {
            const tr = span.closest('tr');
            if (tr) {
                tr.classList.add('highlight');
            }
        });

        // Auto reload the page every 5 minutes (300000 ms)
        setTimeout(() => {
            location.reload();
        }, 300000);

        // Hide sections with no data
        document.addEventListener('DOMContentLoaded', function () {
            const technologySections = document.querySelectorAll('.technology-section');
            technologySections.forEach(section => {
                const tableBody = section.querySelector('.table-body');
                if (tableBody && tableBody.children.length === 0) {
                    section.style.display = 'none';
                }
            });
        });

    </script>
</body>
</html>