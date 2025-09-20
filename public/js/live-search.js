function liveSearch() {
    var searchText = document.querySelector('.top-nav-search input').value;
    $.ajax({
        url: '/search',
        method: 'GET',
        data: { query: searchText },
        success: function(response) {
            var resultList = $('#search-result-list');
            resultList.empty(); // Clear previous search results
            
            if (response.length > 0) {
               // Records found, append them to the search results list
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

            } else {
                // No records found, show a message
                resultList.append('<li class="notification-message">No records found !</li>');
            }
        }
    });
}
