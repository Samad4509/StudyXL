<input type="text" id="searchInput" placeholder="Search universities..." />
<div id="results"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#searchInput').on('keyup', function() {
    let query = $(this).val().trim();

    if(query === '') {
        $('#results').html('<p>Please type something to search.</p>');
        return;
    }

    $.ajax({
        url: '/api/search-universities', // আপনার API route
        method: 'GET',
        data: { search: query },
        success: function(res) {
            let html = '';

            // যদি API status ফাঁকা বা কিছু না পায়
            if(res.status === "Nothing_Found" || res.status === "Empty_Search"){
                html = `<p>No results found.</p>`;
            } else if(res.status === "Success" || res.data.length > 0){
                res.data.forEach(destination => {
                    html += `<h2>Destination: ${destination.destinations_name}</h2>`;

                    if(destination.universities && destination.universities.length > 0){
                        destination.universities.forEach(univ => {
                            html += `<h3>University: ${univ.university_name}</h3>`;
                            html += `<p>${univ.university_desc}</p>`;

                            if(univ.programs && univ.programs.length > 0){
                                html += '<ul>';
                                univ.programs.forEach(prog => {
                                    html += `<li>${prog.program_name} - ${prog.program_description}</li>`;
                                });
                                html += '</ul>';
                            }
                        });
                    } else {
                        html += `<p>No universities found under this destination.</p>`;
                    }
                });
            } else {
                html = `<p>No data found.</p>`;
            }

            $('#results').html(html);
        },
        error: function(xhr){
            console.log(xhr.responseText);
            $('#results').html('<p>Error fetching data.</p>');
        }
    });
});
</script>
