@extends('layouts.app')

@section('content')
@section('title', 'Search Lead')

<!-- css file path /public/css/lead_search_beforEntery.css -->

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Search Lead</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Lead</a></li>
                        <li class="breadcrumb-item"><span>Search</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="page-title">
                                        Search Lead Before Entry
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                <div class="nav float-left search-dropdown-box before-input-box">
                    <div class="nav-item dropdown d-none d-sm-block">
                        <div class="top-nav-search">
                            <input class="dropdown-toggle nav-link form-control" id="input_values" data-toggle="dropdown" type="text" placeholder="Search Lead Before Entry" onkeyup="leadliveSearch()">
                            <button class="btn" type="submit" onclick="leadliveSearch()"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row before-input-box">
            <div class="col-md-6">
                <div class="dropdown-menu notifications" id="lead-search-results">
                    <div class="topnav-dropdown-header-lead">
                        <span>Search Results</span>
                    </div>
                    <div class="drop-scroll">
                        <ul class="notification-list" id="lead_search-result-list"></ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="{{ route('view.lead') }}" target="_blank">View all Leads</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dropdown-menu notifications" id="lead-search-results2">
                    <div class="topnav-dropdown-header-lead">
                        <span>Search Results from Old Database</span>
                    </div>
                    <div class="drop-scroll">
                        <ul class="notification-list" id="lead_search-result-list-old-data"></ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="{{ route('alloldrecord') }}" target="_blank">View all Old Data</a>
                    </div>
                </div>
            </div>
            <!-- <div id="loader-search" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div> -->

        </div>

        @include('section/notification') 
    </div>
</div>

