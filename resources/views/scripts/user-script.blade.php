<script type="text/javascript">
$( function() {

$("#modal_add_user").on('click', (ev) => {

    getFormUserModal('add')
})

$(document).on('click', 'button[name=modal_edit_user]', function(ev){

    data = {
        id : $(this).data('id'),
        name : $(this).data('name'),
        email : $(this).data('email'),
        role : $(this).data('role')
    }

    getFormUserModal('update',data)

})

  
    
const getFormUserModal = (action, userData) =>{

    $.ajax({
        url: '/user-form',
        type: 'get',
        data: {
            action: action,
            id : userData.id,
            name: userData.name,
            email: userData.email,
            role: userData.role,
        },
        statusCode: {
            200: (res) => {

                $("#popup").html(res)
                $("#modal_user").modal('show')

            },
            500: (res) => {
                alert('Something Went Wrong!')
            }
        }
            
    })

}


})


</script>