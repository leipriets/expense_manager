<div class="modal" id="modal_role" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ ucfirst($req->action) }} Role</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" class='form_role' id="form_role">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="r_id" id="r_id" value="{{ $req->id }}">
            <input type="hidden" name="action">

            <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>Display Name</label>
                        <input name="display_name" id="display_name" type="text" class="form-control" value="{{ $req->name }}" placeholder="Input Name...">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>Description</label>   
                            <input name="description" value="{{ $req->desc }}" id="description" type="text" class="form-control" placeholder="Input Description...">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                @if (Auth::user()->role == 'admin')
                    <button type="button" name="delete-role" id="delete-role" class="float-left btn btn-danger">delete</button>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                 <button type="submit" name="submit_form_expense" id="submit_form_expense" class="btn btn-primary">Save</button>
            </div>
        </form>

      </div>
    </div>
  </div>


<script type="text/javascript">
$( function() {
    $(document).ready(function() {
        
        $("form[id=form_role]").on("submit", function(ev) {
            ev.preventDefault();
            addoRUpdate_Role($(this), '{{ $req->action }}')
        })
    
    })


const addoRUpdate_Role = (data, action) => {

    var result = {};
    $.each(data.serializeArray(), function() {
        result[this.name] = this.value;
    });

    uri = ''

    switch (action) {
        case 'add':
            uri = '/add-role'
            
            break
        case 'update':
            uri = '/update-role'
            break
    }

    $.ajax({
        url: uri,
        type: 'post',
        data: result,
        headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
        },
        statusCode: {
            200: (res) => {
                console.log(res);
                alert(res.message);
                location.reload()
            },
            422: (res) => {

                var errors = res.responseJSON.errors;

                if (errors.display_name) {
                    alert(errors.display_name[0]);
                    $("#display_name").focus();
                }else if (errors.description) {
                    alert(errors.description[0]);
                    $("#amount").focus();
                }

            },
            500: (res) => {
                alert("Something went wrong");
                return false;
            },

        }
    })
} 
// end of function addoRUpdate_Role

// delete role
$("#delete-role").on('click', (ev) => {

    if (confirm("Are you sure you want to delete?")) {
       
        Id = $("#r_id").val()

        $.ajax({
            url: `/delete-role/${Id}`,
            type: 'post',
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            success: (res) => {
                alert(res.msg)
                location.reload()
            }

        })

    } else {

    }

})

    
})


</script>