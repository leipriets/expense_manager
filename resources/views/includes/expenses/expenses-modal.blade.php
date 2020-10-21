<div class="modal" id="modal_expenses" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ ucfirst($req->action) }} Expense</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" class='form_expenses' id="form_expenses">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="e_id" id="e_id" value="{{ $req->id }}">
            <input type="hidden" name="action">

            <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>Expense Category</label>
                            <select class="form-control" name="expenses_category" id="expenses_category">
                                <option value="">- select option -</option>
                                @foreach ($data['expense_categories'] as $category )
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>Amount</label>
                            <input name="amount" id="amount" type="number" class="form-control" placeholder="Input Amount...">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label>Entry Date</label>   
                            <input name="entry_date" id="entry_date" type="datetime-local" class="form-control" placeholder="">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                @if (Auth::user()->role == 'admin')
                    <button type="button" name="delete-expense" id="delete-expense" class="float-left btn btn-danger">delete</button>
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
        
        $("form[id=form_expenses]").on("submit", function(ev) {
            ev.preventDefault();
            addoRUpdate_Expense($(this), '{{ $req->action }}')
        })
    
    })


const addoRUpdate_Expense = (data, action) => {

    var result = {};
    $.each(data.serializeArray(), function() {
        result[this.name] = this.value;
    });

    uri = ''

    switch (action) {
        case 'add':
            uri = '/add_expense'
            
            break
        case 'update':
            uri = '/update_expense'
            
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

                if (errors.expenses_category) {
                    alert(errors.expenses_category[0]);
                    $("#expenses_category").focus();
                }else if (errors.amount) {
                    alert(errors.amount[0]);
                    $("#amount").focus();
                }else if (errors.entry_date) {
                    alert(errors.entry_date[0]);
                    $("#entry_date").focus();
                }

            },
            500: (res) => {
                alert("Something went wrong");
                return false;
            },
        }
    })
}


// delete expense
$("#delete-expense").on('click', (ev) => {

if (confirm("Are you sure you want to delete?")) {
   
    Id = $("#e_id").val()

    $.ajax({
        url: `/delete-expense/${Id}`,
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