<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal{{ $course->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $course->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $course->id }}">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteCourseForm{{ $course->id }}').submit()">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to prevent form submission when cancel button is clicked -->
<script>
    // Prevent form submission when cancel button is clicked
    document.getElementById('cancelDelete{{ $course->id }}').addEventListener('click', function(event) {
        event.preventDefault();
        $('#deleteConfirmationModal{{ $course->id }}').modal('hide');
    });
</script>