<script>
function leadliveSearch() {
     // Show loader
    //  $('#loader-search').show();
    var searchText = document.querySelector('#input_values').value;
    $.ajax({
        url: '/lead_search',
        method: 'GET',
        data: { query: searchText },
        success: function(response) {
               // Hide loader
            //    $('#loader-search').hide();
            var resultList = $('#lead_search-result-list');
            var resultListolddata = $('#lead_search-result-list-old-data');
            resultList.empty(); // Clear previous search results
            resultListolddata.empty(); // Clear previous search results
            
            if (response.current.length > 0) {
                response.current.forEach(function(record) {
                    var formattedDate = moment(record.lead_created_at).format('DD-MM-YYYY');
                    var postCallNotes = breakTextIntoLines(record.post_call_notes, 10);
                    var listItem = 
                            '<li class="notification-message" style="padding: 10px; border-bottom: 1px solid #eaeaea; display: flex; align-items: flex-start; transition: background 0.3s;">' +
                                '<a href="leads/' + record.id + '" target="_blank" style="text-decoration: none; color: inherit; width: 100%;">' +
                                    '<div class="media-body" style="margin-left: 10px;">' +
                                        '<h5 class="noti-details" style="margin: 0; font-size: 16px; color: #333;">' +
                                            '<span class="noti-title">' + record.company_name + '</span>' +
                                            ' <small class="badge badge-success-border" style="background-color: #28a745; color: white; padding: 2px 4px; border-radius: 3px;">' + record.lead_status + '</small>' +
                                        '</h5>' +
                                        '<div class="candidate-info" style="margin-top: 5px; font-size: 14px;">' +
                                            'Candidate: <span class="notification-time" style="font-weight: bold; color: black;">' + record.name + ' ' + record.technology_name + '</span>' +
                                        '</div>' +
                                        '<div class="Interviewee-info" style="margin-top: 5px; font-size: 14px;">' +
                                            'Interviewee: <span class="notification-time" style="font-weight: bold; color: black;">' + record.interviewer_firstname + ' ' + record.interviewer_lastname + '</span>' +
                                        '</div>' +
                                        '<div class="Interviewee-info" style="margin-top: 5px; font-size: 14px;">' +
                                            '<span class="notification-time" style="color: #777;">' + formattedDate + '</span>' +
                                        '</div>' +
                                        '<div class="post-call-notes" style="margin-top: 5px;">' +
                                            '<small class="badge badge-success-border" style="background-color: #28a745; color: white; padding: 2px 4px; border-radius: 3px;">' + postCallNotes + '</small>' +
                                        '</div>' +
                                    '</div>' +
                                '</a>' +
                            '</li>';
                    resultList.append(listItem);
                });
            } else {
                var addButton = $('<a>', {
    href: "{{ route('add.lead') }}",
    class: "btn btn-primary btn-rounded",
    text: "+ Add Lead",
    style: "transition: background-color 0.3s, color 0.3s;", // Adding transition for smooth hover effect
    on: {
        mouseenter: function() {
            $(this).css({
                "background-color": "#007bff", // Blue color on hover
                "color": "white" // White text color on hover
            });
        },
        mouseleave: function() {
            $(this).css({
                "background-color": "", // Reset to default background color on mouse leave
                "color": "" // Reset to default text color on mouse leave
            });
        }
    }
});

resultList.append('<li class="notification-message" style="font-size: 14px; text-align: center;">No records found!</li>');
resultList.append($('<li>').addClass("notification-message").append(addButton));

            }

            if (response.old.length > 0) {
                response.old.forEach(function(record) {
                    var formattedDate = moment(record.created_at).format('DD-MM-YYYY');
                    var postCallNotes = breakTextIntoLines(record.post_call_notes, 10);
                    var listItem = 
                                    '<li class="notification-message" style="padding: 10px; border-bottom: 1px solid #eaeaea; display: flex; align-items: flex-start; transition: background 0.3s;">' +
                                        '<a href="oldLead/' + record.id + '" target="_blank" style="text-decoration: none; color: inherit; width: 100%;">' +
                                            '<div class="media-body" style="margin-left: 10px;">' +
                                                '<h5 class="noti-details" style="margin: 0; font-size: 16px;">' +
                                                    '<span class="noti-title">' + record.client_name + '</span>' +
                                                    ' <small class="badge badge-success-border">' + postCallNotes + '</small>' +
                                                '</h5>' +
                                                '<div class="candidate-info" style="margin-top: 5px; font-size: 14px;">' +
                                                    'Candidate: <span class="notification-time" style="font-weight: bold; color: black;">' + record.candidate_name + ' ' + record.technology + '</span>' +
                                                '</div>' +
                                                '<div class="Interviewee-info" style="margin-top: 5px; font-size: 14px;">' +
                                                    'Interviewee: <span class="notification-time" style="font-weight: bold; color: black;">' + record.interview_taken_by + '</span>' +
                                                '</div>' +
                                                '<div class="Interviewee-info" style="margin-top: 5px; font-size: 14px;">' +
                                                    'Technology: <strong class="notification-time" style="font-weight: bold; color: black;">' + record.technology + '</strong>' +
                                                '</div>' +
                                                '<div class="Interviewee-info" style="margin-top: 5px; font-size: 14px;">' +
                                                    '<span class="notification-time">' + formattedDate + '</span>' +
                                                '</div>' +
                                            '</div>' +
                                        '</a>' +
                                    '</li>';


                    resultListolddata.append(listItem);
                });
            } else {
                resultListolddata.append('<li class="notification-message" style="font-size: 14px; text-align: center;">No records found!</li>');

            }
        }
    });
}

function breakTextIntoLines(text, wordsPerLine) {
    if (!text) return '';
    const words = text.split(' ');
    const lines = [];
    for (let i = 0; i < words.length; i += wordsPerLine) {
        lines.push(words.slice(i, i + wordsPerLine).join(' '));
    }
    return lines.join('<br>');
}



    document.addEventListener('DOMContentLoaded', function() {
        const inputField = document.getElementById('input_values');
        const searchResults1 = document.getElementById('lead-search-results');
        const searchResults2 = document.getElementById('lead-search-results2');

        inputField.addEventListener('focus', function() {
            searchResults1.classList.add('show');
            searchResults2.classList.add('show');
        });

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.top-nav-search')) {
                searchResults1.classList.remove('show');
                searchResults2.classList.remove('show');
            }
        });

        searchResults1.addEventListener('click', function(event) {
            event.stopPropagation();
        });

        searchResults2.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
</script>
@endsection
