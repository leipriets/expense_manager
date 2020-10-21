<script type="text/javascript">
$( function() {

    $("#modal_add_role").on('click', (ev) => {

        getFormRoleModal('add')
    })

    $(document).on('click', 'button[name=modal_edit_role]', function(ev){
        id = $(this).data('id')
        name = $(this).data('name')
        desc = $(this).data('desc')
        
        getFormRoleModal('update',id, name, desc)

    })


})

const getFormRoleModal = (action, id, name, desc) =>{

$.ajax({
    url: '/role-form',
    type: 'get',
    data: {
        action: action,
        id : id,
        name: name,
        desc: desc,
    },
    statusCode: {
        200: (res) => {

            $("#popup").html(res)
            $("#modal_role").modal('show')

        },
        500: (res) => {
            alert('Something Went Wrong!')
        }
    }
        
})

}

</script>