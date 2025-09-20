@extends('layouts.app')

@section('content')
@section('title', 'Search Lead')

<style>
    .nav.float-left.search-dropdown-box.before-input-box input#input_values {
    border-radius: 50px;
    padding: 22px;
    border: 2px solid #ccc;
    color: #000 !important;
}
.before-input-box button.btn {
    padding: 12px 20px 12px 20px;
    top: 0px !important;
    position: absolute !important;
    right: 0px !important;
    border-radius: 0px 50px 50px 0px;
    background: #085694 !important;
}
.before-input-box{
    position: relative;
}
/* .nav.float-left.search-dropdown-box.before-input-box input#input_values{
    position: absolute;
    left:0px;
    bottom:0px;
} */
div#lead-search-results {
    width: 100%;
}
</style>
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
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="nav float-left search-dropdown-box before-input-box">
                            <div class="nav-item dropdown d-none d-sm-block">
                                <div class="top-nav-search">
                                    <input class="dropdown-toggle nav-link form-control" id="input_values" data-toggle="dropdown" type="text" class="dropdown-toggle nav-link" placeholder="Search Lead Before Entry" onkeyup="leadliveSearch()">
                                    <button class="btn" type="submit" onclick="leadliveSearch()"><i class="fa fa-search"></i></button>

                                    <div class="dropdown-menu notifications" id="lead-search-results">
                                        <div class="topnav-dropdown-header">
                                            <span>Search Results</span>
                                        </div>
                                        <div class="drop-scroll">
                                            <ul class="notification-list" id="lead_search-result-list">
                                                
                                            </ul>
                                        </div>
                                        <div class="topnav-dropdown-footer">
                                            <a href="{{ route('view.lead') }}">View all Leads</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        @include('section/notification') 
    </div>
</div>
<script>
    function leadliveSearch() {
    var searchText = document.querySelector('#input_values').value;
    // alert(searchText);
    $.ajax({
        url: '/lead_search',
        method: 'GET',
        data: { query: searchText },
        success: function(response) {
            var resultList = $('#lead_search-result-list');
            var searchResults = document.getElementById("lead-search-results");
            resultList.empty(); // Clear previous search results
            
            if (response.length > 0) {
               // Records found, append them to the search results list
            //    searchResults.classList.add("show");
                response.forEach(function(record) {
                    var formattedDate = moment(record.created_at).format('DD-MM-YYYY'); // Format date in Indian format
                    var listItem = '<li class="notification-message">' +
                                        '<a href="' + 'leads/' + record.id + '">' +
                                            '<div class="media-body">' +
                                                '<h5 class="noti-details"><span class="noti-title">' + record.company_name + '</span>  <small class="badge badge-success-border">' + record.lead_status + '</small></h5>' + 
                                                '<div class="candidate-info">' +
                                                    '<span class="notification-time">Candidate: ' + record.name + ' ' + record.technology_name + '</span>' +
                                                '</div>' +
                                                '<div class="Interviewee-info">' +
                                                    '<span class="notification-time">Interviewee: ' + record.interviewer_firstname + ' ' + record.interviewer_lastname + '</span>' +
                                                '</div>' +
                                                '<div class="Interviewee-info">' +
                                                '<span class="notification-time">' + formattedDate + '</span>' + // Display formatted date
                                            '</div>' +
                                            '</div>' +
                                        '</a>' +
                                    '</li>';
                    resultList.append(listItem);
                });

            }  else {
                // searchResults.classList.add("show");
                resultList.empty(); // Clear previous search results
                var addButton = $('<a>', {
                    href: "{{ route('add.lead') }}",
                    text: "+ Add Lead"
                });
                resultList.append('<li class="notification-message">No records found.</li>');
                resultList.append(addButton);
            }
        }
    });
}
</script>
@endsection
