<script type="text/javascript">
$(document).ready(function(ev){


$("input[name=action]").val('')

$("#modal_add_ec").on('click',function(ev){

    action = $(this).attr('action')    
    modalTitle = `${action.charAt(0).toUpperCase() + action.slice(1)}  Category`
    
    $('.modal-title').text(modalTitle)
    $("#modal_expense").modal('show')
    $("input[name=action]").val(action)

})

$("button[name=modal_edit_ec]").on("click",function(ev){

    ev.preventDefault();
    
    action = $(this).attr('action')
    id = $(this).attr('this-id')
    console.log(id)

    modalTitle = `${action.charAt(0).toUpperCase() + action.slice(1)}  Category`
    $('.modal-title').text(modalTitle)
    
    data = { id: id }

    $.ajax({
        url: '/edit_expense_cat',
        type: 'get',
        data: data,
        statusCode: {
            200: (res) => {

                $("#ec_id").val(id)
                $("#name").val(res.name)
                $("#description").val(res.description)
                $("input[name=action]").val(action)

                console.log(status)
        
                $("#modal_expense").modal('show')

            },
            500: () => {
                alert("Something Went Wrong!")
            }
        }
    })
})


    $('.form_expense_category').on('submit', function(ev){
        ev.preventDefault()
        addoRUpdate_ExpenseCat($(this))
    })

})


/** Function */

const addoRUpdate_ExpenseCat = (data, action) => {

    var result = {};
    $.each(data.serializeArray(), function() {
        result[this.name] = this.value;
    });

    uri = ''

    switch (result.action) {
        case 'add':
            uri = '/add_expense_cat'
            
            break
        case 'update':
            uri = '/update_expense_cat'
            
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
                }else if (errors.description) {
                    alert(errors.description[0]);
                    $("#description").focus();
                }

            },
            500: (res) => {
                alert("Something went wrong");
                return false;
            },
        }
    })
}

$("#delete-expense-cat").on('click', (ev) => {

if (confirm("Are you sure you want to delete?")) {

    Id = $("#ec_id").val()

    $.ajax({
        url: `/delete-expense-cat/${Id}`,
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




</script>