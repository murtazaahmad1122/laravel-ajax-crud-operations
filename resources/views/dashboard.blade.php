<x-app-layout>
 <div class="container mt-5 pt-5">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<!-- <h2>Manage <b>Employees</b></h2> -->
					</div>
					<div class="col-sm-6">
						<a  data-bs-toggle="modal" data-bs-target="#addEmployeeModal" class="btn btn-success" ><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
						<!-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						 -->
					</div>
                </div>
            </div>
           
			<table id="example" class="display table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>email</th>
                <th>address</th>
                <th>phone</th>
				<th colspane="2">Action</th>

            </tr>
        </thead>
        <tbody>
          
          
        </tbody>
        <!-- <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr> -->
        </tfoot>
    </table>

			
        </div>
    </div>
	<!-- Edit Modal HTML -->
	<div id="addEmployeeModal"  class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<form id="addEmployeeForm">
    @csrf
    <div class="modal-header">						
        <h4 class="modal-title">Add Employee</h4>
        <button type="button" class="close"  data-bs-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">					
        <div class="form-group">
            <label for="name">Name</label>
            <x-input-error for="name" />
            <x-input type="text" name="name" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <x-input-error for="email" />
            <x-input type="email" name="email" class="form-control" required />
        </div>
		<div class="form-group">
            <label for="address">Address</label>
            <x-input-error for="address" />
            <x-textarea-input name="address" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <x-input-error for="phone" />
            <x-input type="text" name="phone" class="form-control" required />
        </div>					
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default"  data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success">Add</button>
    </div>
</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editEmployeeForm">
                @csrf
				<input type="hidden" id="edit_employee_id" name="edit_employee_id" value="">
                <div class="modal-header">						
                    <h4 class="modal-title">Edit Employee</h4>
                    <button type="button" class="close"  data-bs-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                    <div class="form-group">
                        <label>Name</label>
                        <x-input-error for="edit_name" />
                        <x-input type="text" name="edit_name" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <x-input-error for="edit_email" />
                        <x-input type="email" name="edit_email" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <x-input-error for="edit_address" />
                        <x-textarea-input name="edit_address" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <x-input-error for="edit_phone" />
                        <x-input type="text" name="edit_phone" class="form-control" required />
                    </div>					
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Delete Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js
"></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css
" rel="stylesheet">
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>i
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>i
<script src="{{asset('js/main.js')}}"></script>
<script >




function updateEmployeeRecords() {
    // Fetch updated employee data
    $.ajax({
        type: 'GET',
        url: '{{ route("employees.index") }}', // URL to fetch employee records
        success: function(response) {
            // Clear existing table data
            dataTable.clear();
            
            // Add updated employee data to the DataTable
            dataTable.rows.add(response.data).draw();
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error fetching employee records:', error);
        }
    });
	
}

// Initialize DataTable
var dataTable = new DataTable('#example', {
    ajax: {
        url: '{{ route("employees.index") }}', // URL to fetch employee records
        type: 'GET', // HTTP method
        dataSrc: 'data' // Key containing data array in JSON response
    },
    columns: [
        { data: 'name' },
        { data: 'email' },
        { data: 'address' },
        { data: 'phone' },
        {
            // Action column with edit and delete icons
            data: null,
			render: function(data, type, row) {
                return '<i class="fa fa-edit edit" data-id="' + row.id + '" style="cursor:pointer;"></i>' +
                       '<i class="fa fa-trash delete" data-id="' + row.id + '" style="cursor:pointer;margin-left:5px;"></i>';
            }
        }
    ],
	lengthChange: false
});

// Event listener for addEmployeeForm submission
$('#addEmployeeForm').on('submit', function(e) {
        e.preventDefault();
        
        // Serialize form data
        var formData = $(this).serialize();
        
        // Display console message for form data sending
       // console.log('Form data sending:', formData);
        
        // Get CSRF token
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        // AJAX request
        $.ajax({
            type: 'POST',
            url: '{{ url('/employees') }}', // Use url() helper to generate full URL
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(data) {
                // Handle success response
				$('#addEmployeeForm')[0].reset();
				document.getElementById('addEmployeeModal').style.display = 'none';

// Remove the modal backdrop
document.querySelector('.modal-backdrop').remove();
	updateEmployeeRecords();
                console.log('Success:', data);
                // Display success message with SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Employee added successfully!'
                });
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error('Error:', error);
                // Display error message with SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again.'
                });
            }
        });
    });

// Event listener for edit and delete buttons
$(document).on('click', '.edit', function() {
    var employeeId = $(this).data('id');
    
    // AJAX request to fetch employee data
    $.get('{{ url('/employees') }}/' + employeeId)
        .done(function(data) {
			$('#edit_employee_id').val(data.id);
            // Fill form fields with employee data
            $('#editEmployeeForm input[name="edit_name"]').val(data.name);
            $('#editEmployeeForm input[name="edit_email"]').val(data.email);
            $('#editEmployeeForm textarea[name="edit_address"]').val(data.address);
            $('#editEmployeeForm input[name="edit_phone"]').val(data.phone);
            
            // Show edit modal
            $('#editEmployeeModal').modal('show');
        })
        .fail(function(xhr, status, error) {
            // Handle error
            console.error('Error:', error);
            // Display error message with SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to fetch employee data! Please try again.'
            });
        });
});

$('#editEmployeeForm').on('submit', function(e) {
    e.preventDefault();
    
    var formData = $(this).serialize();
    var employeeId = $('#edit_employee_id').val(); // Ensure we have the employee ID
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    
   // console.log('Form data:', formData); // Log the form data
   // console.log('Employee ID:', employeeId); // Log the employee ID
    
    $.ajax({
        type: 'PUT',
        url: '{{ url('/employees') }}/' + employeeId,
        data: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(data) {
            // Clear form inputs
            $('#editEmployeeForm')[0].reset();
            // Hide edit modal
            $('#editEmployeeModal').modal('hide');
            // Remove the modal backdrop
            $('.modal-backdrop').remove();
            // Update employee records in DataTable
            updateEmployeeRecords();
            // Display success message with SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Employee updated successfully!'
            });
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error:', error);
            // Display error message with SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Failed to update employee! Please try again.'
            });
        }
    });
});





$('#example').on('click', '.delete', function(e) {
	e.preventDefault();
    var employeeId = $(this).data('id');
    $('#deleteEmployeeModal').modal('show');
    
    // Add logic to handle delete action
    $('#deleteEmployeeModal').find('.btn-danger').on('click', function(e) {
		e.preventDefault();
        // AJAX request to delete employee record
        $.ajax({
            type: 'DELETE',
            url: '{{ url('/employees') }}/' + employeeId,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                // Hide delete modal
                $('#deleteEmployeeModal').modal('hide');
                // Update employee records in DataTable
                updateEmployeeRecords();
                // Display success message with SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Employee deleted successfully!'
                });
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Error:', error);
                // Display error message with SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to delete employee! Please try again.'
                });
            }
        });
    });
});


$(document).ready(function() {
    //console.log("test");
});
</script>
</x-app-layout>
