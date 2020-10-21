<script type="text/javascript">
$(document).ready( (ev) => {

    $("#modal_add_expense").on('click', (e) => {

        getFormExpenseModal('add')
    })

    $(document).on('click', 'button[name=modal_edit_expense]', function(ev){
        id = $(this).data('id')
        getFormExpenseModal('update',id)

    })

})


const getFormExpenseModal = (action, id) =>{

    $.ajax({
        url: '/expense-form',
        type: 'get',
        data: {
            action: action,
            id : id
        },
        statusCode: {
            200: (res) => {

                if (action == 'update') {
                    formData = {}

                    $.get(`/edit-expense/${id}`,function(res){
                        console.log(res)
                        
                        $("#expenses_category").val(res.category)
                        $("#amount").val(res.amount)
                        $("#entry_date").val(res.entry_date)
                    })
                    
                }

                $("#popup").html(res)
                $("#modal_expenses").modal('show')

            },
            500: (res) => {
                alert('Something Went Wrong!')
            }
        }
            
    })

}

</script>