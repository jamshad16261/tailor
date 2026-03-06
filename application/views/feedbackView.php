<style>
#feedbackTable th, 
#feedbackTable td {
    padding: 4px 6px !important; 
    font-size: 12px !important;
}
</style>

<div class="pc-container">
<div class="pc-content">

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h4 class="mb-0">Feedback Management</h4>
            </div>
        </div>
    </div>
</div>
<!-- ================= ADD FEEDBACK ================= -->
<div class="card">
<div class="card-header">
    <h5>Add Feedback</h5>
</div>
<div class="card-body">

<form id="FeedbackForm">
<div class="row g-3">

    <div class="col-md-4">
        <label>Title</label>
        <input class="form-control form-control-sm" name="title" placeholder="Enter Title">
        <small class="text-danger error-title"></small>
    </div>

    <div class="col-md-4">
        <label>Rating (1-5)</label>
        <input type="number" min="1" max="5" class="form-control form-control-sm" name="rating" placeholder="Enter Rating">
        <small class="text-danger error-rating"></small>
    </div>

    <div class="col-md-4">
        <label>Status</label>
        <select class="form-control form-control-sm" name="status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <div class="col-md-12">
        <label>Message</label>
        <textarea class="form-control form-control-sm" name="message" placeholder="Enter Your Feedback"></textarea>
        <small class="text-danger error-message"></small>
    </div>

    <div class="col-md-2">
        <button type="submit" id="btnSave" class="btn btn-primary btn-sm w-100">
            Save Feedback
        </button>
    </div>

</div>
</form>

</div>
</div>

<!-- ================= TABLE ================= -->
<div class="card mt-3">
<div class="card-header">
    <h5>Feedback List</h5>
</div>
<div class="card-body table-responsive">

<table id="feedbackTable" class="table table-bordered table-sm">
<thead>
<tr>
    <th>#</th>
    <th>Title</th>
    <th>Message</th>
    <th>Rating</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>
<tbody id="showFeedback"></tbody>
</table>

</div>
</div>

</div>
</div>

<!-- ================= EDIT MODAL ================= -->
<div class="modal fade" id="editModal">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header bg-primary text-white">
    <h5 class="modal-title text-white">Edit Feedback</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<form id="updateFeedbackForm">
<input type="hidden" name="id" id="edit_id">

<div class="row g-3">

    <div class="col-md-4">
        <label>Title</label>
        <input class="form-control form-control-sm" name="edit_title" id="edit_title" >
        <small class="text-danger error-edit_title"></small>
    </div>

    <div class="col-md-4">
        <label>Rating</label>
        <input type="number" min="1" max="5" class="form-control form-control-sm" name="edit_rating" id="edit_rating">
        <small class="text-danger error-edit_rating"></small>
    </div>

    <div class="col-md-4">
        <label>Status</label>
        <select class="form-control form-control-sm" name="edit_status" id="edit_status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <div class="col-md-12">
        <label>Message</label>
        <textarea class="form-control form-control-sm" name="edit_message" id="edit_message"></textarea>
        <small class="text-danger error-edit_message"></small>
    </div>

</div>
</form>
</div>

<div class="modal-footer">
    <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
    <button class="btn btn-primary btn-sm" id="btnUpdate">Update</button>
</div>

</div>
</div>
</div>

<!-- ================= DELETE MODAL ================= -->
<div class="modal fade" id="deleteModal">
<div class="modal-dialog">
<div class="modal-content border-danger">
<div class="modal-header bg-danger text-white">
    <h5 class="modal-title text-white">Confirm Delete</h5>
</div>
<div class="modal-body text-center">
    Are you sure you want to delete this feedback?
</div>
<div class="modal-footer justify-content-center">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button class="btn btn-danger" id="confirmDelete">Delete</button>
</div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
getFeedback();

function getFeedback(){
    $.ajax({
        url: "<?= base_url('Feedback/getFeedback') ?>",
        method: "GET",
        dataType: "json",  // automatic parse
        success: function(data){
            let html='';
            let c=0;

            data.forEach(function(row){
                c++;
                html += `<tr>
                    <td>${c}</td>
                    <td>${row.title}</td>
                    <td>${row.message}</td>
                    <td>${row.rating}</td>
                    <td>${row.status == 1 ? 'Active' : 'Inactive'}</td>
                    <td>
                        <a href="javascript:;" class="edit text-primary me-2" data="${row.id}">Edit</a>
                        <a href="javascript:;" class="delete text-danger" data="${row.id}">Delete</a>
                    </td>
                </tr>`;
            });

            $('#showFeedback').html(html);
        },
        error: function(err){
            console.log(err); // agar kuch error aaye to console me dekho
        }
    });
}

// INSERT
$("#FeedbackForm").submit(function(e){
    e.preventDefault();

    $.post("<?= base_url('Feedback/saveFeedback') ?>",
        $(this).serialize(),
        function(res){
            res = JSON.parse(res);
            $(".text-danger").html('');

            if(res.status=="error"){
                $.each(res.errors,function(k,v){
                    $(".error-"+k).html(v);
                });
            } else {
                $("#FeedbackForm")[0].reset();
                getFeedback();
            }
        }
    );
});

// EDIT LOAD
$(document).on("click",".edit",function(){
    let id=$(this).attr("data");

    $.get("<?= base_url('Feedback/getById') ?>/"+id,function(data){
        data=JSON.parse(data);
        $("#edit_id").val(data.id);
        $("#edit_title").val(data.title);
        $("#edit_message").val(data.message);
        $("#edit_rating").val(data.rating);
        $("#edit_status").val(data.status);
        $("#editModal").modal("show");
    });
});

// UPDATE
$("#btnUpdate").click(function(){
    $.post("<?= base_url('Feedback/updateFeedback') ?>",
        $("#updateFeedbackForm").serialize(),
        function(res){
            res=JSON.parse(res);
            if(res.status){
                $("#editModal").modal("hide");
                getFeedback();
            }
        }
    );
});
// DELETE
let deleteId=null;
$(document).on("click",".delete",function(){
    deleteId=$(this).attr("data");
    $("#deleteModal").modal("show");
});

$("#confirmDelete").click(function(){
    $.post("<?= base_url('Feedback/delete_item') ?>",
        {id:deleteId},
        function(){
            $("#deleteModal").modal("hide");
            getFeedback();
        }
    );
});
</script>