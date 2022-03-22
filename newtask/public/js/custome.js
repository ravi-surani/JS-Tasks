// Project Details
function updateproject() {
    $('#project_description').prop('disabled', false);
    $('#start_date').prop('disabled', false);
    $('#end_date').prop('disabled', false);
    $('#project_name').prop('disabled', false)
    $('#update_btn_div').show();
    $('#project_name_div').show();
}

function cancleupdate() {
    $('#project_description').prop('disabled', true);
    $('#start_date').prop('disabled', true);
    $('#end_date').prop('disabled', true);
    $('#project_name').prop('disabled', true)
    $('#update_btn_div').hide();
    $('#project_name_div').hide();

}


function GetProjectDetails(id) {
    $.ajax({
        url: 'api/project_details/' + id,
        type: "GET",
        success: function(response) {
            $('#edit_id').val(response[0].id);
            $('#edit_project_name').val(response[0].project_name);
            $('#edit_start_date').val(response[0].start_date);
            $('#edit_end_date').val(response[0].end_date);
            $('#updateprojectmodel').modal('show');
        }
    });
}