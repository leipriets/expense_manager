<div class="modal" id="modal_user" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ ucfirst($req->action) }} User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" class='form_user' id="form_user">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="user_id" id="user_id" value="{{ $req->id }}">
            <input type="hidden" name="action">

            <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>Name</label>
                            <input name="name" id="name" type="text" class="form-control" value="{{ $req->name }}" placeholder="Input Name...">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>Email Address</label>   
                            <input name="email" value="{{ $req->email }}" id="email" type="email" class="form-control" placeholder="Input Email...">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>Role</label>   
                            <select name="role" id="role" class="form-control">
                                <option value="">- select option</option>
                                @foreach ($data['roles'] as $role)
                                    <option {{ $req->role == $role->name ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                @if (Auth::user()->role == 'admin')
                    <button type="button" name="delete-user" id="delete-user" class="float-left btn btn-danger">delete</button>
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
        
        $("form[id=form_user]").on("submit", function(ev) {
            ev.preventDefault();
            addoRUpdate_User($(this), '{{ $req->action }}')
        })
    
    })


const addoRUpdate_User = (data, action) => {

    var result = {};
    $.each(data.serializeArray(), function() {
        result[this.name] = this.value;
    });

    uri = ''

    switch (action) {
        case 'add':
            uri = '/add-user'
            
            break
        case 'update':
            uri = '/update-user'
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

                if (errors.name) {
                    alert(errors.name[0]);
                    $("#name").focus();
                }else if (errors.email) {
                    alert(errors.email[0]);
                    $("#email").focus();
                }else if (erros.roles) {
                    alert(errors.roles[0]);
                    $("#role").focus();
                    
                }

            },
            500: (res) => {
                alert("Something went wrong");
                return false;
            },
        }
    })
}

$("#delete-user").on('click', (ev) => {

    if (confirm("Are you sure you want to delete?")) {
    
        Id = $("#user_id").val()

        $.ajax({
            url: `/delete-user/${Id}`,
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