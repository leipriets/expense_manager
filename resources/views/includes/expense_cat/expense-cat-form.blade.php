<div class="modal" id="modal_expense" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" class='form_expense_category'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="ec_id" id="ec_id" value="">
            <input type="hidden" name="action">
            <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-10">
                            <label for="inputEmail4">Display Name</label>
                            <input name="name" id="name" type="text" class="form-control" placeholder="Input name...">
                        </div>

                        <div class="form-group col-md-10">
                            <label for="inputEmail4">Description</label>
                            <input name="description" id="description" type="text" class="form-control" placeholder="Input description...">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                @if (Auth::user()->role == 'admin')
                  <button type="button" name="delete-expense-cat" id="delete-expense-cat" class="float-left btn btn-danger">delete</button>
                @endif

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

      </div>
    </div>
  </div>
